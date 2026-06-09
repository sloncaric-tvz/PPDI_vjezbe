<?php
require_once __DIR__ . '/config.php';

/**
 * TODO: Load countries from data/countries.xml.
 * Suggested function: simplexml_load_file(DATA_PATH . '/countries.xml')
 */
function load_countries_xml(string $xmlPath, string $xpath): array
{
    // Replace this placeholder with your XML loading code.
    if($xpath === ''){
        $xpath = '/countries/*';
    } 
    $countries = simplexml_load_file($xmlPath);
    $filtered = $countries->xpath($xpath);
    return $filtered;
}

/**
 * TODO: Validate countries.xml against countries.xsd.
 * Suggested classes: DOMDocument and schemaValidate().
 */
function validate_countries_xml(string $xmlPath, string $xsdPath): bool
{
    libxml_use_internal_errors(true);
    $dom = new DOMDocument();
    $dom->load($xmlPath);

    $isValid = $dom->schemaValidate($xsdPath);

    if (!$isValid) {
        echo '<div class="alert alert-error">';
        echo '<h3>XML validation failed</h3>';

        foreach (libxml_get_errors() as $error) {
            echo '<p>' . htmlspecialchars($error->message) . '</p>';
        }

        echo '</div>';

        libxml_clear_errors();
    }
    return $isValid;
}

/**
 * TODO: Load travel tips from data/travel_tips.json.
 * Suggested functions: file_get_contents() and json_decode().
 */
function load_travel_tips_json(string $jsonPath): array
{
    // Replace this placeholder with your JSON loading code.
    if(!file_exists($jsonPath)){
        return [];
    }

    $jsonContent = file_get_contents($jsonPath);
    $data = json_decode($jsonContent, true);

    if(json_last_error() !== JSON_ERROR_NONE){
        return [];
    }
    return $data;
}

/**
 * Safe helper for reading a selected country code from the URL.
 */
function selected_country_code(string $default = ''): string
{
    $code = isset($_GET['code']) ? $_GET['code'] : $default;
    $code = strtoupper(trim((string) $code));

    return preg_match('/^[A-Z]{3}$/', $code) ? $code : $default;
}
