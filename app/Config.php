<?php

namespace App;

class Config
{
    public function __construct(private readonly array $config)
    {
    }

    /**
     * Retrieves a configuration value using dot notation.
     *
     * Uses a dot-separated key chain (e.g., "database.connections.mysql.host")
     * to safely access values from multi-dimensional arrays or objects.
     * Returns the default value if the specified key cannot be found.
     *
     * Example:
     * $this->get('app.debug', false); // returns true or false
     *
     * @param string $name    The configuration key in dot notation.
     * @param mixed  $default The default value to return if the key is not found.
     *
     * @return mixed The value associated with the given key, or the default value.
     */
    public function get(string $name, mixed $default = null): mixed
    {
        if ($name === '') {
            return $default;
        }

        $path = explode('.', $name);

        $value = $this->config[array_shift($path)] ?? null;

        if ($value === null) {
            return $default;
        }

        foreach ($path as $key) {
            if (is_array($value) && array_key_exists($key, $value)) {
                $value = $value[$key];
                continue;
            }

            if (is_object($value) && property_exists($value, $key)) {
                $value = $value->{$key};
                continue;
            }

            return $default;
        }

        return $value;
    }


}