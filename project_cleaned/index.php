<?php
$pageTitle = 'Dashboard | Travel Cost & Country Info';
$activePage = 'home';
require_once __DIR__ . '/includes/header.php';

?>

<section class="hero-section">
    <div class="container hero-layout">
        <div class="hero-copy">
            <p class="eyebrow">XML • JSON • XPath • REST</p>
            <h1>Travel Cost & Country Info Dashboard</h1>
            <p class="hero-text">
                A PHP project for displaying local XML data, local JSON travel tips,
                and external REST API data about countries and currency exchange rates.
            </p>
            <div class="hero-actions">
                <a class="button button-primary" href="<?= e(url_for('country.php')); ?>">View country details</a>
                <a class="button button-secondary" href="<?= e(url_for('about.php')); ?>">See data plan</a>
            </div>
        </div>

        <aside class="hero-card" aria-label="Project data sources">
            <h2>Data sources</h2>
            <ul class="source-list">
                <li><span>XML</span> Local country catalog</li>
                <li><span>XSD</span> XML structure validation</li>
                <li><span>XPath</span> Search/filter countries</li>
                <li><span>JSON</span> Travel tips and cost notes</li>
                <li><span>REST</span> Country info and exchange rates</li>
            </ul>
        </aside>
    </div>
</section>

<section class="container section-stack">
    <div class="section-heading">
        <p class="eyebrow">Suggested pages</p>
        <h2>Website structure</h2>
        <p>The site separates browsing, details, conversion, comparison, and data explanation into focused pages.</p>
    </div>

    <div class="card-grid three-columns">
        <article class="feature-card">
            <span class="card-icon">01</span>
            <h3>Countries</h3>
            <p>Load countries from XML and filter them by region, currency, or search text using XPath.</p>
            <a href="<?= e(url_for('countries.php')); ?>">Open page</a>
        </article>

        <article class="feature-card">
            <span class="card-icon">02</span>
            <h3>Country Details</h3>
            <p>Combine XML country data, JSON travel tips, and REST Countries API data.</p>
            <a href="<?= e(url_for('country.php')); ?>">Open page</a>
        </article>

        <article class="feature-card">
            <span class="card-icon">03</span>
            <h3>Currency</h3>
            <p>Use a REST call to get an exchange rate and calculate estimated travel expenses.</p>
            <a href="<?= e(url_for('currency.php')); ?>">Open page</a>
        </article>
    </div>
</section>

<section class="container section-stack">
    <div class="info-panel split-panel">
        <div>
            <p class="eyebrow">Presentation angle</p>
            <h2>How to explain the project</h2>
            <p>
                The dashboard demonstrates how different data formats can work together in one PHP application:
                XML provides structured local data, JSON provides flexible travel notes, and REST APIs provide
                current external data.
            </p>
        </div>
        <div class="code-preview" aria-label="Example project explanation">
            <code>XML + XSD → validated country catalog</code>
            <code>XPath → search/filter logic</code>
            <code>JSON → travel tips and costs</code>
            <code>REST → external country and exchange data</code>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
