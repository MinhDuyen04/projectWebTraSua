<?php
session_start();
session_destroy(); // Hủy bỏ toàn bộ phiên
header("Location: layout.php"); // Chuyển hướng về trang layout
exit();
?>
