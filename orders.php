<?php
session_start();
include 'config.php';

// ตรวจสอบการเชื่อมต่อฐานข้อมูล
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// ดึงข้อมูลคำสั่งซื้อ
$query = mysqli_query($conn, "SELECT * FROM orders");

// ตรวจสอบว่ามีคำสั่งซื้อหรือไม่
$rows = mysqli_num_rows($query);
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>รายการสั่งซื้อ</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to right,rgb(126, 36, 224),rgb(26, 177, 125)); /* สีพื้นหลังไล่เฉด */
            font-family: 'Arial', sans-serif;
            color: white;
        }
        .container {
            background: white;
            border-radius: 15px;
            padding: 20px;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.2);
            margin-top: 50px;
        }
        .table {
            border-radius: 10px;
            overflow: hidden;
        }
        .table th {
            background: #343a40; /* สีหัวตาราง */
            color: white;
        }
        .table tbody tr:nth-child(even) {
            background: #f8f9fa;
        }
        .btn-primary {
            background: #007bff;
            border: none;
            border-radius: 20px;
            transition: 0.3s;
        }
        .btn-primary:hover {
            background: #0056b3;
        }
    </style>
</head>
<body>
<?php include 'include/menu.php'; ?>
<div class="container">
    <h2 class="text-center mb-4 text-dark">📦 รายการสั่งซื้อทั้งหมด</h2>

    <table class="table table-bordered table-striped text-center">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>📅 วันที่สั่งซื้อ</th>
                <th>👤 ชื่อผู้สั่ง</th>
                <th>📧 Email</th>
                <th>📞 เบอร์โทร</th>
                <th>💰 ราคารวม</th>
                <th>🔍 รายละเอียด</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($rows > 0): ?>
                <?php while ($row = mysqli_fetch_assoc($query)): ?>
                    <tr>
                        <td><?= $row['id'] ?></td>
                        <td><?= date("d/m/Y H:i", strtotime($row['order_date'])) ?></td>
                        <td><?= htmlspecialchars($row['fullname']) ?></td>
                        <td><?= htmlspecialchars($row['email']) ?></td>
                        <td><?= $row['tel'] ?></td>
                        <td><?= number_format($row['grand_total'], 2) ?> บาท</td>
                        <td><a href="order_details.php?order_id=<?= $row['id'] ?>" class="btn btn-primary btn-sm">ดูรายละเอียด</a></td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr><td colspan="7" class="text-center text-muted">ไม่มีคำสั่งซื้อ</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

</body>
</html>
