# Travel Cost & Country Info Dashboard

PHP website template for a Data Connectivity and Digital Infrastructure project focused on XML, XML Schema, XPath, JSON, REST, and external API data.

## Project idea

The website lets a user select a country and view travel/country information from three source types:

1. **Local XML**: `data/countries.xml`
   - Stores manually curated country data.
   - Can be validated using `data/countries.xsd`.
   - Can be searched with XPath.

2. **Local JSON**: `data/travel_tips.json`
   - Stores flexible travel information such as daily budget, best season, safety notes, and tips.

3. **REST APIs returning JSON**
   - REST Countries API for country data.
   - Frankfurter API for exchange-rate data.

## Suggested external endpoints

REST Countries country lookup by code:

```text
https://restcountries.com/v3.1/alpha/HRV?fields=name,capital,region,subregion,population,currencies,languages,flags,maps
```

Frankfurter exchange rate lookup:

```text
https://api.frankfurter.dev/v2/rate/EUR/JPY
```

## File structure

```text
travel-cost-country-dashboard-template/
│
├── index.php
├── countries.php
├── country.php
├── compare.php
├── currency.php
├── about.php
│
├── assets/
│   ├── css/
│   │   └── style.css
│   └── js/
│       └── main.js
│
├── data/
│   ├── countries.xml
│   ├── countries.xsd
│   └── travel_tips.json
│
└── includes/
    ├── api_client.php
    ├── config.php
    ├── data_helpers.php
    ├── footer.php
    └── header.php
```

## Implementation checklist

### XML

- Load `data/countries.xml` using `simplexml_load_file()`.
- Display countries from the XML file on `countries.php`.
- Use XPath to search/filter countries.

Suggested XPath examples:

```php
// All countries in Europe
$results = $xml->xpath("//country[region='Europe']");

// Country by Alpha-3 code
$results = $xml->xpath("//country[alpha3='HRV']");

// Countries that use EUR
$results = $xml->xpath("//country[currency='EUR']");
```

### XML Schema

- Validate `countries.xml` against `countries.xsd` using `DOMDocument::schemaValidate()`.
- Show validation status on `about.php` or create a small admin/debug section.

### JSON

- Load `data/travel_tips.json` using `file_get_contents()` and `json_decode()`.
- Match JSON data to the selected country code.

Example:

```php
$tips = json_decode(file_get_contents(DATA_PATH . '/travel_tips.json'), true);
$selectedTips = $tips['HRV'] ?? null;
```

### REST API calls

- Use `file_get_contents()` or cURL to call REST Countries and Frankfurter.
- Decode the JSON response using `json_decode()`.
- Display API data separately from local XML/JSON data so the project clearly shows multiple data sources.

### Suggested pages

- `index.php`: dashboard overview.
- `countries.php`: XML country browser and XPath search.
- `country.php`: detailed country page using XML + JSON + REST API data.
- `currency.php`: exchange-rate page using Frankfurter.
- `compare.php`: compare two countries.
- `about.php`: explain which course concepts are used.

## Running locally

1. Copy the folder into your XAMPP `htdocs` directory.
2. Open Apache from XAMPP Control Panel.
3. Visit the project in the browser.

Example:

```text
http://localhost/travel-cost-country-dashboard-template/
```

If your folder name or path is different, update `BASE_URL` in `includes/config.php`.
