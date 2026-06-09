<?php
$pageTitle = 'Countries | Travel Cost & Country Info';
$activePage = 'countries';
require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/data_helpers.php';

$xmlPath = __DIR__ . '/data/countries.xml';
$xsdPath = __DIR__ . '/data/countries.xsd';

if (!validate_countries_xml($xmlPath, $xsdPath)) {
    exit;
}

if($_SERVER['REQUEST_METHOD'] == 'GET' and isset($_GET['search'])){
    /*$search = $_GET['search'] == '' ? '*' : $_GET['search'];
    $region = $_GET['region'] == '' ? '*' : $_GET['region'];
    $currency = $_GET['currency'] == '' ? '*' : $_GET['currency'];*/
    $search = $_GET['search'];
    $region = $_GET['region'];
    $currency = strtoupper($_GET['currency']);

    /*$xpath = "//country[name='$search'][region='$region'][currency='$currency']";*/
    $xpath = "//country";
    $xpath .= $search == '' ? '' : "[contains(name, '$search')]";
    $xpath .= $region == '' ? '' : "[region='$region']";
    $xpath .= $currency == '' ? '' : "[currency='$currency']";
}

$countries = load_countries_xml($xmlPath, isset($xpath) ? $xpath : '');
?>

<section class="container page-header">
    <p class="eyebrow">Local XML + XPath</p>
    <h1>Country browser</h1>
    <p>
        Use this page to display data from <code>data/countries.xml</code>.
        Add XPath filtering for search, region, and currency.
    </p>
</section>

<section class="container section-stack">
    <form class="filter-form" method="get" action="countries.php">
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
    </form>
</section>

<section class="container section-stack">
    <div class="table-card">
        <div class="table-card-header">
            <div>
                <p class="eyebrow">TODO</p>
                <h2>XML country results</h2>
            </div>
            <span class="data-badge">Source: countries.xml</span>
        </div>

        <div class="notice-box">
            <p class="status-message success">XML document successfully validated against countries.xsd.</p>
        </div>

        <div class="responsive-table">
            <table>
                <thead>
                    <tr>
                        <th>Country</th>
                        <th>Capital</th>
                        <th>Region</th>
                        <th>Currency</th>
                        <th>Language</th>
                        <th>Link</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                       foreach($countries as $country){
                            $url = e(url_for('country.php?code=' . $country->alpha3));
                            echo "<tr>
                            <td>$country->name</td>
                            <td>$country->capital</td>
                            <td>$country->region</td>
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

<section class="container section-stack">
    <div class="code-panel">
        <h2>XPath examples to implement</h2>
        <pre><code>//country[region='Europe']
//country[currency='EUR']
//country[alpha3='HRV']</code></pre>
    </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
