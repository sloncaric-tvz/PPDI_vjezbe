<?php
require_once __DIR__ . '/config.php';

/**
 * TODO: Load countries from data/countries.xml.
 * Suggested function: simplexml_load_file(DATA_PATH . '/countries.xml')
 */
function load_countries_xml(): ?SimpleXMLElement
{
    // Replace this placeholder with your XML loading code.
    return null;
}

/**
 * TODO: Validate countries.xml against countries.xsd.
 * Suggested classes: DOMDocument and schemaValidate().
 */
function validate_countries_xml(): array
{
    return [
        'valid' => false,
        'messages' => [
            'TODO: Implement XML Schema validation in includes/data_helpers.php.',
        ],
    ];
}

/**
 * TODO: Load travel tips from data/travel_tips.json.
 * Suggested functions: file_get_contents() and json_decode().
 */
function load_travel_tips_json(): array
{
    // Replace this placeholder with your JSON loading code.
    return [];
}

/**
 * Safe helper for reading a selected country code from the URL.
 */
function selected_country_code(string $default = 'HRV'): string
{
    $code = $_GET['code'] ?? $default;
    $code = strtoupper(trim((string) $code));

    return preg_match('/^[A-Z]{3}$/', $code) ? $code : $default;
}
