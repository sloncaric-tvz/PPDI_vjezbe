<?php
$pageTitle = 'Country Details | Travel Cost & Country Info';
$activePage = 'country';
require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/api_client.php';
require_once __DIR__ . '/includes/data_helpers.php';

$jsonPath = __DIR__ . '/data/travel_tips.json';
$travel_tips = load_travel_tips_json($jsonPath);

$selectedCode = selected_country_code('');

if($selectedCode != ''){
    $xmlPath = __DIR__ . '/data/countries.xml';
    $xpath = "//country[alpha3='$selectedCode']";
    $country = load_countries_xml($xmlPath, $xpath)[0];
    $restCountriesUrl = build_rest_countries_url($selectedCode);
}
?>

<section class="container page-header">
    <p class="eyebrow">XML + JSON + REST</p>
    <h1>Country details</h1>
    <p>
        This page is designed to combine local XML country data, local JSON travel tips,
        and live country information from a REST API.
    </p>
</section>

<section class="container section-stack">
    <form class="filter-form compact-form" method="get" action="country.php">
        <div class="form-row">
            <label for="code">Country code</label>
            <select id="code" name="code">
                <option value="" disabled selected>Odaberi državu</option>
                <option value="HRV" <?= $selectedCode === 'HRV' ? 'selected' : ''; ?>>Croatia - HRV</option>
                <option value="JPN" <?= $selectedCode === 'JPN' ? 'selected' : ''; ?>>Japan - JPN</option>
                <option value="CAN" <?= $selectedCode === 'CAN' ? 'selected' : ''; ?>>Canada - CAN</option>
                <option value="BRA" <?= $selectedCode === 'BRA' ? 'selected' : ''; ?>>Brazil - BRA</option>
                <option value="AUS" <?= $selectedCode === 'AUS' ? 'selected' : ''; ?>>Australia - AUS</option>
                <option value="EGY" <?= $selectedCode === 'EGY' ? 'selected' : ''; ?>>Egypt - EGY</option>
            </select>
        </div>
        <button class="button button-primary" type="submit">Load country</button>
    </form>
</section>

<?php
    if($selectedCode == ''){
        require_once __DIR__ . '/includes/footer.php';
        exit;
    }
?>

<section class="container country-summary">
    <div class="summary-visual">
        <div class="flag-placeholder" aria-label="Flag placeholder">Flag</div>
        <p class="data-badge">Selected code: <?= e($selectedCode); ?></p>
    </div>

    <div class="summary-content">
        <p class="eyebrow">Country profile</p>
        <h2><?= $country->name ?></h2>
        <p>
            This hero area should display the selected country's name, flag, capital,
            region, and short travel description.
        </p>
        <div class="summary-actions">
            <a class="button button-secondary" href="<?= e(url_for('currency.php?amount='
                                                            . $travel_tips[$selectedCode]['dailyBudgetEur'] 
                                                            . '&from=EUR&to=' . $country->currency)); ?>">Open currency page</a>
            <a class="button button-ghost" href="<?= e(url_for('compare.php?left=HRV&right='. $selectedCode)); ?>">Compare countries</a>
        </div>
    </div>
</section>

<section class="container section-stack">
    <div class="data-grid">
        <article class="data-card">
            <div class="data-card-header">
                <h2>Local XML data</h2>
                <span class="data-badge">countries.xml</span>
            </div>
            <dl class="detail-list">
                <div>
                    <dt>Capital</dt>
                    <dd><?= $country->capital?></dd>
                </div>
                <div>
                    <dt>Region</dt>
                    <dd><?= $country->region?></dd>
                </div>
                <div>
                    <dt>Currency</dt>
                    <dd><?= $country->currency?></dd>
                </div>
                <div>
                    <dt>Language</dt>
                    <dd><?= $country->language?></dd>
                </div>
            </dl>
        </article>

        <article class="data-card">
            <div class="data-card-header">
                <h2>Local JSON travel tips</h2>
                <span class="data-badge">travel_tips.json</span>
            </div>
            <dl class="detail-list">
                <div>
                    <dt>Estimated daily budget</dt>
                    <dd><?= $travel_tips[$selectedCode]['dailyBudgetEur'];?> €</dd>
                </div>
                <div>
                    <dt>Best season</dt>
                    <dd><?= $travel_tips[$selectedCode]['bestSeason'];?></dd>
                </div>
                <div>
                    <dt>Travel note</dt>
                    <dd><?= $travel_tips[$selectedCode]['safetyNote'];?></dd>
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
                    <dd><!-- TODO: REST API value --> API placeholder</dd>
                </div>
                <div>
                    <dt>Official name</dt>
                    <dd><!-- TODO: REST API value --> API placeholder</dd>
                </div>
                <div>
                    <dt>Map link</dt>
                    <dd><!-- TODO: REST API value --> API placeholder</dd>
                </div>
            </dl>
        </article>
    </div>
</section>

<section class="container section-stack">
    <div class="code-panel">
        <h2>REST URL for this country</h2>
        <pre><code><?= e($restCountriesUrl); ?></code></pre>
        <p>
            Use this URL in <code>get_country_info_from_rest_api()</code>, decode the JSON response,
            and replace the placeholders above.
        </p>
    </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
