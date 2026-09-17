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
            <h1><?= htmlspecialchars($lang['welcome']) ?></h1>
            <p><?= htmlspecialchars($lang['subtitle']) ?></p>
            <button class="scroll-down" onclick="scrollToContent()" aria-label="<?= htmlspecialchars($lang['scroll_down']) ?>">
                <svg viewBox="0 0 24 24" width="30" height="30">
                    <path fill="currentColor" d="M7.41,8.58L12,13.17L16.59,8.58L18,10L12,16L6,10L7.41,8.58Z"/>
                </svg>
            </button>
        </div>
    </header>

<?php require_once('menu.php')?>


    <main>
        <section class="intro" id="intro">
            <h2><?= htmlspecialchars($lang['intro_title']) ?></h2>
            <p><?= htmlspecialchars($lang['intro_text']) ?></p>
        </section>

        <section class="features" id="features">
            <div class="feature-card">
                <div class="feature-icon">⚔️</div>
                <h3><?= htmlspecialchars($lang['feature1_title']) ?></h3>
                <p><?= htmlspecialchars($lang['feature1_text']) ?></p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">🐺</div>
                <h3><?= htmlspecialchars($lang['feature2_title']) ?></h3>
                <p><?= htmlspecialchars($lang['feature2_text']) ?></p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">🔮</div>
                <h3><?= htmlspecialchars($lang['feature3_title']) ?></h3>
                <p><?= htmlspecialchars($lang['feature3_text']) ?></p>
            </div>
        </section>
    </main>

    <footer>
        <p><?= htmlspecialchars($lang['footer_text']) ?></p>
        <button class="back-to-top" onclick="scrollToTop()" aria-label="<?= htmlspecialchars($lang['back_to_top']) ?>">↑</button>
    </footer>

    <script src="js/script.js"></script>
</body>
</html>