<?php
require_once __DIR__ . '/config.php';

//učitavanje država iz XML-a
function load_countries_xml(string $xmlPath, string $xpath): array
{
    if($xpath === ''){
        $xpath = '/countries/*';
    } 
    $countries = simplexml_load_file($xmlPath);
    $filtered = $countries->xpath($xpath);
    return $filtered;
}
//validacija xml-a
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

//učitavanje iz JSON-a
function load_travel_tips_json(string $jsonPath): array
{
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

//dohvati kôd države iz ULR-a
function selected_country_code(string $default = ''): string
{
    $code = isset($_GET['code']) ? $_GET['code'] : $default;
    $code = strtoupper(trim((string) $code));

    return preg_match('/^[A-Z]{3}$/', $code) ? $code : $default;
}
