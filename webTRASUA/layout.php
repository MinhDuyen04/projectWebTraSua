<?php
session_start(); 

// Kiểm tra xem người dùng đã đăng nhập chưa
if (isset($_SESSION['login_user'])) {
    $username = $_SESSION['login_user'];
    $typeuser = $_SESSION['typeuser']; // Lấy typeuser từ session
} 

$isAdmin = isset($_SESSION['login_user']) && isset($_SESSION['typeuser']) && $_SESSION['typeuser'] === 'admin';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daisy's Tea</title>
    <link rel="stylesheet" href="layout.css">
    <style>
        .admin-only {
            display: none;
        }

        /* Hiển thị mục admin-only nếu typeuser là admin */
        <?php if ($isAdmin): ?>
            .admin-only {
                display: block; /* Hiển thị mục Quản trị */
            }
        <?php endif; ?>
    </style>
</head>
<body>
    <div class="container">
    <header class="row">
    <div class="logo">
        <a href="layout.php">
            <img src="./pic/logo.jpg" alt="Logo" />
        </a>
    </div>

    <?php
    if (isset($username)) {
        // Nếu người dùng đã đăng nhập
        echo '
        <div class="account-info">
            <img src="./pic/icon/acc.png" alt="Account Icon" class="account-icon" onclick="toggleLogoutMenu()">
            <span class="username">' . htmlspecialchars($username) . '</span>
        </div>

        <div class="logout-menu" id="logoutMenu">
            <ul>';
                if ($isAdmin) {
                    echo '<li class="admin-only"><a href="layout.php?page=admin" class="admin-button">Quản trị</a></li>';
                }
                echo '<li><a href="logout.php" class="logout-button">Đăng Xuất</a></li>
            </ul>
        </div>';
    } else {
        // Nếu người dùng chưa đăng nhập hoặc đã đăng xuất
        echo '
        <div class="auth-buttons">
            <a href="dangnhap.php" class="login-button">Đăng Nhập</a>
            <a href="dangky.php" class="register-button">Đăng Ký</a>
        </div>';
    }
    ?>
    </header>

        <nav class="row">
        <ul>
            <li><a href="layout.php?page=home">Trang chủ</a></li>
            <li><a href="layout.php?page=sanpham">Sản phẩm</a></li>
            <li><a href="layout.php?page=gioithieu">Giới thiệu</a></li>
            <li><a href="layout.php?page=lienhe">Liên hệ</a></li>
        </ul>
        </nav>

        <div class="row">
            <main class="col-9">
                <?php
                    require_once 'connectdb.php';

                    $page = isset($_GET['page']) ? trim(strip_tags($_GET['page'])) : "";

                    switch ($page) {
                        case "trangchu":
                            require_once 'layout.php';
                            break;
                        case "lienhe":
                            require_once 'lienhe.php';
                            break;
                        case "gioithieu":
                            require_once 'gioithieu.php';
                            break;
                        case "sanpham":
                            require_once 'sanpham.php';
                            break;
                        case "admin":
                            require_once 'admin.php';
                            break;
                        case "addProduct":
                            require_once 'addProduct.php';
                            break;
                        default:
                            require_once 'home.php';
                            break;
                    }
                ?>
            </main>
        </div>
        <footer class="row">
        <div class="contact-details">
            <div>
                <h2>Số Điện Thoại</h2>
                <p>📞 Hotline: 02251120412   -   02251120377</p>
            </div>
            <div>
                <h2>Email</h2>
                <p>✉️ Email: <a href="mailto:2251120412@ut.edu.vn">2251120412@ut.edu.vn</a>     -     <a href="mailto:2251120377@ut.edu.vn">2251120377@ut.edu.vn</a></p>
            </div>
            <div>
                <h2>Địa Chỉ</h2>
                <p>🏠 70 Tô Ký, Phường Tân Chánh Hiệp, Quận 12, TP. Hồ Chí Minh</p>
            </div>
        </div>
        </footer>

    </div>
   
    <script src="layout.js"></script>

</body>
</html>
