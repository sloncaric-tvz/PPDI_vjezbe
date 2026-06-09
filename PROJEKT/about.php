<?php
$pageTitle = 'About Data | Travel Cost & Country Info';
$activePage = 'about';
require_once __DIR__ . '/includes/header.php';
?>

<section class="container page-header">
    <p class="eyebrow">Course concept mapping</p>
    <h1>How this project uses XML, JSON, XPath, and REST</h1>
    <p>
        Use this page in your presentation to explain how each technology is used in the website.
    </p>
</section>

<section class="container section-stack">
    <div class="concept-grid">
        <article class="concept-card">
            <h2>XML</h2>
            <p>
                The file <code>countries.xml</code> stores structured country records with predictable fields:
                country code, name, capital, region, currency, and language.
            </p>
        </article>

        <article class="concept-card">
            <h2>XML Schema</h2>
            <p>
                The file <code>countries.xsd</code> defines the allowed XML structure and validates that required
                elements are present in the correct order and format.
            </p>
        </article>

        <article class="concept-card">
            <h2>XPath</h2>
            <p>
                XPath can be used to find countries by region, currency, or country code without manually looping
                through every XML node.
            </p>
        </article>

        <article class="concept-card">
            <h2>JSON</h2>
            <p>
                The file <code>travel_tips.json</code> stores flexible travel data such as daily budget,
                best season, notes, and tips.
            </p>
        </article>

        <article class="concept-card">
            <h2>REST</h2>
            <p>
                The website can call external REST endpoints and decode the JSON responses in PHP.
                Suggested APIs are REST Countries and Frankfurter.
            </p>
        </article>

        <article class="concept-card">
            <h2>PHP</h2>
            <p>
                PHP connects all data sources, renders pages, handles form input, and outputs the final dashboard HTML.
            </p>
        </article>
    </div>
</section>

<section class="container section-stack">
    <div class="table-card">
        <div class="table-card-header">
            <div>
                <p class="eyebrow">Suggested presentation table</p>
                <h2>Data source overview</h2>
            </div>
        </div>

        <div class="responsive-table">
            <table>
                <thead>
                    <tr>
                        <th>Source</th>
                        <th>Format</th>
                        <th>Used for</th>
                        <th>Example file/API</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Local country catalog</td>
                        <td>XML</td>
                        <td>Basic country data</td>
                        <td><code>data/countries.xml</code></td>
                    </tr>
                    <tr>
                        <td>XML structure rules</td>
                        <td>XSD</td>
                        <td>Validation</td>
                        <td><code>data/countries.xsd</code></td>
                    </tr>
                    <tr>
                        <td>Travel tips</td>
                        <td>JSON</td>
                        <td>Budget, notes, advice</td>
                        <td><code>data/travel_tips.json</code></td>
                    </tr>
                    <tr>
                        <td>Country facts</td>
                        <td>REST JSON</td>
                        <td>Population, flags, maps, names</td>
                        <td><code>restcountries.com</code></td>
                    </tr>
                    <tr>
                        <td>Exchange rates</td>
                        <td>REST JSON</td>
                        <td>Currency conversion</td>
                        <td><code>api.frankfurter.dev</code></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
