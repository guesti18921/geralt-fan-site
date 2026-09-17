<?php
session_start();
if (!isset($_SESSION['lang']) || !in_array($_SESSION['lang'], ['en', 'ru'])) {
    $_SESSION['lang'] = 'ru';
}
if (isset($_GET['lang']) && in_array($_GET['lang'], ['en', 'ru'])) {
    $_SESSION['lang'] = $_GET['lang'];
    header('Location: ' . strtok($_SERVER['REQUEST_URI'], '?'));
    exit;
}
require_once "languages/" . $_SESSION['lang'] . ".php";

$images = [
    ['file' => 'geralt1.jpg', 'desc' => $lang['gallery_desc1']],
    ['file' => 'geralt2.jpg', 'desc' => $lang['gallery_desc2']],
    ['file' => 'geralt3.jpg', 'desc' => $lang['gallery_desc3']],
    ['file' => 'geralt4.jpg', 'desc' => $lang['gallery_desc4']],
    ['file' => 'geralt5.jpg', 'desc' => $lang['gallery_desc5']],
    ['file' => 'geralt6.jpg', 'desc' => $lang['gallery_desc6']]
];
?>
<!DOCTYPE html>
<html lang="<?= htmlspecialchars($_SESSION['lang']) ?>">
<?php require_once('head.php')?>

<body>
    <div class="language-switcher">
        <a href="?lang=en" class="<?= $_SESSION['lang'] === 'en' ? 'active' : '' ?>">EN</a>
        <a href="?lang=ru" class="<?= $_SESSION['lang'] === 'ru' ? 'active' : '' ?>">RU</a>
    </div>

    <header class="parallax" style="background-image: url('images/banners/geralt-header.jpg')">
        <div class="header-content">
            <h1><?= htmlspecialchars($lang['gallery_header']) ?></h1>
        </div>
    </header>

<?php require_once('menu.php')?>


    <main>
        <section class="gallery-section">
            <h2><?= htmlspecialchars($lang['gallery_section_title']) ?></h2>
            <div class="gallery-container">
                <?php foreach ($images as $index => $image): ?>
                <div class="gallery-item">
                    <img src="images/gallery/<?= htmlspecialchars($image['file']) ?>" 
                         alt="<?= htmlspecialchars($image['desc']) ?>"
                         onclick="openModal(<?= $index ?>)"
                         loading="lazy">
                    <p><?= htmlspecialchars($image['desc']) ?></p>
                </div>
                <?php endforeach; ?>
            </div>
        </section>

        <div id="imageModal" class="modal">
            <span class="close" onclick="closeModal()">&times;</span>
            <img class="modal-content" id="modalImage" alt="">
            <div id="caption"></div>
        </div>
    </main>

    <footer>
        <p><?= htmlspecialchars($lang['footer_text']) ?></p>
    </footer>

    <script src="js/script.js"></script>
</body>
</html>