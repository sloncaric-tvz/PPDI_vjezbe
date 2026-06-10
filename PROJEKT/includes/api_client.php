<?php
require_once __DIR__ . '/config.php';

/**
 * Build a REST Countries API URL.
 *
 * Example output:
 * https://restcountries.com/v3.1/alpha/HRV?fields=name,capital,region,subregion,population,currencies,languages,flags,maps
 */
function build_rest_countries_url(string $alpha3Code): string
{
    $fields = 'name,capital,region,subregion,population,currencies,languages,flags,maps';

    return REST_COUNTRIES_BASE_URL
        . '/alpha/' . rawurlencode(strtoupper($alpha3Code))
        . '?fields=' . rawurlencode($fields);
}

/**
 * Build a Frankfurter single-rate API URL.
 *
 * Example output:
 * https://api.frankfurter.dev/v2/rate/EUR/JPY
 */

function get_country_info_from_rest_api(string $alpha3Code): ?array
{
    $url = build_rest_countries_url($alpha3Code);
    if($response = file_get_contents($url)){
        return json_decode($response, true);
    }
    else return null;
    // TODO:
    // $response = file_get_contents($url);
    // return json_decode($response, true);
}

/**
 * TODO: Implement the actual exchange-rate API call.
 * Frankfurter returns the rate; multiply it by the amount inside currency.php.
 */

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
    $data = json_decode($response, true);
    
    if($response = file_get_contents($url)){
        $rate = $data['rate'];
        return $rate;
    }
    else return null;
}
