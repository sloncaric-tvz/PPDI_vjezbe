<?php
/**
 * Global configuration for the Travel Cost & Country Info Dashboard.
 *
 * Update BASE_URL if the project is placed inside a subfolder.
 * Example for XAMPP:
 * define('BASE_URL', '/travel-cost-country-dashboard-template');
 */

define('APP_NAME', 'Travel Cost & Country Info Dashboard');
define('BASE_URL', '/ppdi_projekt/ppdi_vjezbe/projekt/');
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
