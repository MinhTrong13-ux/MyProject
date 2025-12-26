<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Product Inventory</title>

    <link rel="stylesheet" href="/SALE_WEB/css/products.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
</head>
<body>

<div class="layout">

    <!-- SIDEBAR -->
    <aside class="sidebar">
        <h3>Admin Panel</h3>
        <p><?= htmlspecialchars($admin_email ?? 'admin@store.com') ?></p>

        <nav>
            <a href="../dashboard.php">Dashboard</a>
            <a class="active" href="products.php">Products</a>
            <a href="../orders.php">Orders</a>
            <a href="../users.php">Users</a>
        </nav>
    </aside>

    <!-- MAIN -->
    <main class="main">

        <div class="top">
            <h1>Products</h1>
            <a href="/SALE_WEB/views/admin/add_product.php" class="btn-primary">Add Product</a>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Stock</th>
                    <th>Created</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
            <?php if (isset($result) && $result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td>
                            <?php if (!empty($row['Image'])): ?>
                                <img src="/SALE_WEB/images/<?= htmlspecialchars($row['Image']) ?>" width="60">
                            <?php else: ?>
                                No image
                            <?php endif; ?>
                        </td>

                        <td><?= htmlspecialchars($row['Name']) ?></td>

                        <td><?= number_format($row['Price'], 0, ',', '.') ?> đ</td>

                        <td><?= $row['Stock'] ?? 0 ?></td>

                        <td>
                            <?= isset($row['Created_at']) 
                                ? date('d/m/Y', strtotime($row['Created_at'])) 
                                : '' ?>
                        </td>

                        <td>
                            <a href="edit_product.php?id=<?= $row['Id'] ?>">Edit</a>
                            |
                            <a href="../../api/admin/product_delete.php?id=<?= $row['Id'] ?>"
                               onclick="return confirm('Xóa sản phẩm này?')"
                               class="danger">
                               Delete
                            </a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6">Chưa có sản phẩm</td>
                </tr>
            <?php endif; ?>
            </tbody>
        </table>

    </main>
</div>

</body>
</html>
