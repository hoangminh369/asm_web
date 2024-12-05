<?php
session_start();

// Kết nối CSDL
$connect = mysqli_connect('localhost', 'root', '', 'w_login_se06303');
if (!$connect) {
    die("Kết nối thất bại: " . mysqli_connect_error());
}

// Xử lý thêm vào giỏ hàng
if (isset($_GET['add_cart'])) {
    $product_id = $_GET['add_cart'];

    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    if (isset($_SESSION['cart'][$product_id])) {
        $_SESSION['cart'][$product_id] += 1; // Tăng số lượng sản phẩm nếu đã tồn tại trong giỏ
    } else {
        $_SESSION['cart'][$product_id] = 1; // Thêm sản phẩm mới vào giỏ
    }

    echo "<script>alert('Sản phẩm đã được thêm vào giỏ hàng!');</script>";
    echo "<script>window.location = 'index.php';</script>";
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang Chủ</title>
    <link rel="stylesheet" href="styles.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h1 class="text-center">Danh sách sản phẩm</h1>
        <div class="row">
            <?php
            // Lấy dữ liệu sản phẩm
            $sql = "SELECT * FROM products";
            $result = mysqli_query($connect, $sql);

            while ($row = mysqli_fetch_assoc($result)) {
                echo "
                <div class='col-md-4'>
                    <div class='card'>
                        <img src='Image/{$row['product_img']}' class='card-img-top' alt='{$row['product_name']}'>
                        <div class='card-body'>
                            <h5 class='card-title'>{$row['product_name']}</h5>
                            <p class='card-text'>Giá: {$row['product_price']} VNĐ</p>
                            <a href='?add_cart={$row['product_id']}' class='btn btn-primary'>Thêm vào giỏ</a>
                        </div>
                    </div>
                </div>";
            }
            ?>
        </div>
    </div>
    <a href="cart.php" class="btn btn-success mt-4">Xem Giỏ Hàng</a>
</body>
</html>
