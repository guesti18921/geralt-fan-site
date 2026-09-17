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
            <h1><?= htmlspecialchars($lang['about_header']) ?></h1>
        </div>
    </header>

<?php require_once('menu.php')?>

    <main>
        <section class="bio">
            <h2><?= htmlspecialchars($lang['bio_title']) ?></h2>
            <div class="bio-content">
                <img src="images/portraits/geralt-bio.jpg" alt="<?= htmlspecialchars($lang['geralt_portrait']) ?>" class="bio-image" loading="lazy">
                <div class="bio-text">
                    <p><?= htmlspecialchars($lang['bio_text1']) ?></p>
                    <p><?= htmlspecialchars($lang['bio_text2']) ?></p>
                    <p><?= htmlspecialchars($lang['bio_text3']) ?></p>
                </div>
            </div>
        </section>

        <section class="timeline">
            <h2><?= htmlspecialchars($lang['timeline_title']) ?></h2>
            <div class="timeline-container">
                <div class="timeline-item">
                    <div class="timeline-date"><?= htmlspecialchars($lang['timeline_date1']) ?></div>
                    <div class="timeline-content">
                        <h3><?= htmlspecialchars($lang['timeline_event1']) ?></h3>
                        <p><?= htmlspecialchars($lang['timeline_desc1']) ?></p>
                    </div>
                </div>
                <div class="timeline-item">
                    <div class="timeline-date"><?= htmlspecialchars($lang['timeline_date2']) ?></div>
                    <div class="timeline-content">
                        <h3><?= htmlspecialchars($lang['timeline_event2']) ?></h3>
                        <p><?= htmlspecialchars($lang['timeline_desc2']) ?></p>
                    </div>
                </div>
                <div class="timeline-item">
                    <div class="timeline-date"><?= htmlspecialchars($lang['timeline_date3']) ?></div>
                    <div class="timeline-content">
                        <h3><?= htmlspecialchars($lang['timeline_event3']) ?></h3>
                        <p><?= htmlspecialchars($lang['timeline_desc3']) ?></p>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <footer>
        <p><?= htmlspecialchars($lang['footer_text']) ?></p>
    </footer>

    <script src="js/script.js"></script>
</body>
</html>