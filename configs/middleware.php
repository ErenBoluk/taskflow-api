<?php


declare(strict_types=1);

use Slim\App;
use Slim\Middleware\MethodOverrideMiddleware;

return function (App $app) {
    $container = $app->getContainer();

    $app->add(MethodOverrideMiddleware::class);
    $app->add('csrf');
    $app->addBodyParsingMiddleware();
    $app->addErrorMiddleware(
        displayErrorDetails:  true,
        logErrors:  true,
        logErrorDetails:  true
    );
};
