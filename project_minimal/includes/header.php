<?php
require_once __DIR__ . '/config.php';

$pageTitle = $pageTitle ?? APP_NAME;
$activePage = $activePage ?? '';

$navItems = [
    'countries' => ['label' => 'Countries', 'href' => 'index.php'],
    'country' => ['label' => 'Country Details', 'href' => 'country.php'],
    'currency' => ['label' => 'Currency', 'href' => 'currency.php'],
    'compare' => ['label' => 'Compare', 'href' => 'compare.php'],
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

<header class="site-header">
    <div class="container header-layout">
        <a class="brand" href="<?= e(url_for('index.php')); ?>" aria-label="Countries home">
            <span class="brand-text">
                <strong>Traveller</strong>
                <small>Country Info Site</small>
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
