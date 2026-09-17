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

    <header class="parallax" style="background-image: url('images/banners/world-header.jpg')">
        <div class="header-content">
            <h1><?= htmlspecialchars($lang['world_header']) ?></h1>
            <p><?= htmlspecialchars($lang['world_subtitle']) ?></p>
        </div>
    </header>

<?php require_once('menu.php')?>

    <main>
        <section class="world-intro">
            <h2><?= htmlspecialchars($lang['world_section_title']) ?></h2>
            <p><?= htmlspecialchars($lang['world_intro_text']) ?></p>
        </section>

        <section class="locations">
            <h3><?= htmlspecialchars($lang['locations_title']) ?></h3>
            <div class="location-cards">
                <div class="location-card" onclick="showLocationInfo('kaer-morhen')">
                    <div class="location-image-container">
                        <img src="images/locations/kaer-morhen.jpg" alt="<?= htmlspecialchars($lang['kaer_morhen']) ?>" loading="lazy">
                    </div>
                    <h4><?= htmlspecialchars($lang['kaer_morhen']) ?></h4>
                </div>
                <div class="location-card" onclick="showLocationInfo('novigrad')">
                    <div class="location-image-container">
                        <img src="images/locations/novigrad.jpg" alt="<?= htmlspecialchars($lang['novigrad']) ?>" loading="lazy">
                    </div>
                    <h4><?= htmlspecialchars($lang['novigrad']) ?></h4>
                </div>
                <div class="location-card" onclick="showLocationInfo('skellige')">
                    <div class="location-image-container">
                        <img src="images/locations/skellige.jpg" alt="<?= htmlspecialchars($lang['skellige']) ?>" loading="lazy">
                    </div>
                    <h4><?= htmlspecialchars($lang['skellige']) ?></h4>
                </div>
            </div>
            <div id="location-info" class="location-info"></div>
        </section>

        <section class="factions">
            <h3><?= htmlspecialchars($lang['factions_title']) ?></h3>
            <div class="faction-tabs">
                <button class="tab-button active" onclick="openFaction('northern')">
                    <?= htmlspecialchars($lang['faction_northern_name']) ?>
                </button>
                <button class="tab-button" onclick="openFaction('nilfgaard')">
                    <?= htmlspecialchars($lang['faction_nilfgaard_name']) ?>
                </button>
                <button class="tab-button" onclick="openFaction('sorcerers')">
                    <?= htmlspecialchars($lang['faction_sorcerers_name']) ?>
                </button>
            </div>

            <div id="northern" class="tab-content" style="display: block;">
                <h4><?= htmlspecialchars($lang['faction_northern_name']) ?></h4>
                <p><?= htmlspecialchars($lang['faction_northern']) ?></p>
            </div>

            <div id="nilfgaard" class="tab-content">
                <h4><?= htmlspecialchars($lang['faction_nilfgaard_name']) ?></h4>
                <p><?= htmlspecialchars($lang['faction_nilfgaard']) ?></p>
            </div>

            <div id="sorcerers" class="tab-content">
                <h4><?= htmlspecialchars($lang['faction_sorcerers_name']) ?></h4>
                <p><?= htmlspecialchars($lang['faction_sorcerers']) ?></p>
            </div>
        </section>

        <section class="bestiary-preview">
            <h3><?= htmlspecialchars($lang['bestiary_title'] ?? 'Бестиарий') ?></h3>
            <div class="monster-grid">
                <div class="monster-card">
                    <img src="images/monsters/monster1.jpg" alt="<?= htmlspecialchars($lang['monster_ghoul'] ?? 'Гуль') ?>" loading="lazy">
                    <h4><?= htmlspecialchars($lang['monster_ghoul'] ?? 'Гуль') ?></h4>
                </div>
                <div class="monster-card">
                    <img src="images/monsters/monster2.jpg" alt="<?= htmlspecialchars($lang['monster_draugr'] ?? 'Драуг') ?>" loading="lazy">
                    <h4><?= htmlspecialchars($lang['monster_draugr'] ?? 'Драуг') ?></h4>
                </div>
                <div class="monster-card">
                    <img src="images/monsters/monster3.jpg" alt="<?= htmlspecialchars($lang['monster_striga'] ?? 'Стрыга') ?>" loading="lazy">
                    <h4><?= htmlspecialchars($lang['monster_striga'] ?? 'Стрыга') ?></h4>
                </div>
            </div>
            <button class="see-more" onclick="alert('<?= htmlspecialchars($lang['coming_soon'] ?? 'Скоро будет доступно!') ?>')">
                <?= htmlspecialchars($lang['see_more'] ?? 'Смотреть больше') ?>
            </button>
        </section>
    </main>

    <footer>
        <p><?= htmlspecialchars($lang['footer_text']) ?></p>
    </footer>

    <script src="js/world.js"></script>
</body>
</html>