<?php
$host = "localhost";
$dbname = "trasuaweb";
$username = "root";
$password = "";

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

function laymonnoibat($connect) {
    $sql = "SELECT * FROM products WHERE count >= 10";                    
    $result = $connect->query($sql);
    if ($result->num_rows > 0) {
        $count = 0;
        while ($row = $result->fetch_assoc()) {
            if ($row["productType"] == "milktea") {
                if ($count >= 4) {
                    echo '<div class="item hidden">';
                    echo '<img src="./pic/TràSữa/' . $row["productName"] . '.jpg" class="openModalImg" data-name="' . $row["productName"] . '" data-price="' . $row["price"] . '" data-product-id="' . $row["productID"] . '">';
                    echo '<p>' . $row["productName"] . '</p>';
                    echo '<p>Price: ' . $row["price"] . 'd</p>';
                    echo '</div>';
                } else {
                    echo '<div class="item">';
                    echo '<img src="./pic/TràSữa/' . $row["productName"] . '.jpg" class="openModalImg" data-name="' . $row["productName"] . '" data-price="' . $row["price"] . '" data-product-id="' . $row["productID"] . '">';
                    echo '<p>' . $row["productName"] . '</p>';
                    echo '<p>Price: ' . $row["price"] . 'd</p>';
                    echo '</div>';
                }
                $count++;
            } else {
                if ($count >= 4) {
                    echo '<div class="item hidden">';
                    echo '<img src="./pic/TràTráiCây/' . $row["productName"] . '.jpg" class="openModalImg" data-name="' . $row["productName"] . '" data-price="' . $row["price"] . '" data-product-id="' . $row["productID"] . '">';
                    echo '<p>' . $row["productName"] . '</p>';
                    echo '<p>Price: ' . $row["price"] . 'd</p>';
                    echo '</div>';
                } else {
                    echo '<div class="item">';
                    echo '<img src="./pic/TràTráiCây/' . $row["productName"] . '.jpg" class="openModalImg" data-name="' . $row["productName"] . '" data-price="' . $row["price"] . '" data-product-id="' . $row["productID"] . '">';
                    echo '<p>' . $row["productName"] . '</p>';
                    echo '<p>Price: ' . $row["price"] . 'd</p>';
                    echo '</div>';
                }
                $count++;
            }
        }
    } else {
        echo "0 results";
    }
}
?>
