<?php
$pageTitle = 'Compare Countries | Travel Cost & Country Info';
$activePage = 'compare';
require_once __DIR__ . '/includes/header.php';
?>

<section class="container page-header">
    <p class="eyebrow">Combined data view</p>
    <h1>Compare countries</h1>
    <p>
        Use this page to compare two countries side by side using XML values,
        JSON travel tips, and optional REST API data.
    </p>
</section>

<section class="container section-stack">
    <form class="filter-form compact-form" method="get" action="compare.php">
        <div class="form-row">
            <label for="left">First country</label>
            <select id="left" name="left">
                <option value="HRV">Croatia</option>
                <option value="JPN">Japan</option>
                <option value="CAN">Canada</option>
                <option value="BRA">Brazil</option>
                <option value="AUS">Australia</option>
                <option value="EGY">Egypt</option>
            </select>
        </div>

        <div class="form-row">
            <label for="right">Second country</label>
            <select id="right" name="right">
                <option value="JPN">Japan</option>
                <option value="HRV">Croatia</option>
                <option value="CAN">Canada</option>
                <option value="BRA">Brazil</option>
                <option value="AUS">Australia</option>
                <option value="EGY">Egypt</option>
            </select>
        </div>

        <button class="button button-primary" type="submit">Compare</button>
    </form>
</section>

<section class="container section-stack">
    <div class="table-card">
        <div class="table-card-header">
            <div>
                <p class="eyebrow">TODO</p>
                <h2>Comparison table</h2>
            </div>
            <span class="data-badge">XML + JSON + REST</span>
        </div>

        <div class="responsive-table">
            <table>
                <thead>
                    <tr>
                        <th>Category</th>
                        <th>Country A</th>
                        <th>Country B</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Capital</td>
                        <td><!-- TODO --> Zagreb</td>
                        <td><!-- TODO --> Tokyo</td>
                    </tr>
                    <tr>
                        <td>Currency</td>
                        <td><!-- TODO --> EUR</td>
                        <td><!-- TODO --> JPY</td>
                    </tr>
                    <tr>
                        <td>Daily budget</td>
                        <td><!-- TODO --> 75 EUR</td>
                        <td><!-- TODO --> 110 EUR</td>
                    </tr>
                    <tr>
                        <td>Best season</td>
                        <td><!-- TODO --> Spring</td>
                        <td><!-- TODO --> Spring</td>
                    </tr>
                    <tr>
                        <td>Population</td>
                        <td><!-- TODO: REST --> API placeholder</td>
                        <td><!-- TODO: REST --> API placeholder</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
