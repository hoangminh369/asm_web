<!DOCTYPE html>
<html>
<head>
    <title>Login page</title>

    <style>
        /* Giữ nguyên CSS như ban đầu */
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
            color: white;
        }
        form {
            background: rgba(0, 0, 0, 0.8);
            padding: 20px 30px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.5);
            text-align: center;
            width: 300px;
        }
        h2 {
            margin-bottom: 20px;
            color: #fff;
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
            const username = document.forms["loginForm"]["username"].value;
            const password = document.forms["loginForm"]["password"].value;

            if (username.trim() === "") {
                alert("Vui lòng nhập tên người dùng!");
                return false;
            }

            if (password.trim() === "") {
                alert("Vui lòng nhập mật khẩu!");
                return false;
            }

            return true; // Nếu không có lỗi, cho phép gửi form
        }
    </script>
</head>
<body>
    <form name="loginForm" method="POST" action="" onsubmit="return validateForm()">
        UserName : <input type="text" name="username">
        Password : <input type="password" name="password">
        <input type="submit" name="login" value="Login">
    </form>
    <?php 
    // PHP xử lý đăng nhập
    $connect = mysqli_connect('localhost','root','','w_login_se06303');
    if($connect){
        echo "Kết nối thành công";
    } else {
        echo "Kết nối thất bại";
    }

    if(isset($_POST['login'])){
        $username = $_POST['username'];
        $password = $_POST['password'];
        $sql = "SELECT * FROM users WHERE username ='$username' AND password ='$password'";
        $result = mysqli_query($connect, $sql);
        $count_rows = mysqli_num_rows($result);

        if($count_rows == 0){
            echo "<script>alert('Sai tên người dùng hoặc mật khẩu')</script>";
        } else {
            echo "<script>alert('Đăng nhập thành công')</script>";
            echo "<script>window.open('websit_home.php','_self')</script>";
            $_SESSION['username'] = $username;
        }
    }    
    ?>
</body>
</html>
