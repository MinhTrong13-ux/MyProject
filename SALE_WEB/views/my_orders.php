<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Orders - Student Shop</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Fonts & Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet">

    <!-- CSS -->
<link rel="stylesheet" href="/SALE_WEB/CSS/my_orders.css">

</head>
<body>

<header class="topbar">
    <div class="brand">
        <span class="material-symbols-outlined logo">local_mall</span>
        <h2>Student Shop</h2>
    </div>

    <nav class="nav">
        <a href="#">Home</a>
        <a href="#">Shop</a>
        <a href="#">About</a>
        <a href="#">Contact</a>
    </nav>

    <div class="user">
        <button class="logout">Log Out</button>
        <div class="avatar"></div>
    </div>
</header>

<main class="container">
    <section class="page-header">
        <h1>My Orders</h1>
        <p>View and track your past purchases.</p>
    </section>

    <section class="table-card">
        <table>
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Total Price</th>
                    <th>Status</th>
                    <th>Created Date</th>
                    <th class="right">Action</th>
                </tr>
            </thead>
            <tbody>

                <?php if (empty($orders)): ?>
                    <tr>
                        <td colspan="5" style="text-align:center;">
                            Bạn chưa có đơn hàng nào
                        </td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($orders as $order): ?>
                        <tr>
                            <td>#<?= $order['Id'] ?></td>

                            <td>
                                <?= number_format($order['Total_price'], 0, ',', '.') ?> ₫
                            </td>

                            <td>
                                <span class="badge <?= strtolower($order['status']) ?>">
                                    <?= ucfirst($order['status']) ?>
                                </span>
                            </td>

                            <td>
                                <?= date('d/m/Y', strtotime($order['Created_at'])) ?>
                            </td>

                            <td class="right">
                                <a href="../order/order_detail.php?id=<?= $order['Id'] ?>">
                                    View details →
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>

            </tbody>
        </table>
    </section>

    <div class="pagination">
        <a href="#">‹</a>
        <a href="#" class="active">1</a>
        <a href="#">2</a>
        <a href="#">3</a>
        <span>…</span>
        <a href="#">›</a>
    </div>
</main>

<footer class="footer">
    <div class="footer-links">
        <a href="#">Privacy Policy</a>
        <a href="#">Terms of Service</a>
        <a href="#">Support</a>
    </div>
    <p>© 2023 Student Shop Project. All rights reserved.</p>
</footer>

</body>
</html>
