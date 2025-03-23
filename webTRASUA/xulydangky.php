<?php
// Kiểm tra xem form đã được submit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy dữ liệu từ form và làm sạch cơ bản (chống XSS)
    $u = trim(strip_tags($_POST['username']));
    $pass = $_POST['pass']; // Không nên làm sạch mật khẩu ở đây, sẽ xử lý sau
    $repass = $_POST['repass'];
    $phone = trim(strip_tags($_POST['phone']));

    $loi = "";

    // Kiểm tra các trường trống
    if (empty($u) || empty($pass) || empty($repass) || empty($phone)) {
        $loi .= "Hãy nhập đầy đủ các thông tin.<br>";
    }

    // Kiểm tra mật khẩu khớp
    if ($pass != $repass) {
        $loi .= "Mật khẩu không khớp.<br>";
    }

    // Nếu không có lỗi, tiến hành kiểm tra trong CSDL và thêm người dùng
    if (empty($loi)) {
        require_once 'connectdb.php'; // Kết nối đến CSDL

        try {
            // Kiểm tra tên người dùng đã tồn tại chưa
            $stmt = $conn->prepare("SELECT username FROM users WHERE username = ?");
            $stmt->bindParam(1, $u);
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                $loi .= "Tên truy cập đã tồn tại.<br>";
            }

            // Kiểm tra số điện thoại đã tồn tại chưa
            $stmt = $conn->prepare("SELECT phone FROM users WHERE phone = ?");
            $stmt->bindParam(1, $phone);
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                $loi .= "Số điện thoại đã tồn tại.<br>";
            }

            // Nếu không có lỗi, thêm người dùng mới
            if (empty($loi)) {
                
                

                $stmt = $conn->prepare("INSERT INTO users (username, password, phone) VALUES (?, ?, ?)");
                $stmt->bindParam(1, $u);
                $stmt->bindParam(2, $pass);
                $stmt->bindParam(3, $phone);

                if ($stmt->execute()) {
                    header("Location: dangnhap.php");
                    exit;
                } else {
                    $loi .= "Cập nhật không thành công. Vui lòng thử lại sau.<br>";
                }
            }
        } catch (PDOException $e) {
            $loi .= "Lỗi truy vấn CSDL: " . $e->getMessage() . "<br>"; // Hiển thị thông báo lỗi chi tiết hơn
        }
    }
}
?>

<?php
if (!empty($loi)) {
?>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <div class="col-8 m-auto">
        <div class="alert alert-danger mt-5 text-center">
            <?= $loi ?>
            <button class="btn btn-primary" onclick="history.back()">Trở lại</button>
        </div>
    </div>
<?php } 
?>