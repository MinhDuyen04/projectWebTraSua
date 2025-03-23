<?php
require_once 'connectdb.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $productID = $_POST['id'];
    $price = $_POST['price'];
    $status = $_POST['status'];

    try {
        $sql = "UPDATE products SET price = :price, trangthai = :status WHERE productID = :productID";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':productID', $productID);
        $stmt->execute();

        echo json_encode(['success' => true]);
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    }
}
?>
