<?php
// Kết nối tới cơ sở dữ liệu
$servername = "localhost";
$username = "root";
$password = "";
$database = "book_store";

try {
    $pdo = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Lỗi kết nối: " . $e->getMessage());
}

// Xử lý dữ liệu form khi được submit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm-password'];
    $gender = $_POST['gender'];

    // Kiểm tra xác nhận mật khẩu
    if ($password !== $confirmPassword) {
        echo "Mật khẩu không khớp!";
        exit();
    }

    // Hash mật khẩu trước khi lưu vào cơ sở dữ liệu
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Lưu thông tin vào bảng users
    try {
        $stmt = $pdo->prepare("INSERT INTO users (fullname, email, password, gender) VALUES (:fullname, :email, :password, :gender)");
        $stmt->execute([
            ':fullname' => $fullname,
            ':email' => $email,
            ':password' => $hashedPassword,
            ':gender' => $gender,
        ]);

        echo "Đăng ký thành công!";
    } catch (PDOException $e) {
        if ($e->getCode() == 23000) { // Mã lỗi cho UNIQUE (trùng email)
            echo "Email đã được sử dụng!";
        } else {
            die("Lỗi: " . $e->getMessage());
        }
    }
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Đăng Ký</title>
    <link rel="stylesheet" href="./assets/css/register.css">
</head>
<body>
    <div class="container">
        <form class="register-form" method="POST" action="register.php">
            <h2>Đăng ký</h2>
            <select class="dropdown" name="gender" required>
                <option value="" disabled selected>Giới Tính</option>
                <option value="anh">Nam</option>
                <option value="chi">Nữ</option>
            </select>
            <input type="text" name="fullname" placeholder="Họ tên" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Mật khẩu" required>
            <input type="password" name="confirm-password" placeholder="Nhập lại mật khẩu" required>
            <button type="submit" class="submit-btn">Đăng ký</button>
            <p class="login-link">Đã có tài khoản? <a href="login.php">Đăng nhập tại đây</a></p>
        </form>
    </div>
</body>
</html>
