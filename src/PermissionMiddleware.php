<?php

namespace PHPMaker2025\project1;

use Slim\Routing\RouteContext;
use Slim\Exception\HttpBadRequestException;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

/**
 * Permission middleware
 */
class PermissionMiddleware
{
    /**
     * Invoke
     *
     * @param Request $request Request
     * @param RequestHandler $handler Request handler
     * @return Response
     */
    public function __invoke(Request $request, RequestHandler $handler): Response
    {
        // Request
        $GLOBALS["Request"] = $request;

        // Handle request
        return $handler->handle($request);
    }

    /**
     * Set failure message (no permission)
     *
     * @return void
     */
    protected function setFailureMessage(): void
    {
        $flashBag = FlashBag();
        if (implode("", $flashBag->peek("failure")) != DeniedMessage()) {
            $flashBag->add("failure", DeniedMessage());
        }
    }

    /**
     * Redirect
     *
     * @param string $routeName Route name
     * @return Response
     */
    protected function redirect(string $routeName = "login"): Response
    {
        $response = ResponseFactory()->createResponse(); // Create response
        if (
            IsJsonResponse() || // JSON response expected
            IsModal() && // Modal
            !($routeName == "login" && Config("USE_MODAL_LOGIN")) // Not modal login
        ) {
            return $response->withJson(["url" => UrlFor($routeName)]);
        }
        return $response->withHeader("Location", UrlFor($routeName))->withStatus(Config("REDIRECT_STATUS_CODE"));
    }
}
