<?php
$pageTitle = 'Countries';
$activePage = 'countries';
require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/data_helpers.php';

//put do xml i jsona
$xmlPath = __DIR__ . '/data/countries2.xml';
$xsdPath = __DIR__ . '/data/countries2.xsd';
$XmlValid = validate_countries_xml($xmlPath, $xsdPath);

//validacija
if (!$XmlValid) {
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'GET' and isset($_GET['search'])) {
    $search = $_GET['search'];
    $region = $_GET['region'];
    $currency = strtoupper($_GET['currency']);

    $xpath = "//country";
    $xpath .= $search == '' ? '' : "[contains(name, '$search')]";
    $xpath .= $region == '' ? '' : "[region='$region']";
    $xpath .= $currency == '' ? '' : "[currency='$currency']";
}
//učitaj xml
$countries = load_countries_xml($xmlPath, isset($xpath) ? $xpath : '');
?>

<section class="container page-header">
    <p class="eyebrow">Local XML + XPath</p>
    <h1>Country browser</h1>
    <p>
        Browse the local XML country catalog and filter countries by name, region, or currency using XPath.
    </p>
</section>

<section class="container section-stack">
    <form class="filter-form" method="get" action="index.php">
        <div class="form-row">
            <label for="search">Search country</label>
            <input type="search" id="search" name="search" placeholder="Example: Croatia" <?= isset($_GET['search']) ? "value='$search'" : ''; ?>>
        </div>

        <div class="form-row">
            <label for="region">Region</label>
            <select id="region" name="region">
                <option value="">All regions</option>
                <option value="Europe" <?= isset($_GET['region']) && $_GET['region'] == 'Europe' ? 'selected' : ''; ?>>Europe</option>
                <option value="Asia" <?= isset($_GET['region']) && $_GET['region'] == 'Asia' ? 'selected' : ''; ?>>Asia</option>
                <option value="Americas" <?= isset($_GET['region']) && $_GET['region'] == 'Americas' ? 'selected' : ''; ?>>Americas</option>
                <option value="Africa" <?= isset($_GET['region']) && $_GET['region'] == 'Africa' ? 'selected' : ''; ?>>Africa</option>
                <option value="Oceania" <?= isset($_GET['region']) && $_GET['region'] == 'Oceania' ? 'selected' : ''; ?>>Oceania</option>
            </select>
        </div>

        <div class="form-row">
            <label for="currency">Currency</label>
            <input type="text" id="currency" name="currency" maxlength="3" placeholder="EUR" <?= isset($_GET['currency']) ? "value='$currency'" : ''; ?>>
        </div>

        <button class="button button-primary" type="submit">Apply filters</button>
        <a class="button button-ghost" href="<?= e(url_for('index.php')); ?>">Reset filters</a>
    </form>
</section>

<section class="container section-stack">
    <div class="table-card">
        <div class="table-card-header">
            <div>
                <p class="eyebrow">Country records</p>
                <h2>XML country results</h2>
            </div>
            <div class="status-stack">
                <span class="data-badge">Source: countries2.xml</span>
                <span class="status-pill success">XSD validated</span>
            </div>
        </div>

        <div class="responsive-table">
            <table>
                <thead>
                    <tr>
                        <th>Country</th>
                        <th>Capital</th>
                        <th>Region</th>
                        <th>Subregion</th>
                        <th>Currency</th>
                        <th>Language(s)</th>
                        <th>Link</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                       foreach($countries as $country){
                            $url = e(url_for('country.php?code='. $country->attributes()->code));
                            echo "<tr>
                            <td>$country->name</td>
                            <td>$country->capital</td>
                            <td>$country->region</td>
                            <td>$country->subregion</td>
                            <td>$country->currency</td>
                            <td>$country->language</td>
                            <td><a href='$url'>Details</a></td>";
                       } 
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
