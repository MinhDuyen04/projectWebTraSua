<?php
require_once 'connectdb.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $productID = isset($_POST['id']) ? intval($_POST['id']) : 0;
    $currentState = isset($_POST['currentState']) ? intval($_POST['currentState']) : 0;

    if ($productID > 0) {
        try {
            $newState = $currentState == 1 ? 0 : 1;
            $sql = "UPDATE products SET trangthai = :newState WHERE productID = :productID";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':newState', $newState, PDO::PARAM_INT);
            $stmt->bindParam(':productID', $productID, PDO::PARAM_INT);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false, 'message' => 'Cập nhật trạng thái không thành công.']);
            }
        } catch (PDOException $e) {
            echo json_encode(['success' => false, 'message' => 'Lỗi: ' . $e->getMessage()]);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'ID sản phẩm không hợp lệ.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Yêu cầu không hợp lệ.']);
}
?>
