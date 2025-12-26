<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    die('Bạn không có quyền truy cập');
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Add Product</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet">

    <link rel="stylesheet" href="/SALE_WEB/css/add_product.css">
</head>
<body>

<div class="layout">

    <!-- SIDEBAR -->
    <aside class="sidebar">
        <h2 class="logo">AdminPanel</h2>
        <nav>
           <a href="dashboard.php">Dashboard</a>
<a class="active" href="/SALE_WEB/api/admin/products.php">Products</a>
<a href="/SALE_WEB/api/admin/orders.php">Orders</a>
<a href="users.php">Users</a>

        </nav>
        <a class="logout" href="../../api/auth/logout.php">Logout</a>
    </aside>

    <!-- MAIN -->
    <main class="main">

        <header class="topbar">
            <h1>Add New Product</h1>
            <div class="user"><?= htmlspecialchars($_SESSION['email'] ?? 'Admin') ?></div>
        </header>

        <section class="content">

            <!-- FORM -->
            <form action="../../api/admin/product_store.php"
                  method="POST"
                  enctype="multipart/form-data">

                <div class="page-header">
                    <div>
                        <h2>Add New Product</h2>
                        <p>Fill in product information</p>
                    </div>
                    <div class="actions">
                        <a href="products.php" class="btn-outline">Cancel</a>
                        <button type="submit" class="btn-primary">Save Product</button>
                    </div>
                </div>

                <div class="form-layout">

        
               <!-- LEFT -->
<div class="card">
    <h3>General Information</h3>

    <label>Product Name</label>
    <input type="text" name="name" required>

    <div class="row">
        <div>
            <label>Price</label>
            <input type="number" name="price" step="0.01" required>
        </div>
        <div>
            <label>Stock</label>
            <input type="number" name="stock"  min="0">
        </div>
    </div>

    <label>Description</label>
    <textarea name="description" rows="5"></textarea>
</div>

<!-- RIGHT -->
<div class="card">
    <h3>Product Image</h3>

    <div class="upload-box">
        <span class="material-symbols-outlined">cloud_upload</span>
        <p>Upload image</p>
        <input type="file" name="image" accept="image/*" required>
    </div>
</div>

            </form>

        </section>
    </main>
</div>

</body>
</html>
