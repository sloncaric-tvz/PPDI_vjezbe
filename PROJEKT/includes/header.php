<?php
require_once __DIR__ . '/config.php';

$pageTitle = $pageTitle ?? APP_NAME;
$activePage = $activePage ?? '';

$navItems = [
    'home' => ['label' => 'Dashboard', 'href' => 'index.php'],
    'countries' => ['label' => 'Countries', 'href' => 'countries.php'],
    'country' => ['label' => 'Country Details', 'href' => 'country.php'],
    'currency' => ['label' => 'Currency', 'href' => 'currency.php'],
    'compare' => ['label' => 'Compare', 'href' => 'compare.php'],
    'about' => ['label' => 'About Data', 'href' => 'about.php'],
];
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= e($pageTitle); ?></title>
    <link rel="stylesheet" href="<?= e(url_for('assets/css/style.css')); ?>">
</head>
<body>
<a class="skip-link" href="#main-content">Skip to content</a>

<header class="site-header">
    <div class="container header-layout">
        <a class="brand" href="<?= e(url_for('index.php')); ?>" aria-label="Dashboard home">
            <span class="brand-mark">TC</span>
            <span class="brand-text">
                <strong>TravelCost</strong>
                <small>Country Info Dashboard</small>
            </span>
        </a>

        <nav class="main-nav" aria-label="Main navigation">
            <?php foreach ($navItems as $key => $item): ?>
                <a class="nav-link <?= $activePage === $key ? 'is-active' : ''; ?>" href="<?= e(url_for($item['href'])); ?>">
                    <?= e($item['label']); ?>
                </a>
            <?php endforeach; ?>
        </nav>
    </div>
</header>

<main id="main-content" class="site-main">
