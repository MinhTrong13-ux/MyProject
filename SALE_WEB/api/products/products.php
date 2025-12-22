<?php
require_once __DIR__ . '/../config/db.php';

$result = $conn ->query("SELECT * FROM Products");
?>

<?php 
while ($row = $result->fetch_assoc()) : ?>
<div>
    <h3><?= $row['Name'] ?></h3>
    <p><?=number_format($row['Price']) ?> đ</p>
    <form action="/SALE_WEB/api/cart/cart_add.php" method="POST">
            <input type="hidden" name="product_id" value="<?= $row['Id'] ?>">
            <button type="submit">Thêm vào giỏ</button>
    </form>
</div>
<?php endwhile; ?>