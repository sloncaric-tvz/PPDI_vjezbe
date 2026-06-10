<?php
require_once __DIR__ . '/config.php';

//URL za REST api
function build_rest_countries_url(string $alpha3Code): string
{
    $fields = 'name,capital,region,subregion,population,currencies,languages,flags,maps';

    return REST_COUNTRIES_BASE_URL
        . '/alpha/' . rawurlencode(strtoupper($alpha3Code))
        . '?fields=' . rawurlencode($fields);
}
//
function get_country_info_from_rest_api(string $alpha3Code): ?array
{
    $url = build_rest_countries_url($alpha3Code);
    $response = file_get_contents($url);

    if ($response === false) {
        return null;
    }

    return json_decode($response, true);
}

function build_exchange_rate_url(string $baseCurrency, string $quoteCurrency): string
{
    return FRANKFURTER_BASE_URL
        . '/rate/' . rawurlencode(strtoupper($baseCurrency))
        . '/' . rawurlencode(strtoupper($quoteCurrency));
}


function get_exchange_rate(string $baseCurrency, string $quoteCurrency): ?float
{
    $url = build_exchange_rate_url($baseCurrency, $quoteCurrency);
    $response = file_get_contents($url);

    if ($response === false) {
        return null;
    }

    $data = json_decode($response, true);

    return $data['rate'] ?? null;
}
