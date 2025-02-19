<?php
// เชื่อมต่อกับฐานข้อมูล
$servername = "localhost";
$username = "root";
$password = "";
$database = "shoppingcart";

$conn = mysqli_connect($servername, $username, $password, $database);

// ตรวจสอบการเชื่อมต่อ
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// ดึงข้อมูลสินค้าในตะกร้าจากฐานข้อมูล
$sql = "SELECT * FROM cart";  // สมมติว่ามีตารางชื่อ cart
$result = mysqli_query($conn, $sql);

// ตรวจสอบว่ามีข้อมูลในตะกร้าหรือไม่
if (mysqli_num_rows($result) > 0) {
    // สร้างตารางเพื่อแสดงสินค้าในตะกร้า
    echo "<div class='cart-container'>";
    echo "<h2>Your Shopping Cart</h2>";
    echo "<table class='cart-table'>";
    echo "<tr><th>Product Name</th><th>Price</th><th>Quantity</th><th>Total</th></tr>";
    
    // แสดงข้อมูลสินค้าแต่ละชิ้น
    while($row = mysqli_fetch_assoc($result)) {
        $total = $row['price'] * $row['quantity'];
        echo "<tr>";
        echo "<td>" . $row['product_name'] . "</td>";
        echo "<td>" . $row['price'] . "</td>";
        echo "<td>" . $row['quantity'] . "</td>";
        echo "<td>" . $total . "</td>";
        echo "</tr>";
    }
    
    echo "</table>";

    // คำนวณราคารวม
    $sql_total = "SELECT SUM(price * quantity) AS total_amount FROM cart";
    $total_result = mysqli_query($conn, $sql_total);
    $total_row = mysqli_fetch_assoc($total_result);
    echo "<h3>Total Amount: " . $total_row['total_amount'] . "</h3>";
    
    echo "</div>";
} else {
    echo "<p class='empty-cart'>Your cart is empty.</p>";
}

mysqli_close($conn);
?>
