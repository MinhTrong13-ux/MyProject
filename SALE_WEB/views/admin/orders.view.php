<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <title>Admin Dashboard - Orders</title>

  <link rel="stylesheet" href="/SALE_WEB/css/order_list.css">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet">
</head>

<body>
<div class="app">

  <aside class="sidebar">
    <div class="sidebar-header">
      <span class="material-symbols-outlined">hexagon</span>
      <span>AdminPanel</span>
    </div>
    <p><?= htmlspecialchars($admin_email) ?></p>
  </aside>

  <main class="main">
    <header class="header">
      <h1>Orders Management</h1>
    </header>

    <section class="content">
      <div class="table-box">
        <table>
          <thead>
            <tr>
              <th>Order ID</th>
              <th>Customer</th>
              <th>Date</th>
              <th class="right">Total</th>
              <th>Status</th>
              <th class="right">Action</th>
            </tr>
          </thead>
          <tbody>

          <?php if ($result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
              <tr>
                <td><?= $row['Id'] ?></td>
                <td><?= htmlspecialchars($row['Email']) ?></td>
                <td><?= date('d/m/Y', strtotime($row['Created_at'])) ?></td>
                <td class="right">
                    <?= number_format($row['Total_price'], 0, ',', '.') ?> đ
                </td>
                <td>
                  <span class="badge <?= strtolower($row['Status']) ?>">
                    <?= ucfirst($row['Status']) ?>
                  </span>
                </td>
                <td class="right">
                  <a class="btn small"
                    href="/SALE_WEB/api/admin/orders_detail.php?id=<?= $row['Id'] ?>">View detail</a>
                </td>
              </tr>
            <?php endwhile; ?>
          <?php else: ?>
            <tr>
              <td colspan="6">Chưa có đơn hàng</td>
            </tr>
          <?php endif; ?>

          </tbody>
        </table>
      </div>
    </section>
  </main>

</div>
</body>
</html>
