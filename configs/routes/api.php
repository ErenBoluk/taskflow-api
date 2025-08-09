<?php
declare(strict_types = 1);

use Slim\App;
use Slim\Routing\RouteCollectorProxy as RouteCollectorProxy;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

return function (App $app) {

    $app->group('/api', function (RouteCollectorProxy $group) {
        $group->get("/health", function (Request $request, Response $response) {
            $payload = json_encode(["status" => "ok"], JSON_PRETTY_PRINT|JSON_UNESCAPED_SLASHES);
            $response->getBody()->write($payload);
            return $response
                ->withHeader('Content-Type', 'application/json')
                ->withStatus(200);
        });

    });

};