<?php
session_start();

// Kết nối CSDL
$connect = mysqli_connect('localhost', 'root', '', 'w_login_se06303');
if (!$connect) {
    die("Kết nối thất bại: " . mysqli_connect_error());
}

// Xử lý xóa sản phẩm
if (isset($_GET['remove'])) {
    $product_id = $_GET['remove'];
    unset($_SESSION['cart'][$product_id]);
    echo "<script>alert('Sản phẩm đã được xóa khỏi giỏ hàng!');</script>";
    echo "<script>window.location = 'cart.php';</script>";
}

// Xử lý cập nhật số lượng sản phẩm
if (isset($_POST['update_cart'])) {
    foreach ($_POST['quantity'] as $product_id => $quantity) {
        if ($quantity <= 0) {
            unset($_SESSION['cart'][$product_id]);
        } else {
            $_SESSION['cart'][$product_id] = $quantity;
        }
    }
    echo "<script>alert('Giỏ hàng đã được cập nhật!');</script>";
    echo "<script>window.location = 'cart.php';</script>";
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giỏ Hàng</title>
    <link rel="stylesheet" href="styles.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h1 class="text-center">Giỏ Hàng</h1>
        <?php if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])): ?>
            <form method="POST" action="">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Sản phẩm</th>
                            <th>Hình ảnh</th>
                            <th>Giá</th>
                            <th>Số lượng</th>
                            <th>Tổng</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $total_price = 0;

                        foreach ($_SESSION['cart'] as $product_id => $quantity) {
                            $sql = "SELECT * FROM products WHERE product_id = '$product_id'";
                            $result = mysqli_query($connect, $sql);
                            $row = mysqli_fetch_assoc($result);

                            $subtotal = $row['product_price'] * $quantity;
                            $total_price += $subtotal;

                            echo "
                            <tr>
                                <td>{$row['product_name']}</td>
                                <td><img src='Image/{$row['product_img']}' width='50' height='50'></td>
                                <td>{$row['product_price']} VNĐ</td>
                                <td><input type='number' name='quantity[$product_id]' value='$quantity' class='form-control' style='width: 80px;'></td>
                                <td>{$subtotal} VNĐ</td>
                                <td><a href='?remove=$product_id' class='btn btn-danger'>Xóa</a></td>
                            </tr>";
                        }
                        ?>
                    </tbody>
                </table>
                <h3>Tổng tiền: <?php echo $total_price; ?> VNĐ</h3>
                <button type="submit" name="update_cart" class="btn btn-warning">Cập nhật giỏ hàng</button>
                <a href="checkout.php" class="btn btn-success">Thanh toán</a>
            </form>
        <?php else: ?>
            <h3 class="text-center">Giỏ hàng trống</h3>
            <a href="index.php" class="btn btn-primary">Tiếp tục mua sắm</a>
        <?php endif; ?>
    </div>
</body>
</html>
