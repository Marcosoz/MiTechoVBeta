<?php

namespace PHPMaker2025\project1;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Symfony\Component\Routing\Attribute\Route;
use Slim\Routing\RouteContext;
use Slim\Exception\HttpUnauthorizedException;

/**
 * Class others controller
 */
class OthersController extends ControllerBase
{
    // Swagger
    #[Route("/swagger/swagger", methods: "GET", name: "swagger")]
    public function swagger(Request $request, Response &$response, array $args): Response
    {
        $basePath = GetBasePath($request);
        $language = $this->container->get("app.language");
        $title = $language->phrase("ApiTitle");
        if (!$title || $title == "ApiTitle") {
            $title = "REST API"; // Default
        }
        $data = [
            "title" => $title,
            "version" => Config("API_VERSION"),
            "basePath" => $basePath
        ];
        $view = $this->container->get("app.view");
        return $view->render($response, "swagger.php", $data);
    }

    // Index
    #[Route("/[index]", methods: "GET", defaults: ["middlewares" => [PermissionMiddleware::class, AuthenticationMiddleware::class]], name: "index")]
    public function index(Request $request, Response &$response, array $args): Response
    {
        $url = "AportesLegalesList";
        if ($url == "") {
            throw new HttpUnauthorizedException($request, DeniedMessage());
        }
        return $response->withHeader("Location", $url)->withStatus(Config("REDIRECT_STATUS_CODE"));
    }
}
