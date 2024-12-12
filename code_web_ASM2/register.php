<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Đăng Ký</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: url('Image/pngtree-supercar-flame-smoke-advertising-background-picture-image_2401236.jpg') no-repeat center center fixed;
            background-size: cover;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        form {
            background: rgba(255, 255, 255, 0.9); /* Nền form mờ */
            padding: 20px 30px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
            text-align: center;
            width: 300px;
        }
        h2 {
            margin-bottom: 20px;
            color: #333;
        }
        input[type="text"], input[type="password"], input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
        }
        input[type="submit"] {
            background-color: #CCCC00;
            color: white;
            border: none;
            cursor: pointer;
            font-weight: bold;
        }
        input[type="submit"]:hover {
            background-color: #FFCC33;
        }
    </style>

    <script>
        function validateForm() {
            const username = document.forms["registerForm"]["username"].value;
            const password = document.forms["registerForm"]["password"].value;
            const email = document.forms["registerForm"]["email"].value;
            // Regular expressions for validation
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (username.trim() === "") {
                alert("Vui lòng nhập tên người dùng!");
                return false;
            }
            if (password.trim() === "") {
                alert("Vui lòng nhập mật khẩu!");
                return false;
            }
            if (password.length < 6) {
                alert("Mật khẩu phải có ít nhất 6 ký tự!");
                return false;
            }
            if (email.trim() === "") {
                alert("Vui lòng nhập email!");
                return false;
            }
            if (!emailRegex.test(email)) {
                alert("Email không đúng định dạng!");
                return false;
            }
            return true;
        }
    </script>
</head>
<body>
    <!-- Form đăng ký -->
    <form name="registerForm" action="" method="POST" onsubmit="return validateForm()">
        <h2>Register</h2>
        
        UserName: <input type="text" name="username" required><br>
        Password: <input type="password" name="password" required> <br>
        Email: <input type="text" name="email" required> <br>
        <input type="submit" name="submit" value="Đăng Ký">
    </form>

    <?php 
        // Kết nối cơ sở dữ liệu
        $connect = mysqli_connect('localhost', 'root', '', 'w_login_se06303');
        
        // Kiểm tra kết nối
        if(!$connect){
            die("Kết nối thất bại: " . mysqli_connect_error());
        }

        // Nhận dữ liệu từ form
        if(isset($_POST['submit'])){ // Kiểm tra nếu nút 'submit' được nhấn
            $username = mysqli_real_escape_string($connect, $_POST['username']); // Lấy Username
            $password = mysqli_real_escape_string($connect, $_POST['password']); // Lấy Password
            $email = mysqli_real_escape_string($connect, $_POST['email']); // Lấy Email

            // Câu truy vấn thêm dữ liệu vào bảng users
            $sql = "INSERT INTO users (username, password, email) VALUES ('$username', '$password', '$email')";

            // Thực thi câu truy vấn
            $result = mysqli_query($connect, $sql);

            if($result){
                // Chuyển hướng sang trang login.php khi đăng ký thành công
                echo "<script>alert('Đăng ký thành công!'); window.location.href = 'login.php';</script>";
                exit(); // Dừng chương trình sau khi chuyển hướng
            } else {
                echo "<script>alert('Đăng ký thất bại: " . mysqli_error($connect) . "');</script>";
            }
        }

        // Đóng kết nối
        mysqli_close($connect);
    ?>
</body>
</html>
