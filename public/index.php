<?php
declare(strict_types = 1);

require __DIR__ . '/../vendor/autoload.php';

$container = require __DIR__ . '/../bootstrap.php';

$container->get(\Slim\App::class)->run();