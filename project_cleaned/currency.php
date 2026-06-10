<?php
$pageTitle = 'Currency | Travel Cost & Country Info';
$activePage = 'currency';
require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/api_client.php';

$from = strtoupper(trim($_GET['from'] ?? 'EUR'));
$to = strtoupper(trim($_GET['to'] ?? 'JPY'));
$amount = $_GET['amount'] ?? '1';

if ($from == $to) {
    $exchangeRate = 1;
} else {
    $exchangeUrl = build_exchange_rate_url($from, $to);
    $exchangeRate = get_exchange_rate($from, $to);
}
?>

<section class="container page-header">
    <p class="eyebrow">REST API</p>
    <h1>Currency converter</h1>
    <p>
        This page calls the Frankfurter REST API, retrieves an exchange rate,
        and calculates a converted travel budget.
    </p>
</section>

<section class="container section-stack">
    <form class="filter-form" method="get" action="currency.php">
        <div class="form-row">
            <label for="amount">Amount</label>
            <input type="number" id="amount" name="amount" min="1" step="0.1" value="<?= e($amount); ?>">
        </div>

        <div class="form-row">
            <label for="from">From</label>
            <input type="text" id="from" name="from" maxlength="3" value="<?= e($from); ?>">
        </div>

        <div class="form-row">
            <label for="to">To</label>
            <input type="text" id="to" name="to" maxlength="3" value="<?= e($to); ?>">
        </div>

        <button class="button button-primary" type="submit">Convert</button>
    </form>
</section>

<section class="container section-stack">
    <div class="result-panel">
        <p class="eyebrow">Conversion result</p>
        <h2><?= e(number_format($amount, 2)); ?> <?= e($from); ?> = <?= e(number_format($exchangeRate * $amount, 2)); ?> <?= e($to); ?></h2>
        <p>
            Exchange rate: 1 <?= e($from); ?> = <?= e(number_format($exchangeRate, 4)); ?> <?= e($to); ?>
        </p>
    </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
