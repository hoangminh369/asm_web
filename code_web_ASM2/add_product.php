<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm sản phẩm</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        form {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            width: 400px;
        }
        table {
            width: 100%;
        }
        table tr td {
            padding: 10px;
        }
        input[type="text"],
        input[type="file"],
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
        h2 {
            text-align: center;
            color: #333;
        }
    </style>

</head>
<body>
    <form action="" method="POST" enctype="multipart/form-data">
        <table>
            <tr>
                <td>Mã sản phẩm:</td>
                <td><input type="text" name="product_id" required></td>
            </tr>
            <tr>
                <td>Tên sản phẩm:</td>
                <td><input type="text" name="product_name" required></td>
            </tr>
            <tr>
                <td>Giá sản phẩm:</td>
                <td><input type="text" name="product_price" required></td>
            </tr>
            <tr>
                <td>Số lượng sản phẩm:</td>
                <td><input type="text" name="quantity" required></td>
            </tr>
            <tr>
                <td>Ảnh sản phẩm:</td>
                <td><input type="file" name="product_img" required></td>
            </tr>
            <tr>
                <td>Mô tả sản phẩm:</td>
                <td><input type="text" name="product_description" required></td>
            </tr>
            <tr>
                <td colspan="2">
                    <input type="submit" name="add_product" value="Thêm mới">
                </td>
            </tr>
        </table>
    </form>

    <?php
    // B1: Kết nối và chọn CSDL
    $connect = mysqli_connect('localhost', 'root', '', 'w_login_se06303');
    if (!$connect) {
        die("Kết nối thất bại: " . mysqli_connect_error());
    }

    // B2: Xử lý form
    if (isset($_POST['add_product'])) {
        // Nhận dữ liệu từ form
        $product_id = $_POST['product_id'];
        $product_name = $_POST['product_name'];
        $product_price = $_POST['product_price'];
        $quantity = $_POST['quantity'];
        $product_description = $_POST['product_description'];
        
        // Nhận file ảnh
        $product_img = $_FILES['product_img']['name'];
        $product_img_tmp = $_FILES['product_img']['tmp_name'];
        
        // Di chuyển file ảnh
        $upload_dir = "Image/";
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }
        move_uploaded_file($product_img_tmp, $upload_dir . $product_img);

        // Tạo câu truy vấn
        $sql = "INSERT INTO products (product_id, product_name, product_price, quantity, product_img, product_description)
                VALUES ('$product_id', '$product_name', '$product_price', '$quantity', '$product_img', '$product_description')";

        // Thực thi truy vấn
        if (mysqli_query($connect, $sql)) {
            echo "<script>alert('Thêm sản phẩm thành công');</script>";
        } else {
            echo "<script>alert('Thêm sản phẩm thất bại: " . mysqli_error($connect) . "');</script>";
        }
    }

    // Đóng kết nối
    mysqli_close($connect);
    ?>
</body>
</html>
