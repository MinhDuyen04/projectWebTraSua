<?php
session_start();

$u = $_POST['u'];
$p = $_POST['p'];

$u = trim(strip_tags($u));
$p = trim(strip_tags($p));

require_once("connectdb.php");

// Truy vấn để lấy thông tin người dùng, bao gồm cả typeuser
$sql = "SELECT id_user, username, typeuser FROM users WHERE username = :username AND password = :password";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':username', $u);
$stmt->bindParam(':password', $p);
$stmt->execute();
$numrows_user = $stmt->rowCount();

if ($numrows_user == 1) {
    $row_user = $stmt->fetch();
    
    // Lưu thông tin người dùng vào session
    $_SESSION['login_id'] = $row_user['id_user'];
    $_SESSION['login_user'] = $row_user['username'];
    $_SESSION['typeuser'] = $row_user['typeuser']; // Lưu typeuser vào session
    
    // Chuyển hướng tới trang layout
    header("location: layout.php");
    exit();
} else {
    // Chuyển hướng lại trang đăng nhập với thông báo lỗi
    header("location: dangnhap.php?error=1");
    exit();
}
?>
