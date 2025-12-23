<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Order Detail - StudentStore</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Fonts & Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet">

    <!-- CSS -->
<link rel="stylesheet" href="/SALE_WEB/CSS/order_detail.css">

</head>
<body>

<header class="topbar">
    <div class="brand">
        <div class="brand-icon">
            <span class="material-symbols-outlined">school</span>
        </div>
        <span class="brand-name">StudentStore</span>
    </div>

    <nav class="nav">
        <a href="#">Home</a>
        <a href="#" class="active">Orders</a>
        <a href="#">Profile</a>
    </nav>

    <button class="cart-btn">
        <span class="material-symbols-outlined">shopping_cart</span>
    </button>
</header>

<main class="container">

    <a href="my_orders.php" class="back-link">
        <span class="material-symbols-outlined">arrow_back</span>
        Back to Orders
    </a>

    <!-- ORDER HEADER -->
    <section class="order-header">
        <div>
            <div class="order-title">
                <h1>Order #<?= $order['Id'] ?></h1>
                <span class="status <?= strtolower($order['status']) ?>">
                    <?= ucfirst($order['status']) ?>
                </span>
            </div>
            <p>
                Placed on <?= date('d/m/Y', strtotime($order['Created_at'])) ?>
                • <?= $total_items ?> Items
            </p>
        </div>

        <button class="btn-outline">
            <span class="material-symbols-outlined">download</span>
            Invoice
        </button>
    </section>

    <!-- INFO -->
    <section class="info-grid">
        <div class="card">
            <h3>
                <span class="material-symbols-outlined">local_shipping</span>
                Shipping Details
            </h3>
            <p class="label">Address</p>
            <p>
                <?= htmlspecialchars($order['shipping_address'] ?? 'N/A') ?>
            </p>

            <p class="label">Method</p>
            <p><?= htmlspecialchars($order['shipping_method'] ?? 'Standard') ?></p>
        </div>

        <div class="card">
            <h3>
                <span class="material-symbols-outlined">credit_card</span>
                Payment Details
            </h3>

            <p class="label">Method</p>
            <p><?= htmlspecialchars($order['payment_method'] ?? 'COD') ?></p>

            <p class="label">Billing Address</p>
            <p>Same as shipping address</p>
        </div>
    </section>

    <!-- PRODUCTS TABLE -->
    <section class="table-card">
        <table>
            <thead>
                <tr>
                    <th>Product</th>
                    <th class="right">Price</th>
                    <th class="center">Qty</th>
                    <th class="right">Total</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $subtotal = 0;
                while ($row = $items->fetch_assoc()):
                    $line_total = $row['price'] * $row['quantity'];
                    $subtotal += $line_total;
                ?>
                <tr>
                    <td><?= htmlspecialchars($row['name']) ?></td>
                    <td class="right"><?= number_format($row['price'], 0, ',', '.') ?> ₫</td>
                    <td class="center"><?= $row['quantity'] ?></td>
                    <td class="right"><?= number_format($line_total, 0, ',', '.') ?> ₫</td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

        <div class="summary">
            <div>
                <span>Subtotal</span>
                <span><?= number_format($subtotal, 0, ',', '.') ?> ₫</span>
            </div>
            <div>
                <span>Shipping</span>
                <span>Free</span>
            </div>
            <div class="total">
                <span>Total</span>
                <span><?= number_format($order['Total_price'], 0, ',', '.') ?> ₫</span>
            </div>
        </div>
    </section>

    <p class="help">
        Need help with this order?
        <a href="#">Contact Support</a>
    </p>

</main>

</body>
</html>
