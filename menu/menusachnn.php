<?php
require '../db/database.php';

try {
    $stmt = $pdo->query("SELECT * FROM books WHERE genre = 'Sách Nước Ngoài'");
    $comics = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Lỗi: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách Truyện tranh</title>
    <link rel="stylesheet" href="../assets/css/menu/menu.css">
    <link rel="stylesheet" href="../assets/css/ti.icon/themify-icons-font/themify-icons.css">
    <link rel="stylesheet" href="../assets/css/fontawesome/fontawesome-free-6.6.0-web/fontawesome-free-6.6.0-web/css/all.css">
</head>
<body>
    <div id="main">
        <div id="header">
            <ul id="nav">
                <li><a href="../index.php">Trang chủ</a></li>
                <li>
                    <i class="header-ti-search ti-search"></i>
                    <input type="text" class="search" placeholder="Tìm kiếm">
                </li>
            </ul>
            <li class="cart"><i class="ti-shopping-cart"></i> Giỏ hàng</li>
        </div>
        
        <div id="content">
            <!-- Danh mục sản phẩm -->
            <div id="menu">
                <div id="content-menu"> 
                    <ul>
                        <li><i class="ti-menu"></i>
                            Danh mục sản phẩm
                        <i class="fa-solid fa-caret-down"></i>
                            <ul id="sub-menu">
                                <li>
                                    <a href="menucomic.php">Truyện tranh</a>
                                    <i class="sub-menu-angle-right ti-angle-right"></i>
                                </li>
                                <li>
                                    <a href="menusachvn.php">Sách Việt Nam</a>
                                    <i class="sub-menu-angle-right ti-angle-right"></i>
                                </li>
                                <li>
                                    <a href="#">Sách Nước ngoài</a>
                                    <i class="sub-menu-angle-right ti-angle-right"></i>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Breadcrumb -->
            <div class="book-type">
                <a href="../index.php">Trang chủ</a> / <a href="">Truyện tranh</a>
            </div>

            <!-- Danh sách truyện tranh -->
            <div id="comic-list">
                <?php foreach ($comics as $comic): ?>
                    <div class="comic-name">
                        <a href="/Bansach/thanhtoan/thanhtoansachnn.php?id=<?= $comic['id']; ?>">
                            <img src="../<?= htmlspecialchars($comic['image_url']); ?>" alt="<?= htmlspecialchars($comic['title']); ?>" class="comic-img">
                            <h2><?= htmlspecialchars($comic['title']); ?></h2>
                        </a>
                        <p>Giá: <?= number_format($comic['price'], 0, ',', '.'); ?> 
                            <i class="fa-solid fa-dong-sign fa-sm" style="color: #ff0000;"></i>
                        </p>
                    </div>
                <?php endforeach; ?>
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
</body>
</html>
