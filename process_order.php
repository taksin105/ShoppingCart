<?php  
session_start();
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['confirm'])) {
    if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
        die("Cart is empty! Please add items before confirming.");
    }

    $userId = 1; // ตัวอย่าง user ID (ต้องเปลี่ยนเป็นระบบ login จริง)
    $totalPrice = 0;
    $orderDetails = [];

    foreach ($_SESSION['cart'] as $id => $quantity) {
        $id = intval($id);
        $quantity = intval($quantity);

        $query = mysqli_query($conn, "SELECT * FROM products WHERE id = $id");
        if ($row = mysqli_fetch_assoc($query)) {
            $price = floatval($row['price']);
            $subtotal = $price * $quantity;
            $totalPrice += $subtotal;

            $orderDetails[] = "('$userId', '$id', '$quantity', '$subtotal')";
        }
    }

    // บันทึกคำสั่งซื้อ
    if (!empty($orderDetails)) {
        $orderQuery = "INSERT INTO orders (user_id, product_id, quantity, total_price) VALUES " . implode(", ", $orderDetails);
        if (mysqli_query($conn, $orderQuery)) {
            echo "Order placed successfully!";
            unset($_SESSION['cart']); // ล้างตะกร้าหลังจากสั่งซื้อเสร็จ
        } else {
            die("Order Error: " . mysqli_error($conn));
        }
    } else {
        die("No valid order details found.");
    }
} else {
    die("Invalid request.");
}
?>
