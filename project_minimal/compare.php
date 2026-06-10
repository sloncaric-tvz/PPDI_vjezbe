<?php
$pageTitle = 'Compare Countries';
$activePage = 'compare';
require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/data_helpers.php';
require_once __DIR__ . '/includes/api_client.php';

//put do xml-a
$xmlPath = __DIR__ . '/data/countries2.xml';
$jsonPath = __DIR__ . '/data/travel_tips2.json';

//dohvati iso kôd države iz url-a ako postoji
$leftCountryCode = isset($_GET['left']) ? $_GET['left'] : '';
$rightCountryCode = isset($_GET['right']) ? $_GET['right'] : '';
//učitaj json i xml
$travelTips = load_travel_tips_json($jsonPath);
$countriesXml = simplexml_load_file($xmlPath);

$countryCodes = $countriesXml->xpath('/countries/country/@code');
?>

<section class="container page-header">
    <p class="eyebrow">Combined data view</p>
    <h1>Compare countries</h1>
    <p>
        Compare two countries side by side using XML values, JSON travel tips, and REST API population data.
    </p>
</section>

<section class="container section-stack">
    <form class="filter-form compact-form" method="get" action="compare.php">
        <div class="form-row">
            <label for="left">First country</label>
            <select id="left" name="left">
                <option value="" disabled <?= $leftCountryCode == '' ? 'selected' : '' ?>>Choose a country</option>
                <?php
                    foreach ($countryCodes as $code) {
                        $countryName = $countriesXml->xpath('/countries/country[@code="' . $code[0] . '"]/name');
                        $option =  '<option value="' . $code[0] . '" ';
                        if ($leftCountryCode == $code[0]) {
                            $option .= 'selected';
                        }
                        $option .= '>' . $countryName[0] . '</option>';
                        echo $option;
                    }
                ?>
            </select>
        </div>

        <div class="form-row">
            <label for="right">Second country</label>
            <select id="right" name="right">
                <option value="" disabled <?= $rightCountryCode == '' ? 'selected' : '' ?>>Choose a country</option>
                <?php
                    foreach ($countryCodes as $code) {
                        $countryName = $countriesXml->xpath('/countries/country[@code="' . $code[0] . '"]/name');
                        $option =  '<option value="' . $code[0] . '" ';
                        if ($rightCountryCode == $code[0]) {
                            $option .= 'selected';
                        }
                        $option .= '>' . $countryName[0] . '</option>';
                        echo $option;
                    }
                ?>
            </select>
        </div>

        <button class="button button-primary" type="submit">Compare</button>
    </form>
</section>

<?php
//ako su odabrane obje države, dohvati info putem REST apija
if ($leftCountryCode != '' and $rightCountryCode != '') {
    $travelTipsLeft = $travelTips[$leftCountryCode];
    $travelTipsRight = $travelTips[$rightCountryCode];

    $restCountryLeft = get_country_info_from_rest_api($leftCountryCode);
    $restCountryRight = get_country_info_from_rest_api($rightCountryCode);

    $leftCountry = $countriesXml->xpath("/countries/country[@code='$leftCountryCode']")[0];
    $rightCountry = $countriesXml->xpath("/countries/country[@code='$rightCountryCode']")[0];

    $urlLeft = e(url_for('country.php?code=' . $leftCountryCode));
    $urlRight = e(url_for('country.php?code=' . $rightCountryCode));
} else {
    require_once __DIR__ . '/includes/footer.php';
    exit;
}
?>

<section class="container section-stack">
    <div class="table-card">
        <div class="table-card-header">
            <div>
                <h2>Comparison table</h2>
            </div>
            <span class="data-badge">Combined data</span>
        </div>

        <div class="responsive-table">
            <table>
                <thead>
                    <tr>
                        <th>Category</th>
                        <th><a href="<?= $urlLeft; ?>"><?= $leftCountry->name; ?></a></th>
                        <th><a href="<?= $urlRight; ?>"><?= $rightCountry->name; ?></a></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Capital</td>
                        <td><?= $leftCountry->capital; ?></td>
                        <td><?= $rightCountry->capital; ?></td>
                    </tr>
                    <tr>
                        <td>Currency</td>
                        <td><?= ucfirst($restCountryLeft['currencies'][(string)$leftCountry->currency]['name']); ?> 
            (<?= $restCountryLeft['currencies'][(string)$leftCountry->currency]['symbol']; ?>)</td>
                        <td><?= ucfirst($restCountryRight['currencies'][(string)$rightCountry->currency]['name']); ?> 
            (<?= $restCountryRight['currencies'][(string)$rightCountry->currency]['symbol']; ?>)</td>
                    </tr>
                    <tr>
                        <td>Daily budget</td>
                        <td><?= $travelTipsLeft['dailyBudgetEur']; ?> € (<?= ucfirst($travelTipsLeft['costLevel']); ?>)</td>
                        <td><?= $travelTipsRight['dailyBudgetEur']; ?> € (<?= ucfirst($travelTipsRight['costLevel']); ?>)</td>
                    </tr>
                    <tr>
                        <td>Best season</td>
                        <td><?= $travelTipsLeft['bestSeason']; ?></td>
                        <td><?= $travelTipsRight['bestSeason']; ?></td>
                    </tr>
                    <tr>
                        <td>Region</td>
                        <td><?= $leftCountry->region . ' (' . $leftCountry->subregion . ')'; ?></td>
                        <td><?= $rightCountry->region . ' (' . $rightCountry->subregion . ')'; ?></td>
                    </tr>
                    <tr>
                        <td>Population</td>
                        <td><?= number_format($restCountryLeft['population']); ?></td>
                        <td><?= number_format($restCountryRight['population']); ?></td>
                    </tr>
                    <tr>
                        <td>Safety</td>
                        <td><?= $travelTipsLeft['safetyNote']; ?></td>
                        <td><?= $travelTipsRight['safetyNote']; ?></td>
                    </tr>
                    <tr>
                        <td>Travel note</td>
                        <td><?= $travelTipsLeft['travelNote']; ?></td>
                        <td><?= $travelTipsRight['travelNote']; ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
