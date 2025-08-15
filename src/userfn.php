<?php

namespace PHPMaker2025\project1;

use DI\ContainerBuilder;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Container\ContainerInterface;
use Psr\Cache\CacheItemPoolInterface;
use Doctrine\DBAL\ParameterType;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Result;
use Doctrine\DBAL\Query\QueryBuilder;
use Doctrine\DBAL\Cache\QueryCacheProfile;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Dflydev\FigCookies\FigRequestCookies;
use Dflydev\FigCookies\FigResponseCookies;
use Dflydev\FigCookies\SetCookie;
use Slim\Interfaces\RouteCollectorProxyInterface;
use Slim\App;
use League\Flysystem\DirectoryListing;
use League\Flysystem\FilesystemException;
use Closure;
use DateTime;
use DateTimeImmutable;
use DateInterval;
use Exception;
use InvalidArgumentException;
use Symfony\Component\Notifier\Transport as NotifierTransport; // SMS transport
use Symfony\Component\Notifier\Channel\SmsChannel;
use Symfony\Component\Notifier\Event\MessageEvent as NotifierMessageEvent;
use Symfony\Component\Notifier\Event\SentMessageEvent as NotifierSentMessageEvent;
use Symfony\Component\Notifier\Event\FailedMessageEvent as NotifierFailedMessageEvent;
use Symfony\Component\Notifier\Notification\Notification;
use Symfony\Component\Notifier\Recipient\RecipientInterface;
use Symfony\Component\Mailer\Transport\Dsn;
use Symfony\Component\Mailer\Transport\TransportInterface;
use Symfony\Component\Mailer\Event\MessageEvent;
use Symfony\Component\Mailer\Event\SentMessageEvent;
use Symfony\Component\Mailer\Event\FailedMessageEvent;
use Symfony\Component\DependencyInjection\Loader\Configurator\ServicesConfigurator;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Http\SecurityRequestAttributes;
use Symfony\Component\HttpFoundation\RateLimiter\RequestRateLimiterInterface;

// Filter for 'Last Month' (example)
function GetLastMonthFilter(string $expression, string $dbid = "DB"): string
{
    $today = getdate();
    $lastmonth = mktime(0, 0, 0, $today['mon'] - 1, 1, $today['year']);
    $val = date("Y|m", $lastmonth);
    $wrk = $expression . " BETWEEN " .
        QuotedValue(DateValue("month", $val, 1, $dbid), DataType::DATE, $dbid) .
        " AND " .
        QuotedValue(DateValue("month", $val, 2, $dbid), DataType::DATE, $dbid);
    return $wrk;
}

// Filter for 'Starts With A' (example)
function GetStartsWithAFilter(string $expression, string $dbid = "DB"): string
{
    return $expression . Like("A%", $dbid);
}

// Global user functions

// Database Connecting event
function Database_Connecting(array &$info): void
{
    // Example:
    //var_dump($info);
    //if ($info["id"] == "DB" && IsLocal()) { // Testing on local PC
    //    $info["host"] = "localhost";
    //    $info["user"] = "root";
    //    $info["password"] = "";
    //}
}

// Database Connected event
function Database_Connected(Connection $conn, array $info): void
{
    // Example:
    //if ($info["id"] == "DB") {
    //    $conn->executeQuery("Your SQL");
    //}
}

// Language Load event
function Language_Load(): void
{
    // Example:
    //$this->setPhrase("MyID", "MyValue"); // Refer to language file for the actual phrase id
    //$this->setPhraseClass("MyID", "fa-solid fa-xxx ew-icon"); // Refer to https://fontawesome.com/icons?d=gallery&m=free [^] for icon name
}

function MenuItem_Adding(MenuItem $item): void
{
    //var_dump($item);
    //$item->Allowed = false; // Set to false if menu item not allowed
}

function Menu_Rendering(): void
{
    // Change menu items here
}

function Menu_Rendered(): void
{
    // Clean up here
}

// Page Loading event
function Page_Loading(): void
{
    //Log("Page Loading");
}

// Page Rendering event
function Page_Rendering(): void
{
    //Log("Page Rendering");
}

// Page Unloaded event
function Page_Unloaded(): void
{
    //Log("Page Unloaded");
}

// AuditTrail Inserting event
function AuditTrail_Inserting(array &$row): bool
{
    //var_dump($row);
    return true;
}

// Personal Data Downloading event
function PersonalData_Downloading(UserInterface $user): void
{
    //Log("PersonalData Downloading");
}

// Personal Data Deleted event
function PersonalData_Deleted(UserInterface $user): void
{
    //Log("PersonalData Deleted");
}

// One Time Password Sending event
function Otp_Sending(Notification $notication, RecipientInterface $recipient): bool
{
    // Example:
    // var_dump($notication, $recipient); // View notication and recipient
    // if (in_array("email", $notication->getChannels())) { // Possible values, "email" or "sms"
    //     $notication->content("..."); // Change content
    //     $recipient->email("..."); // Change email
    //     // return false; // Return false to cancel
    // }
    return true;
}

// Route Action event
function Route_Action(RouteCollectorProxyInterface $app): void
{
    // Example:
    // $app->get('/myaction', function ($request, $response, $args) {
    //    return $response->withJson(["name" => "myaction"]); // Note: Always return Psr\Http\Message\ResponseInterface object
    // });
    // $app->get('/myaction2', function ($request, $response, $args) {
    //    return $response->withJson(["name" => "myaction2"]); // Note: Always return Psr\Http\Message\ResponseInterface object
    // });
}

// API Action event
function Api_Action(RouteCollectorProxyInterface $app): void
{
    // Example:
    // $app->get('/myaction', function ($request, $response, $args) {
    //    return $response->withJson(["name" => "myaction"]); // Note: Always return Psr\Http\Message\ResponseInterface object
    // });
    // $app->get('/myaction2', function ($request, $response, $args) {
    //    return $response->withJson(["name" => "myaction2"]); // Note: Always return Psr\Http\Message\ResponseInterface object
    // });
}

// Container Build event
function Container_Build(ContainerBuilder $builder): void
{
    // Example:
    // $builder->addDefinitions([
    //    "myservice" => function (ContainerInterface $c) {
    //        // your code to provide the service, e.g.
    //        return new MyService();
    //    },
    //    "myservice2" => function (ContainerInterface $c) {
    //        // your code to provide the service, e.g.
    //        return new MyService2();
    //    }
    // ]);
}

// Container Built event
function Container_Built(ContainerInterface $container): void
{
    // Example:
    // $container->set("foo", "bar");
    // $container->set("MyInterface", \DI\create("MyClass"));
}

// Services Config event
function Services_Config(ServicesConfigurator $services): void
{
    // Example:
    // $services->set(MyListener::class)->tag("kernel.event_listener"); // Make sure you tag your listener as "kernel.event_listener"
}

// Add listeners
AddListener(DatabaseConnectingEvent::NAME, function(DatabaseConnectingEvent $event) {
    $args = $event->getArguments();
    Database_Connecting($args);
    foreach ($args as $key => $value) {
        if ($event->getArgument($key) !== $value) {
            $event->setArgument($key, $value);
        }
    }
});
AddListener(DatabaseConnectedEvent::NAME, fn(DatabaseConnectedEvent $event) => Database_Connected($event->getConnection(), $event->getArguments()));
AddListener(LanguageLoadEvent::NAME, fn(LanguageLoadEvent $event) => Language_Load(...)->bindTo($event->getLanguage())());
AddListener(MenuItemAddingEvent::NAME, fn(MenuItemAddingEvent $event) => MenuItem_Adding(...)->bindTo($event->getMenu())($event->getMenuItem()));
AddListener(MenuRenderingEvent::NAME, fn(MenuRenderingEvent $event) => Menu_Rendering(...)->bindTo($event->getMenu())($event->getMenu()));
AddListener(MenuRenderedEvent::NAME, fn(MenuRenderedEvent $event) => Menu_Rendered(...)->bindTo($event->getMenu())($event->getMenu()));
AddListener(PageLoadingEvent::NAME, fn(PageLoadingEvent $event) => Page_Loading(...)->bindTo($event->getPage())());
AddListener(PageRenderingEvent::NAME, fn(PageRenderingEvent $event) => Page_Rendering(...)->bindTo($event->getPage())());
AddListener(PageUnloadedEvent::NAME, fn(PageUnloadedEvent $event) => Page_Unloaded(...)->bindTo($event->getPage())());
AddListener(RouteActionEvent::NAME, fn(RouteActionEvent $event) => Route_Action($event->getApp()));
AddListener(ApiActionEvent::NAME, fn(ApiActionEvent $event) => Api_Action($event->getGroup()));
AddListener(ContainerBuildEvent::NAME, fn(ContainerBuildEvent $event) => Container_Build($event->getBuilder()));
AddListener(ContainerBuiltEvent::NAME, fn(ContainerBuiltEvent $event) => Container_Built($event->getContainer()));
AddListener(ServicesConfigurationEvent::NAME, fn(ServicesConfigurationEvent $event) => Services_Config($event->getServices()));
AddListener(SentMessageEvent::class, fn(SentMessageEvent $event) => DebugBar()?->addSentMessage($event->getMessage()));
AddListener(FailedMessageEvent::class, fn(FailedMessageEvent $event) => DebugBar()?->addFailedMessage($event->getMessage())->addThrowable($event->getError()));

// Dompdf
AddListener(ConfigurationEvent::NAME, function (ConfigurationEvent $event) {
    $event->import([
        "PDF_BACKEND" => "CPDF",
        "PDF_STYLESHEET_FILENAME" => "css/ewpdf.css", // Export PDF CSS styles
        "PDF_MEMORY_LIMIT" => "512M", // Memory limit
        "PDF_TIME_LIMIT" => 120, // Time limit
        "PDF_MAX_IMAGE_WIDTH" => 650, // Make sure image width not larger than page width or "infinite table loop" error
        "PDF_MAX_IMAGE_HEIGHT" => 900, // Make sure image height not larger than page height or "infinite table loop" error
        "PDF_IMAGE_SCALE_FACTOR" => 1.53, // Scale factor
    ]);
});
