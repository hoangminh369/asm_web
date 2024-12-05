<?php
session_start(); // Bắt đầu phiên để lưu trữ dữ liệu người dùng

// Kiểm tra đăng nhập (giả sử bạn sử dụng phương thức POST để đăng nhập)
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username']; 
    $password = $_POST['password']; 

    // Kết nối cơ sở dữ liệu (giả sử bảng người dùng có tên là 'users')
    $connect = mysqli_connect('localhost', 'root', '', 'w_login_se06303');
    if (!$connect) {
        die('Không thể kết nối đến cơ sở dữ liệu');
    }

    // Truy vấn kiểm tra xem người dùng có tồn tại không
    $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($connect, $sql);

    if (mysqli_num_rows($result) == 1) {
        // Người dùng tìm thấy, lưu thông tin vào session
        $_SESSION['username'] = $username;
        header('Location: websit_home.php'); // Chuyển hướng về trang chủ
    } else {
        echo "Tên đăng nhập hoặc mật khẩu không chính xác.";
    }
}
?>


<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Website Bán Hàng</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
 
    <style>
        /* General Body Styling */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        /* Header Styles */
        .header {
            background-color: #333;
            color: white;
            padding: 10px 0;
            text-align: center;
        }
        .header #form_search form {
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .header input[type="text"] {
            padding: 5px;
            width: 300px;
            margin-right: 10px;
            border: none;
            border-radius: 4px;
        }
        .header input[type="submit"] {
            padding: 5px 15px;
            background-color: #5cb85c;
            border: none;
            color: white;
            cursor: pointer;
            border-radius: 4px;
        }
        .header input[type="submit"]:hover {
            background-color: #4cae4c;
        }
        /* Menu Styles */
        .menu {
            background-color: #222;
            padding: 10px;
        }
        .menu ul {
            list-style: none;
            margin: 0;
            padding: 0;
            text-align: center;
        }
        .menu ul li {
            display: inline;
            margin-right: 20px;
        }
        .menu ul li a {
            color: white;
            text-decoration: none;
            font-weight: bold;
        }
        .menu ul li a:hover {
            text-decoration: underline;
        }
        .menu ul li a:last-child {
            margin-right: 0;
        }
        /* Carousel */
        .carousel-inner img {
            width: 100%;
            height: 900px;
            object-fit: cover;
        }
        /* Content Section */
        .content {
            padding: 20px;
        }
        .products_box {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
        }
        .single_product {
            background-color: white;
            padding: 10px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            text-align: center;
            width: 250px;
        }
        .single_product img {
            width: 180px;
            height: 180px;
            object-fit: cover;
            margin-bottom: 10px;
        }
        .single_product h3 {
           
            font-weight: bold;
            margin-bottom: 10px;
            color: #333;
            text-overflow: ellipsis;
            overflow: hidden;
            white-space: nowrap;
        }
        .single_product p {
            font-size: 16px;
            color: #555;
        }
        .single_product a {
            text-decoration: none;
            color: #007bff;
            margin-top: 10px;
            display: inline-block;
            font-weight: bold;
        }
        .single_product a:hover {
            text-decoration: underline;
        }
        .single_product button {
            background-color: #007bff;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
        }
        .single_product button:hover {
            background-color: #0056b3;
        }
        /* Footer Styling */
        .footer {
            background-color: #333;
            color: white;
            padding: 30px 0;
        }
        .footer h5 {
            font-size: 18px;
            margin-bottom: 15px;
        }
        .footer p {
            font-size: 14px;
        }
        .footer a {
            margin: 0 10px;
        }
        .footer a img {
            width: 25px;
            height: 25px;
        }
        /* Responsive Design */
        @media (max-width: 768px) {
            .products_box {
                flex-direction: column;
                align-items: center;
            }
            .single_product {
                width: 100%;
                margin: 10px 0;
            }
            .carousel-inner img {
                height: 300px;
            }
        }
    </style>



</head>
<body>
    <div class="wrapper">


    <!-- Header -->
    <div class="header">
        <!-- Hiển thị người dùng đã đăng nhập -->
        <?php
        // session_start();
        if (isset($_SESSION['username'])) {
            echo "<p>Chào mừng, " . $_SESSION['username'] . "!</p>";
        } else {
            echo "<p>Chào mừng, Khách!</p>";
        }
        ?>
        
        <!-- Form tìm kiếm -->
        <div id="form_search">
            <form method="get" action="">
                <input type="text" name="user_query" placeholder="Tìm kiếm sản phẩm">
                <input type="submit" name="search" value="Tìm kiếm">
            </form>
        </div>

           

        <!-- Menu -->
        <div class="menu">
            <ul>
                <li><a href="websit_home.php">Home page </a></li>
                <li><a href="a_contact.html">A contact </a></li>
                <li><a href="add_product.php">Add product </a></li>  
                <li><a href="profile.html">A profile</a></li>
                <li><a href="logout.php">Logout</a></li>
                 <li><a href="cart.php">Giỏ hàng (<?php echo isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0; ?>)</a></li>      
            </ul>
        </div>
        
        <!-- Content -->
        <div class="content">
            
            <!-- Main Content -->
            <div class="right">
                <!-- Bootstrap Carousel -->
                <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
                  <div class="carousel-inner">
                    <div class="carousel-item active">
                      <img src="picture/xe-mercedes-c-class-1.jpg" class="d-block w-100" alt="Product 1">
                    </div>
                    <div class="carousel-item">
                      <img src="picture/pngtree-new-mercedes-car-in-front-of-an-dark-room-image_2575877.jpg" class="d-block w-100" alt="Product 2">
                    </div>
                    <div class="carousel-item">
                      <img src="picture/4107.jpg_wh860.jpg" class="d-block w-100" alt="Product 3">
                    </div>
                  </div>
                  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                  </button>
                  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                  </button>
                </div>

                <p style="text-align: center; font-size: 20px;">Tất cả sản phẩm</p>
                <div class="products_box">
                <?php
                    // Kết nối cơ sở dữ liệu
                    $connect = mysqli_connect('localhost', 'root', '', 'w_login_se06303');
                    if (!$connect) {
                        die('Không thể kết nối đến cơ sở dữ liệu');
                    }

                    // Lấy dữ liệu từ bảng products
                    $sql = "SELECT * FROM products";
                    $result = mysqli_query($connect, $sql);


                    // Lấy từ khóa tìm kiếm từ URL
                    if (isset($_GET['user_query'])) {
                        $search_query = mysqli_real_escape_string($connect, $_GET['user_query']);
                        $sql = "SELECT * FROM products WHERE product_name LIKE '%$search_query%'";
                    } else {
                        $sql = "SELECT * FROM products";
                    }

                    $result = mysqli_query($connect, $sql);

                    // Kiểm tra xem query có thành công không
                    if (!$result) {
                        die('Lỗi truy vấn cơ sở dữ liệu');
                    }


                    // Hiển thị sản phẩm
                    while($row_product =mysqli_fetch_array($result)){
                        //Hiển thị lần lượt từng sản phẩm
                        $product_id = $row_product['product_id'];
                        $product_name = $row_product['product_name'];
                        $product_price = $row_product['product_price'];
                        $product_img = $row_product['product_img'];
                        echo"
                        <div class='single_product'>
                        <h3>$product_name</h3>
                        <img src='Image/$product_img' width='180' height='180' />
                        <p><b> Price:$product_price </b></p>
                        <a href='detail.php?id=$product_id'>Details</a>
                        <a href='index.php?add_cart=$product_id'>
                        <button style='float:right'>Add to Cart</button> </a>                 
                        </div>       
                        ";
                            
                        
                    }
                    ?>

                </div>
            </div>
        </div>

       

        
        <!-- Footer -->
       
        <div class="footer bg-dark text-white p-3">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <h5>Về Chúng Tôi</h5>
                <p>Website bán hàng trực tuyến, cung cấp các sản phẩm chất lượng cao với giá cả hợp lý.</p>
            </div>
            <div class="col-md-4">
                <h5>Liên Hệ</h5>
                <p>Email: contact@example.com</p>
                <p>Hotline: 0123 456 789</p>
            </div>
            <div class="col-md-4">
                <h5>Kết Nối Với Chúng Tôi</h5>
                <a href="#"><img src="Image/logo fb.png" alt="Facebook"></a>
                <a href="#"><img src="Image/Logo_of_Twitter.svg.webp" alt="Twitter"></a>
                <a href="#"><img src="Image/Instagram_logo_2022.svg.webp" alt="Instagram"></a>
            </div>
        </div>
    </div>
</div>

        </div>
    </div>

    <!-- Thêm JS của Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
