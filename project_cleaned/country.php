<?php
$pageTitle = 'Country Details | Travel Cost & Country Info';
$activePage = 'country';
require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/api_client.php';
require_once __DIR__ . '/includes/data_helpers.php';

$xmlPath = __DIR__ . '/data/countries2.xml';
$jsonPath = __DIR__ . '/data/travel_tips2.json';
$travel_tips = load_travel_tips_json($jsonPath);

$countriesXml = simplexml_load_file($xmlPath);

$selectedCode = selected_country_code('');
$countryCodes = $countriesXml->xpath('/countries/country/@code');

if ($selectedCode != '') {
    $xpath = "//country[@code='$selectedCode']";
    $country = load_countries_xml($xmlPath, $xpath)[0];
    $restCountriesUrl = build_rest_countries_url($selectedCode);
    $restCountryInfo = get_country_info_from_rest_api($selectedCode);
}
?>

<section class="container page-header">
    <p class="eyebrow">XML + JSON + REST</p>
    <h1>Country details</h1>
    <p>
        This page combines local XML country data, local JSON travel tips,
        and live country information from the REST Countries API.
    </p>
</section>

<section class="container section-stack">
    <form class="filter-form compact-form" method="get" action="country.php">
        <div class="form-row">
            <label for="code">Country code</label>
            <select id="code" name="code">
                <option value="" disabled <?= $selectedCode == '' ? 'selected' : '' ?>>Choose a country</option>
                <?php
                    foreach ($countryCodes as $code) {
                        $countryName = $countriesXml->xpath('/countries/country[@code="' . $code[0] . '"]/name');
                        $option =  '<option value="' . $code[0] . '" ';
                        if ($selectedCode == $code[0]) {
                            $option .= 'selected';
                        }
                        $option .= '>' . $countryName[0] . '</option>';
                        echo $option;
                    }
                ?>
            </select>
        </div>
        <button class="button button-primary" type="submit">Load country</button>
    </form>
</section>

<?php
    if ($selectedCode == '') {
        require_once __DIR__ . '/includes/footer.php';
        exit;
    }
?>

<section class="container country-summary">
    <div class="summary-visual">
        <?php if (!empty($restCountryInfo['flags']['svg'])): ?>
            <figure class="country-flag-frame">
                <img src="<?= e($restCountryInfo['flags']['svg']); ?>" alt="Flag of <?= e($country->name); ?>" class="country-flag">
                <figcaption><?= e($country->name); ?> flag</figcaption>
            </figure>
        <?php endif; ?>
        <p class="data-badge">Selected code: <?= e($selectedCode); ?></p>
    </div>

    <div class="summary-content">
        <p class="eyebrow">Country profile</p>
        <h2><?= $country->name; ?></h2>
        <p>
            <?= $country->capital; ?> is the capital of <?= $country->name; ?>.
            The country is located in <?= $country->region; ?>, within the <?= $country->subregion; ?> subregion,
            and uses <?= $country->currency; ?> as its currency.
        </p>
        <div class="summary-actions">
            <a class="button button-secondary" href="<?= e(url_for('currency.php?amount='
                                                            . $travel_tips[$selectedCode]['dailyBudgetEur']
                                                            . '&from=EUR&to=' . $country->currency)); ?>">Open currency page</a>
            <a class="button button-ghost" href="<?= e(url_for('compare.php?left=HRV&right=' . $selectedCode)); ?>">Compare countries</a>
        </div>
    </div>
</section>

<section class="container section-stack">
    <div class="data-grid">
        <article class="data-card">
            <div class="data-card-header">
                <h2>Local XML data</h2>
                <span class="data-badge">countries2.xml</span>
            </div>
            <dl class="detail-list">
                <div>
                    <dt>Capital</dt>
                    <dd><?= $country->capital; ?></dd>
                </div>
                <div>
                    <dt>Region</dt>
                    <dd><?= $country->region; ?></dd>
                </div>
                <div>
                    <dt>Subregion</dt>
                    <dd><?= $country->subregion; ?></dd>
                </div>
                <div>
                    <dt>Currency</dt>
                    <dd><?= $country->currency; ?></dd>
                </div>
                <div>
                    <dt>Language(s)</dt>
                    <dd><?= $country->language; ?></dd>
                </div>
            </dl>
        </article>

        <article class="data-card">
            <div class="data-card-header">
                <h2>Local JSON travel tips</h2>
                <span class="data-badge">travel_tips2.json</span>
            </div>
            <dl class="detail-list">
                <div>
                    <dt>Estimated daily budget</dt>
                    <dd><?= $travel_tips[$selectedCode]['dailyBudgetEur']; ?> € (<?= ucfirst($travel_tips[$selectedCode]['costLevel']); ?>)</dd>
                </div>
                <div>
                    <dt>Best season</dt>
                    <dd><?= $travel_tips[$selectedCode]['bestSeason']; ?></dd>
                </div>
                <div>
                    <dt>Travel note</dt>
                    <dd><?= $travel_tips[$selectedCode]['travelNote']; ?></dd>
                </div>
                <div>
                    <dt>Safety note</dt>
                    <dd><?= $travel_tips[$selectedCode]['safetyNote']; ?></dd>
                </div>
                <div>
                    <dt>Recommended stay</dt>
                    <dd><?= $travel_tips[$selectedCode]['recommendedStay']; ?> days</dd>
                </div>
            </dl>
        </article>

        <article class="data-card">
            <div class="data-card-header">
                <h2>REST Countries API</h2>
                <span class="data-badge">External JSON</span>
            </div>
            <dl class="detail-list">
                <div>
                    <dt>Population</dt>
                    <dd><?= number_format($restCountryInfo['population']); ?></dd>
                </div>
                <div>
                    <dt>Official name</dt>
                    <dd>
                        <?php
                            echo $restCountryInfo['name']['official'] . '<br>';
                            foreach ($restCountryInfo['name']['nativeName'] as $key => $value) {
                                echo '(' . $value['official'] . ')<br>';
                            }
                        ?>
                    </dd>
                </div>
                <div>
                    <dt>Map link</dt>
                    <dd><a href="<?= e($restCountryInfo['maps']['googleMaps']); ?>" target="_blank">Open in Google Maps</a></dd>
                </div>
            </dl>
        </article>
    </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
