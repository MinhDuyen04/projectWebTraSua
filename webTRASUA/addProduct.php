<?php
require_once 'connectdb.php';

// Xử lý khi form được submit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $productName = $_POST["productName"];
    $productType = $_POST["productType"];
    $price = $_POST["price"];
    $count = 0; // Mặc định số lượng là 0
    $trangthai = $_POST["trangthai"];

    // Kiểm tra dữ liệu đầu vào
    $errors = []; 

    // Kiểm tra tên sản phẩm không chứa số
    if (preg_match('/\d/', $productName)) {
        $errors[] = "Tên sản phẩm không được chứa số.";
    }

    // Kiểm tra giá chỉ chứa số
    if (!is_numeric($price)) {
        $errors[] = "Giá phải là một số.";
    }

    // Nếu không có lỗi, thực hiện thêm sản phẩm vào cơ sở dữ liệu
    if (empty($errors)) {
        // Sử dụng prepared statements để ngăn chặn SQL Injection
        $sql = "INSERT INTO products (productName, productType, price, count, trangthai) 
                VALUES (:productName, :productType, :price, :count, :trangthai)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':productName', $productName);
        $stmt->bindParam(':productType', $productType);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':count', $count);
        $stmt->bindParam(':trangthai', $trangthai);

        if ($stmt->execute()) {
            $_SESSION['success_message'] = "Sản phẩm mới đã được thêm thành công!";
        } else {
            echo "Lỗi: " . $stmt->errorInfo()[2]; 
        }
    } else {
        // Hiển thị các lỗi
        foreach ($errors as $error) {
            echo "<p style='color: red;'>$error</p>";
        }
    }
}

// Đóng kết nối 
$conn = null; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý sản phẩm - Daisy's Tea</title>
    <link rel="stylesheet" href="addProduct.css"> 
</head>
<body>
<div class="container2">
        <div class="content2">
            <h1>Quản Lý Sản Phẩm Daisy's Tea</h1>
        </div>

        <h2>Thêm Sản Phẩm Mới</h2>
        <form method="post" action="">
            <label for="productName">Tên sản phẩm:</label><br>
            <input type="text" id="productName" name="productName" required
                pattern="[^\d]+" title="Tên sản phẩm không được chứa số."><br>

            <label for="price">Giá:</label><br>
            <input type="number" id="price" name="price" min="0" required><br>

            <label>Loại sản phẩm:</label><br>
            <div class="radio-group">
                <input type="radio" id="milktea" name="productType" value="milktea" required>
                <label for="milktea">Trà sữa</label>

                <input type="radio" id="fruittea" name="productType" value="fruittea" required>
                <label for="fruittea">Trà trái cây</label>
            </div>


            <label>Trạng thái:</label><br>
            <select id="trangthai" name="trangthai" required>
                <option value="1">Còn hàng</option>
                <option value="0">Hết hàng</option>
            </select><br><br>

            <div class="button-group">
                <input type="button" value="Hủy" onclick="window.location.href='layout.php?page=admin';">
                <input type="submit" value="Thêm sản phẩm">
            </div>
        </form>
    </div>

    <script>
        <?php if (isset($_SESSION['success_message'])): ?>
            window.onload = function() {
                alert("<?php echo $_SESSION['success_message']; ?>");
                <?php unset($_SESSION['success_message']); ?> 
            };
        <?php endif; ?>
    </script>

</body>
</html>