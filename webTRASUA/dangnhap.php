<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .form-container {
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        .form-group label {
            font-weight: bold;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }
    </style>
</head>
<body>

<?php
if (isset($_GET['error']) && $_GET['error'] == 1) {
    echo "<script>alert('Username hoặc Mật khẩu không đúng');</script>";
}
?>

<form action="xulydangnhap.php" method="post" class="form-container col-5 m-auto">
    <div class="form-group">
        <label>Username</label>
        <input name="u" type="text" class="form-control" required />
    </div>
    <div class="form-group">
        <label>Mật khẩu</label>
        <input name="p" type="password" class="form-control" required />
    </div>
    <div class="form-group">
        <input name="nho" type="checkbox" /> Ghi nhớ
    </div>
    <div class="form-group">
        <input name="btn" type="submit" value="Đăng nhập" class="btn btn-primary" />
    </div>
</form>

</body>
</html>