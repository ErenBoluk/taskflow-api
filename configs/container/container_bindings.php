<?php

declare(strict_types = 1);

use function DI\create;

use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseFactoryInterface;
use Slim\App;
use Slim\Csrf\Guard;
use Slim\Factory\AppFactory;

use App\Csrf;
use App\Config;

return [
    App::class => function (ContainerInterface $container) {
        AppFactory::setContainer($container);

        $addMiddlewares = require CONFIG_PATH . '/middleware.php';
        $routerWeb      = require CONFIG_PATH . '/routes/web.php';
        $routerApi     = require CONFIG_PATH . '/routes/api.php';

        $app = AppFactory::create();

        $routerWeb($app);
        $routerApi($app);

        $addMiddlewares($app);

        return $app;
    },
    Config::class => create(Config::class)->constructor(
        require CONFIG_PATH . '/base_config.php',
    ),

    ResponseFactoryInterface::class => fn(App $app) => $app->getResponseFactory(),

    'csrf' => fn(ResponseFactoryInterface $responseFactory, Csrf $csrf) => new Guard(
        responseFactory: $responseFactory,
        failureHandler: $csrf->failureHandler(),
        persistentTokenMode: true
    ),


];
