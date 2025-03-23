<?php
$isLoggedIn = isset($_SESSION['login_id']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daisy's Tea</title>
    <link rel="stylesheet" href="sanpham.css">
</head>

<body>
    <div class="container1">
        <button onclick="topFunction()" id="backToTopBtn" title="Go to top">
            <svg width="20" height="18" viewBox="0 0 24 24">
                <path d="M12 2l-10 10h6v10h8v-10h6z" />
            </svg>
        </button>
        <header>
            <div class="account-menu">
                <?php
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "trasuaweb";
                $connect = new mysqli($servername, $username, $password, $dbname);
                if ($connect->connect_error) {
                    die("Kết nối thất bại: " . $connect->connect_error);
                }

                $userId = 1;
                $sql = "SELECT username FROM users WHERE id_user = $userId";
                $result = $connect->query($sql);

                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $username = $row['username'];
                }
                ?>
            </div>
        </header>

        <div class="row1">
            <main class="col-9">

                <section id="featured">
                    <h2>Món nổi bật</h2>
                    <div class="product-gallery">
                        <?php
                        $sql = "SELECT * FROM products where count >=10 and trangthai = 1";
                        $result = $connect->query($sql);
                        if ($result->num_rows > 0) {
                            $count = 0;
                            while ($row = $result->fetch_assoc()) {
                                $imagePath = ($row["productType"] == "milktea") ? "./pic/TràSữa/" : "./pic/TràTráiCây/";
                                $class = ($count >= 4) ? 'hidden' : '';

                                echo '<div class="item ' . $class . '">';
                                echo '<img src="' . $imagePath . $row["productName"] . '.jpg" class="openModalImg" data-name="' . $row["productName"] . '" data-price="' . $row["price"] . '" data-original-price="' . $row["price"] . '" data-product-id="' . $row["productID"] . '">';
                                echo '<p>' . $row["productName"] . '</p>';
                                echo '<p>Price: ' . $row["price"] . 'd</p>';
                                echo '</div>';

                                $count++;
                            }
                        } else {
                            echo "0 results";
                        }
                        ?>
                    </div>
                    <button class="show-more" data-type="highlight" onclick="toggleItems('featured')">Xem Tất Cả</button>
                </section>

                <section id="milk-tea">
                    <h2>Trà Sữa</h2>
                    <div class="product-gallery">
                        <?php
                        $sql = "Select * from products where trangthai = 1";
                        $result = $connect->query($sql);
                        if ($result->num_rows > 0) {
                            $count = 0;
                            while ($row = $result->fetch_assoc()) {
                                if ($row["productType"] == "milktea") {
                                    $class = ($count >= 4) ? 'hidden' : '';

                                    echo '<div class="item ' . $class . '">';
                                    echo '<img src="./pic/TràSữa/' . $row["productName"] . '.jpg" class="openModalImg" data-name="' . $row["productName"] . '" data-price="' . $row["price"] . '" data-original-price="' . $row["price"] . '" data-product-id="' . $row["productID"] . '">';
                                    echo '<p>' . $row["productName"] . '</p>';
                                    echo '<p>Price: ' . $row["price"] . 'd</p>';
                                    echo '</div>';

                                    $count++;
                                }
                            }
                        } else {
                            echo "0 results";
                        }
                        ?>
                    </div>
                    <button class="show-more" data-type="milktea" onclick="toggleItems('milk-tea')">Xem Tất Cả</button>
                </section>

                <section id="fruit-tea">
                    <h2>Trà Trái Cây</h2>
                    <div class="product-gallery">
                        <?php
                        $sql = "Select * from products where trangthai = 1";
                        $result = $connect->query($sql);
                        if ($result->num_rows > 0) {
                            $count = 0;
                            while ($row = $result->fetch_assoc()) {
                                if ($row["productType"] == "fruittea") {
                                    $class = ($count >= 4) ? 'hidden' : '';

                                    echo '<div class="item ' . $class . '">';
                                    echo '<img src="./pic/TràTráiCây/' . $row["productName"] . '.jpg" class="openModalImg" data-name="' . $row["productName"] . '" data-price="' . $row["price"] . '" data-original-price="' . $row["price"] . '" data-product-id="' . $row["productID"] . '">';
                                    echo '<p>' . $row["productName"] . '</p>';
                                    echo '<p>Price: ' . $row["price"] . 'd</p>';
                                    echo '</div>';

                                    $count++;
                                }
                            }
                        } else {
                            echo "0 results";
                        }
                        $connect->close();
                        ?>
                    </div>
                    <button class="show-more" data-type="fruittea" onclick="toggleItems('fruit-tea')">Xem Tất Cả</button>
                </section>

                <div id="productModal" class="productModal">
                    <div class="modal-content">
                        <div class="modal-image">
                            <img id="modalProductImage" src="" alt="Product Image">
                        </div>
                        <div class="product-details">
                            <span class="close">&times;</span>
                            <h3 id="modalProductName"></h3>
                            <p id="modalProductPrice"></p>
                            <form id="productForm">
                                <label for="size">Chọn Size:</label><br>
                                <input type="radio" id="sizeM" name="size" value="M">
                                <label for="sizeM">Size M</label><br>
                                <input type="radio" id="sizeL" name="size" value="L">
                                <label for="sizeL">Size L</label><br>
                            </form>
                            <button id="addToCartBtn">Thêm vào giỏ hàng</button>
                        </div>
                    </div>
                </div>


            </main>
            <aside class="col-3">
                <form action="layout.php" method="POST">
                    <div class="menu">
                        <ul>
                            <li><a href="#featured">
                                    <div>
                                        <p style="padding-left: 40px; font-weight: bold;"> Món Nổi Bật</p>
                                    </div>
                                </a>
                            </li>
                            <li><a href="#milk-tea">
                                    <div>
                                        <p style="padding-left: 40px; font-weight: bold;"> Trà sữa</p>
                                    </div>
                                </a>
                            </li>
                            <li><a href="#fruit-tea">
                                    <div>
                                        <p style="padding-left: 40px; font-weight: bold;"> Trà trái cây</p>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </div>
                </form>

                <div class="cart-container">
                    <div class="cart-icon">
                        <img src="./pic/icon/giohang.png" alt="Cart" onclick="openCartModal()">
                        <span id="cartBadge" class="cart-badge" style="display: none;">
                            <script>
                                cart.length();
                            </script>
                        </span> <!-- Thêm phần tử này -->
                    </div>
                    <!-- Modal nội dung giỏ hàng -->
                    <div id="cartModal" class="modal1">
                        <div class="modal-content1">
                            <span class="close" onclick="closeCartModal()">&times;</span>
                            <h2>Giỏ hàng</h2>
                            <div id="cartItemsContainer"></div>
                            <p id="emptyCartMessage">Giỏ hàng trống. Bạn hãy chọn món mình thích nhé ❤️</p>
                            <div class="button-container">
                                <button id="goBackToProductsBtn"onclick="goBackToProducts()">Thêm món</button>
                                <button id="placeOrderBtn" onclick="placeOrder()">Thanh toán</button>
                            </div>
                        </div>
                    </div>
                </div>

                
                <script>
                    const isLoggedIn = <?php echo json_encode($isLoggedIn); ?>;
                    console.log("Is Logged In:", isLoggedIn);

                function goBackToProducts() {
                    closeCartModal(); // Đóng modal giỏ hàng trước khi chuyển hướng
                    window.location.href = "layout.php?page=sanpham"; // Thay đổi đường dẫn đến trang sản phẩm của bạn
                }
                </script>
                <script src="sanpham.js"></script>
        </div>
</body>

</html>