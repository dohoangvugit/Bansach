<?php
// Kết nối cơ sở dữ liệu
require '../db/database.php';

try {
    // Lấy thông tin sách từ cơ sở dữ liệu dựa vào `id` (hoặc thông số khác nếu cần)
    $bookId = isset($_GET['id']) ? intval($_GET['id']) : 0;
    $stmt = $pdo->prepare("SELECT * FROM books WHERE id = :id");
    $stmt->execute(['id' => $bookId]);
    $book = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$book) {
        die("Không tìm thấy thông tin sách.");
    }
} catch (PDOException $e) {
    die("Lỗi: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($book['title']); ?></title>
    <link rel="stylesheet" href="../assets/css/thanhtoan/thanhtoan.css">
    <link rel="stylesheet" href="../assets/css/ti.icon/themify-icons-font/themify-icons/themify-icons.css">
    <link rel="stylesheet" href="../assets/css/fontawesome/fontawesome-free-6.6.0-web/fontawesome-free-6.6.0-web/css/all.css">
</head>
<body>
    <div id="main">
        <div id="header">
            <ul id="nav">
                <li><a href="../index.php">Trang chủ</a></li>
                <li>
                    <i class="header-ti-search ti-search"></i>
                    <input type="text" class="search" placeholder="Tìm kiếm" >
                </li>
            </ul>

            <li class="cart"> <i class="ti-shopping-cart"></i>
                Giỏ hàng
           </li> 
        </div>
        
        <div id="content">
        
            <div class="container-book">
                <div class="book-img">
                    <img src="../<?= htmlspecialchars($book['image_url']); ?>" class="img">
                </div>

                <div class="book-pay">
                    <h2><?= htmlspecialchars($book['title']); ?></h2>
                    <p class="price">Giá: <?= number_format($book['price'], 0, ',', '.'); ?> <i class="fa-solid fa-dong-sign fa-sm" style="color: #ff0000;"></i></p>
                    <p class="quantity">Tình trạng: 
                        <p class="status"><?= htmlspecialchars($book['stock']); ?></p>
                    </p>

                    <div class="quantity-controls"> Số lượng
                        <button onclick="decrease()">-</button>
                        <input type="number" id="quantity" value="1" min="1" readonly>
                        <button onclick="increase()">+</button>
                    </div>

                    <button class="add">Thêm vào giỏ hàng</button>
                    <div class="i4-pro">
                        <p>Thông tin & Khuyến mãi</p>
                        <ul>
                            <li>Đổi trả trong vòng 7 ngày</li>
                            <li>Freeship toàn quốc</li>
                        </ul>
                    </div>
                </div>

                <div class="info-container">
                    <h2>THÔNG TIN CHI TIẾT</h2>
                    <div class="info-item">
                        <span>Nhà xuất bản:</span>
                        <a href="#"><?= htmlspecialchars($book['publisher']); ?></a>
                    </div>
                    <div class="info-item">
                        <span>Ngày xuất bản:</span>
                        <span><?= htmlspecialchars($book['publication_date']); ?></span>
                    </div>
                    <div class="info-item">
                        <span>Kích thước:</span>
                        <span><?= htmlspecialchars($book['size']); ?></span>
                    </div>
                    <div class="info-item">
                        <span>Số trang:</span>
                        <span><?= htmlspecialchars($book['page_count']); ?> trang</span>
                    </div>
                    <div class="info-item">
                        <span>Trọng lượng:</span>
                        <span><?= htmlspecialchars($book['weight']); ?> gram</span>
                    </div>
                </div>
            </div>

            <div id="container-book-i4"> 
                <div class="book-i4"> Giới thiệu sản phẩm</div>
                <h2><?= htmlspecialchars($book['title']); ?></h2>
                <p><?= htmlspecialchars($book['description']); ?></p>
            </div>
        </div>
        <div id="footer">
            <div class="member">
                <p>Đỗ Hoàng Vũ-2121050905<br></p>
                <p> Contact: <a href="">2121050905@student.humg.edu.vn</a><br></p>
                <p class="sdt">SDT: 0387118627<br></p>
            </div>
            <div class="member">
                <p>Phạm Mạnh Cầm - 2121051135</p>
                <p>Contact: <a href="">2121051135@student.humg.edu.vn</a></p>
                <p class="sdt">SDT: 0327514975</p>
            </div>  
        </div>
    </div>
    <script>
        function increase() {
            let quantity = document.getElementById("quantity");
            quantity.value = parseInt(quantity.value) + 1;
        }

        function decrease() {
            let quantity = document.getElementById("quantity");
            if (quantity.value > 1) {
                quantity.value = parseInt(quantity.value) - 1;
            }
        }
    </script>
</body>
</html>
