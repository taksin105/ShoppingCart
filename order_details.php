<?php
session_start();
include 'config.php';

// ตั้งค่า base URL
$base_url = "https://hosting.udru.ac.th/its66040233148/all_in_one/shoppingcart";

// ตรวจสอบว่ามี order_id
if (!isset($_GET['order_id'])) {
    die("Order not found");
}

$order_id = intval($_GET['order_id']);

// ดึงข้อมูลคำสั่งซื้อพร้อมรูปสินค้า
$query = mysqli_query($conn, 
    "SELECT od.*, p.profile_image 
    FROM order_details od 
    LEFT JOIN products p ON od.product_id = p.id 
    WHERE od.order_id = $order_id"
);

$total_price = 0;
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>รายละเอียดคำสั่งซื้อ</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to right, #ffafbd, #ffc3a0); /* สีพื้นหลังไล่เฉด */
            font-family: 'Arial', sans-serif;
        }
        .container {
            background: white;
            border-radius: 15px;
            padding: 20px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            margin-top: 50px;
        }
        .table {
            border-radius: 10px;
            overflow: hidden;
        }
        .table th {
            background: #6c757d;
            color: white;
            border-radius: 0px;
        }
        .table tbody tr:nth-child(even) {
            background: #f8f9fa;
        }
        .table-warning {
            background: #ffcc80 !important;
        }
        .btn-secondary {
            background: #6c757d;
            border-radius: 25px;
            padding: 10px 20px;
            transition: 0.3s;
        }
        .btn-secondary:hover {
            background: #5a6268;
        }
        img {
            border-radius: 10px;
        }
    </style>
</head>
<body>

<div class="container">
    <h2 class="text-center mb-4 text-dark">รายละเอียดคำสั่งซื้อ #<?= $order_id ?></h2>

    <table class="table table-bordered table-striped text-center">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>⌛รูปสินค้า</th>
                <th>♞ชื่อสินค้า</th>
                <th>⚡ราคา (บาท)</th>
                <th>📦จำนวน</th>
                <th>💰ราคารวม</th>
            </tr>
        </thead>
        <tbody>
            <?php if (mysqli_num_rows($query) > 0): ?>
                <?php while ($row = mysqli_fetch_assoc($query)): ?>
                    <?php $total_price += $row['total']; ?>
                    <tr>
                        <td><?= $row['product_id'] ?></td>
                        <td>
                            <img src="<?= $base_url; ?>/upload_image/<?= !empty($row['profile_image']) ? htmlspecialchars($row['profile_image']) : 'default.png'; ?>" 
                                 style="width: 100px; height: 100px; object-fit: cover;">
                        </td>
                        <td><?= htmlspecialchars($row['product_name']) ?></td>
                        <td><?= number_format($row['price'], 2) ?></td>
                        <td><?= $row['quantity'] ?></td>
                        <td><?= number_format($row['total'], 2) ?> บาท</td>
                    </tr>
                <?php endwhile; ?>
                <tr class="table-warning">
                    <td colspan="5" class="text-end"><strong>ราคารวมทั้งหมด:</strong></td>
                    <td><strong><?= number_format($total_price, 2) ?> บาท</strong></td>
                </tr>
            <?php else: ?>
                <tr><td colspan="6" class="text-center text-muted">ไม่มีรายการสินค้า</td></tr>
            <?php endif; ?>
        </tbody>
    </table>

    <div class="text-center mt-4">
        <a href="orders.php" class="btn btn-secondary">กลับไปหน้ารายการสั่งซื้อ</a>
    </div>
</div>

</body>
</html>
