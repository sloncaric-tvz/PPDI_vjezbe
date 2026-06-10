<?php
require_once __DIR__ . '/config.php';

//URL za REST api za države
function build_rest_countries_url(string $ISOCode): string
{
    $fields = 'name,capital,region,subregion,population,currencies,languages,flags,maps';

    return REST_COUNTRIES_BASE_URL
        . '/alpha/' . rawurlencode(strtoupper($ISOCode))
        . '?fields=' . rawurlencode($fields);
}

//dohvaćanje pomoću REST apija
function get_country_info_from_rest_api(string $ISOCode): ?array
{
    $url = build_rest_countries_url($ISOCode);
    $response = file_get_contents($url);

    if ($response === false) {
        return null;
    }

    return json_decode($response, true);
}

//URL za REST api za valute
function build_exchange_rate_url(string $baseCurrency, string $quoteCurrency): string
{
    return FRANKFURTER_BASE_URL
        . '/rate/' . rawurlencode(strtoupper($baseCurrency))
        . '/' . rawurlencode(strtoupper($quoteCurrency));
}

//odhvaćanje valuta pomoću REST apija
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
