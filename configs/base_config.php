<?php
declare(strict_types=1);

$boolean = function(mixed $value) {
    if (in_array($value, ['true', 1, '1', true, 'yes'], true)) {
        return true;
    }
    return false;
};

$appEnv = $_ENV['APP_ENV'] ?? 'production';

return [
    "app_name" => $_ENV["APP_NAME"],
    'app_environment'       => $appEnv,
    'display_error_details' => $boolean($_ENV['APP_DEBUG'] ?? 0),
    'log_errors'            => true,
    'log_error_details'     => true,
];