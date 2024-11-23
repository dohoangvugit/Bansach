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

// Xử lý đăng nhập khi form được submit
$error = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Kiểm tra thông tin đăng nhập trong cơ sở dữ liệu
    try {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->execute([':email' => $email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            
            header('Location: index.php');
            exit();
        } else {
            $error = "Email hoặc mật khẩu không đúng!";
        }
    } catch (PDOException $e) {
        die("Lỗi: " . $e->getMessage());
    }
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Đăng Nhập</title>
    <link rel="stylesheet" href="./assets/css/login.css">
</head>
<body>
    <div class="container">
        <form class="login-form" method="POST" action="login.php">
            <h2>Đăng nhập</h2>

            <!-- Hiển thị lỗi nếu có -->
            <?php if (!empty($error)): ?>
                <p class="error-message" style="color: red;"><?= htmlspecialchars($error) ?></p>
            <?php endif; ?>

            <input type="email" name="email" placeholder="Email" required>
            
            <!-- Ô mật khẩu có biểu tượng mắt -->
            <div class="password-container">
                <input type="password" id="password" name="password" placeholder="Mật khẩu" required>
                <span class="toggle-password" onclick="togglePasswordVisibility()">
                    <img id="password-icon" src="https://cdn-icons-png.flaticon.com/512/159/159604.png" alt="Hiển thị/Ẩn mật khẩu">
                </span>
            </div>
            
            <button type="submit" class="submit-btn">Đăng nhập</button>
            <p class="register-link">Chưa có tài khoản? <a href="register.php">Đăng ký tại đây</a></p>
        </form>
    </div>

    <script>
        function togglePasswordVisibility() {
            const passwordInput = document.getElementById('password');
            const passwordIcon = document.getElementById('password-icon');
            
            // Đổi kiểu hiển thị mật khẩu
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                passwordIcon.src = 'https://cdn-icons-png.flaticon.com/512/709/709612.png'; // Biểu tượng "mắt mở"
            } else {
                passwordInput.type = 'password';
                passwordIcon.src = 'https://cdn-icons-png.flaticon.com/512/159/159604.png'; // Biểu tượng "mắt đóng"
            }
        }
    </script>
</body>
</html>
