<?php
require 'db/database.php';

try {
    // Lấy danh sách sách theo thể loại
    $stmtComic = $pdo->query("SELECT * FROM books WHERE genre = 'Truyện tranh' LIMIT 5");
    $stmtVN = $pdo->query("SELECT * FROM books WHERE genre = 'Sách Việt Nam' LIMIT 5");
    $stmtForeign = $pdo->query("SELECT * FROM books WHERE genre = 'Sách nước ngoài' LIMIT 5");

    $comics = $stmtComic->fetchAll(PDO::FETCH_ASSOC);
    $vietnamBooks = $stmtVN->fetchAll(PDO::FETCH_ASSOC);
    $foreignBooks = $stmtForeign->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Lỗi: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cửa hàng sách</title>
    <link rel="stylesheet" href="./assets/css/style.css">
    <link rel="stylesheet" href="./assets/css/ti.icon/themify-icons-font/themify-icons/themify-icons.css">
    <link rel="stylesheet" href="./assets/css/fontawesome/fontawesome-free-6.6.0-web/fontawesome-free-6.6.0-web/css/all.css">
</head>
<body>
    <div id="main">
        <!-- Header -->
        <div id="header">
            <ul id="nav">
                <li><a href="#">Trang chủ</a></li>
                <li>
                    <i class="header-ti-search ti-search"></i>
                    <input type="text" class="search" placeholder="Tìm kiếm">
                </li>
            </ul>
            <li class="cart"><i class="ti-shopping-cart"></i> Giỏ hàng</li>
        </div>

        <div id="content">
            <div id="menu-slider">
                <div id="sub-menu">
                    <ul>
                        <li><a href="menu/menucomic.php">Truyện tranh</a></li>
                        <li><a href="menu/menusachvn.php">Sách Việt Nam</a></li>
                        <li><a href="menu/menusachnn.php">Sách nước ngoài</a></li>
                    </ul>
                </div>
                <div id="slider"></div>
            </div>

            <!-- Truyện tranh -->
            
            <div id="comic">
                <h2>Truyện Tranh</h2>
                <div id="comic-list">
                    <?php foreach ($comics as $comic): ?>
                        <div class="comic-name">
                            <a href="/Bansach/thanhtoan/thanhtoancomic.php?id=<?= $comic['id']; ?>">
                                <img src="<?= $comic['image_url']; ?>" alt="<?= $comic['title']; ?>" class="comic-img">
                                <h3><?= htmlspecialchars($comic['title']); ?></h3>
                            </a>
                            <p>Giá: <?= number_format($comic['price'], 0, ',', '.'); ?> VND</p>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="more"><a href="menu/menucomic.php">Xem thêm</a></div>
            </div>

            <?php if (!empty($vietnamBooks)): ?>
            <div id="bookVN">
                <h2>Sách Việt Nam</h2>
                <div id="bookVN-list">
                    <?php foreach ($vietnamBooks as $book): ?>
                        <div class="bookVN-name">
                            <a href="/Bansach/thanhtoan/thanhtoansachvn.php?id=<?= $book['id']; ?>">
                                <img src="<?= $book['image_url']; ?>" alt="<?= $book['title']; ?>" class="bookVN-img">
                                <h3><?= htmlspecialchars($book['title']); ?></h3>
                            </a>
                            <p>Giá: <?= number_format($book['price'], 0, ',', '.'); ?> VND</p>
                        </div>
                <?php endforeach; ?>
            </div>
            <div class="more"><a href="menu/menusachvn.php">Xem thêm</a></div>
        </div>
        <?php endif; ?>


            <!-- Sách nước ngoài -->
            <div id="bookForeign">
                <h2>Sách Nước Ngoài</h2>
                <div id="bookForeign-list">
                    <?php foreach ($foreignBooks as $foreignBook): ?>
                        <div class="book-foreign-name">
                            <a href="/Bansach/thanhtoan/thanhtoansachnn.php?id=<?= $foreignBook['id']; ?>">
                                <img src="<?= $foreignBook['image_url']; ?>" alt="<?= $foreignBook['title']; ?>" class="book-foreign-img">
                                <h3><?= htmlspecialchars($foreignBook['title']); ?></h3>
                            </a>
                            <p>Giá: <?= number_format($foreignBook['price'], 0, ',', '.'); ?> VND</p>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="more"><a href="menu/menusachnn.php">Xem thêm</a></div>
            </div> 
        </div>

        <div id="footer">
            Thành viên nhóm có làm bài:<br>
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
