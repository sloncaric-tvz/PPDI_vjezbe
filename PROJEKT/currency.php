<?php
$pageTitle = 'Currency | Travel Cost & Country Info';
$activePage = 'currency';
require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/api_client.php';

$from = strtoupper(trim($_GET['from'] ?? 'EUR'));
$to = strtoupper(trim($_GET['to'] ?? 'JPY'));
$amount = $_GET['amount'] ?? '100';
$exchangeUrl = build_exchange_rate_url($from, $to);
?>

<section class="container page-header">
    <p class="eyebrow">REST API</p>
    <h1>Currency converter</h1>
    <p>
        Use this page to call the Frankfurter REST API, retrieve an exchange rate,
        and calculate a converted travel budget.
    </p>
</section>

<section class="container section-stack">
    <form class="filter-form" method="get" action="currency.php">
        <div class="form-row">
            <label for="amount">Amount</label>
            <input type="number" id="amount" name="amount" min="1" step="0.01" value="<?= e($amount); ?>">
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
        <h2><!-- TODO: Calculated conversion result --> <?= e($amount); ?> <?= e($from); ?> = API result <?= e($to); ?></h2>
        <p>
            Replace this placeholder with the value returned from <code>get_exchange_rate()</code>
            multiplied by the entered amount.
        </p>
    </div>
</section>

<section class="container section-stack">
    <div class="code-panel">
        <h2>Exchange-rate REST URL</h2>
        <pre><code><?= e($exchangeUrl); ?></code></pre>
        <p>
            Frankfurter returns a single exchange rate for this pair. Your PHP code should decode the JSON response
            and multiply the returned rate by the amount entered above.
        </p>
    </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
