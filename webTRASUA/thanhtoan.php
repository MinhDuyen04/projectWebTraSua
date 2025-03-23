<?php
require_once("connectdb.php"); // Kết nối đến database

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['hoten']) && isset($_POST['dienthoai']) && isset($_POST['diachi']) && isset($_POST['ghichu'])) {
        // Lấy dữ liệu từ form và làm sạch dữ liệu
        $hoten = trim(strip_tags($_POST['hoten']));
        $dienthoai = trim(strip_tags($_POST['dienthoai']));
        $diachi = trim(strip_tags($_POST['diachi']));
        $ghichu = trim(strip_tags($_POST['ghichu']));

        // Chuẩn bị và thực thi truy vấn SQL (sử dụng prepared statements)
        $stmt = $conn->prepare("INSERT INTO information (hoten, dienthoai, diachi, ghichu) VALUES (?, ?, ?, ?)");
        $stmt->bindParam(1, $hoten);
        $stmt->bindParam(2, $dienthoai);
        $stmt->bindParam(3, $diachi);
        $stmt->bindParam(4, $ghichu);

        if ($stmt->execute()) {
            header("Location: camon.php"); 
            exit;
        } else {
            echo "Cập nhật không thành công: " . $stmt->errorInfo()[2]; 
        }
    } else {
        echo "Vui lòng điền đầy đủ thông tin.";
    }
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>Thông Tin Giao Hàng</title>
    <link rel="stylesheet" href="thanhtoan.css">
</head>
<body>
    <header>
        <h1>Thông Tin Giao Hàng</h1>
    </header>

    <section id="thong-tin">
        <h2 style=" font-family: Courier">Vui lòng nhập thông tin của bạn</h2>
        <br>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post"> 
            <label for="hoten">Họ và tên:</label><br>
            <input type="text" id="hoten" name="hoten" required><br><br>

            <label for="dienthoai">Số điện thoại:</label><br>
            <input type="tel" id="dienthoai" name="dienthoai" pattern="[0-9]{10}" required><br><br>

            <label for="diachi">Địa chỉ:</label><br>
            <textarea id="diachi" name="diachi" rows="4" required></textarea><br><br>

            <label for="ghichu">Ghi chú:</label><br>
            <textarea id="ghichu" name="ghichu" rows="2"></textarea><br><br>

            <input type="submit" value="Xác Nhận Đơn Hàng">
        </form>

        <?php if (isset($message)) { echo "<p>$message</p>"; } ?> 
    </section>

    <footer>
        <p>&copy;Trà Sữa DAISY'S TEA</p>
    </footer>
</body>
</html>