<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Order Detail - Admin</title>

    <link rel="stylesheet" href="/SALE_WEB/css/orders_detail.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>

<div class="layout">

    <aside class="sidebar">
        <h2 class="logo">ShopAdmin</h2>
        <nav>
            <a href="/SALE_WEB/api/admin/dashboard.php">Dashboard</a>
            <a href="/SALE_WEB/api/admin/products.php">Products</a>
            <a class="active" href="/SALE_WEB/api/admin/orders.php">Orders</a>
            <a href="#">Users</a>
        </nav>
    </aside>

    <div class="main">

        <header class="header">
            <h1>Order <?= $order['Id'] ?></h1>
        </header>

        <main class="content">

            <!-- ORDER ITEMS -->
            <section class="card">
                <h3>Order Items</h3>

                <table>
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php while ($item = $items->fetch_assoc()): ?>
                        <tr>
                            <td><?= htmlspecialchars($item['Name']) ?></td>
                            <td><?= number_format($item['Price'], 0, ',', '.') ?> đ</td>
                            <td><?= $item['Quantity'] ?></td>
                            <td>
                                <?= number_format($item['Price'] * $item['Quantity'], 0, ',', '.') ?> đ
                            </td>
                        </tr>
                    <?php endwhile; ?>
                    </tbody>
                </table>

                <div class="total">
                    <strong>
                        Total: <?= number_format($order['Total_price'], 0, ',', '.') ?> đ
                    </strong>
                </div>
            </section>

            <!-- CUSTOMER -->
            <section class="card">
                <h3>Customer Details</h3>
                <p><strong><?= htmlspecialchars($order['Name']) ?></strong></p>
                <p>Email: <?= htmlspecialchars($order['Email']) ?></p>
                <p>Phone: <?= htmlspecialchars($order['Phone']) ?></p>
            </section>

            <!-- ADDRESS -->
            <section class="card">
                <h3>Shipping Address</h3>
                <p><?= nl2br(htmlspecialchars($order['Address'])) ?></p>
            </section>

        </main>
    </div>
</div>

</body>
</html>
