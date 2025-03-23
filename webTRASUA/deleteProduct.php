<?php
session_start();

$host = "localhost";
$dbname = "trasuaweb";
$username = "root";
$password = "";

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Connection failed: " . $e->getMessage()); 
}

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_GET['id'])) {
        $productID = $_GET['id'];

        // Chuẩn bị và thực thi truy vấn SQL để xóa sản phẩm
        $stmt = $conn->prepare("DELETE FROM products WHERE productID = ?"); 
        $stmt->bindParam(1, $productID);

        if ($stmt->execute()) {
            // Xóa thành công, lưu thông báo vào session và chuyển hướng
            $_SESSION['success_message'] = "Sản phẩm đã được xóa thành công!";
            header("Location: layout.php?page=admin"); // Thay thế bằng trang đích của bạn
            exit;
        } else {
            echo "Xóa sản phẩm không thành công: " . $stmt->errorInfo()[2];
        }
    } else {
        echo "Không tìm thấy ID sản phẩm.";
    }
}
?>