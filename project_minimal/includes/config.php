<?php
//BASE_URL počinje od prvog foldera projekta unutar htdocs
define('APP_NAME', 'Stjepko Loncaric - sloncaric@tvz.hr');
define('BASE_URL', '/project_minimal');
define('DATA_PATH', __DIR__ . '/../data');

define('REST_COUNTRIES_BASE_URL', 'https://restcountries.com/v3.1');
define('FRANKFURTER_BASE_URL', 'https://api.frankfurter.dev/v2');

function url_for(string $path = ''): string
{
    $base = rtrim(BASE_URL, '/');
    $path = ltrim($path, '/');

    if ($path === '') {
        return $base === '' ? '/' : $base . '/';
    }

    return ($base === '' ? '' : $base) . '/' . $path;
}

function e(string|int|float|null $value): string
{
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}
