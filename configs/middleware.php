<?php


declare(strict_types=1);

use Slim\App;
use Slim\Middleware\MethodOverrideMiddleware;
use App\Config;

return function (App $app) {
    $container = $app->getContainer();
    $config    = $container->get(Config::class);

    $app->add(MethodOverrideMiddleware::class);
    $app->add('csrf');
    $app->addBodyParsingMiddleware();
    $app->addErrorMiddleware(
        displayErrorDetails:  $config->get("display_error_details"),
        logErrors:  $config->get("log_errors"),
        logErrorDetails:  $config->get("log_error_details")
    );
};
