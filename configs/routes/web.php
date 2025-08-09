<?php
declare(strict_types = 1);

use Slim\App;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

return function (App $app) {

    $app->get('/', function (Request $request, Response $response) {
        $response->getBody()->write("Hello, welcome to $_ENV[APP_NAME] api. created by Eren Boluk");
        return $response;
    });

};