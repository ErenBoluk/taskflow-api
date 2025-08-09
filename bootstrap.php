<?php
session_start();

use Dotenv\Dotenv as Dotenv;

require_once __DIR__ . "/configs/base_paths_constants.php";

$dotenv = Dotenv::createImmutable(ROOT_PATH);
$dotenv->load();

return require_once ROOT_PATH . "/configs/container/container.php";