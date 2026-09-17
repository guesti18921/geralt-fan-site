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

<?php ob_start(); require __DIR__ . '/head.php'; $worldHead = ob_get_clean(); echo str_replace('</head>', '<style>
.wl-world .wl-lead{max-width:800px;margin:0 auto 24px;text-align:center;color:#ccc}
.wl-world .wl-jumps{display:flex;flex-wrap:wrap;justify-content:center;gap:12px;margin:24px 0 32px}
.wl-world .wl-jumps a{padding:10px 18px;border:1px solid #77623e;border-radius:6px;color:#e4c78d;text-decoration:none}
.wl-world .wl-location{border:1px solid #4d4435;border-radius:12px;overflow:hidden;background:#252422;margin-bottom:32px;scroll-margin-top:100px}
.wl-world .wl-location>img{display:block;width:100%;height:320px;object-fit:cover}
.wl-world .wl-body{padding:30px}.wl-world .wl-tag{color:#c0a062;font-size:.9rem;letter-spacing:.05em}
.wl-world .wl-body h3{font-size:2rem;margin:10px 0 16px}.wl-world .wl-body h4{color:#dfc18a;font-size:1.2rem;margin-bottom:10px}
.wl-world .wl-body p{line-height:1.8;color:#d7d3cc}.wl-world .wl-facts{display:grid;grid-template-columns:1fr 1fr;gap:28px;margin-top:24px}
.wl-world .wl-people{border-top:1px solid #494132;padding-top:20px;margin-top:12px}
.wl-world details{border:1px solid #5c4d35;border-radius:6px;margin-top:20px}.wl-world summary{padding:14px 18px;color:#e4c78d;cursor:pointer}.wl-world details p{padding:0 18px 18px;margin:0}
.wl-world .wl-source{font-size:.85rem;text-align:right}.wl-world .wl-source a{color:#bca77e}
.wl-world a:focus-visible,.wl-world summary:focus-visible,.wl-world button:focus-visible{outline:3px solid #e0bd77;outline-offset:3px}
@media(max-width:760px){.wl-world .wl-facts{grid-template-columns:1fr;gap:12px}.wl-world .wl-body{padding:20px}.wl-world .wl-location>img{height:220px}.wl-world .nav-menu{flex-direction:row}.wl-world .nav-menu li{margin:0}.wl-world .nav-menu a{font-size:14px;padding:8px}.wl-world header.parallax{background-attachment:scroll}.wl-world .monster-grid{grid-template-columns:1fr}.wl-world .wl-location{scroll-margin-top:130px}}
</style></head>', $worldHead); ?>

<body class="wl-world">
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

<?php if ($_SESSION['lang'] === 'ru'): ?><section class="wl-locations" aria-labelledby="wl-title"><h2 id="wl-title">Три лица Континента</h2><p class="wl-lead">Крепость, большой город и островной архипелаг. Знакомство с локациями The Witcher 3 без раскрытия сюжетных развязок.</p><div class="wl-jumps"><a href="#wl-kaer-morhen">Каэр Морхен</a><a href="#wl-novigrad">Новиград</a><a href="#wl-skellige">Скеллиге</a></div><article class="wl-location" id="wl-kaer-morhen"><img src="images/locations/kaer-morhen.jpg" alt="Каэр Морхен" loading="lazy"><div class="wl-body"><span class="wl-tag">01 · Дом Школы Волка</span><h3>Каэр Морхен</h3><p>Крепость среди гор, где тишину нарушают ветер и звон тренировочных мечей. Для Геральта это место возвращения: здесь остались память об обучении и связь с другими ведьмаками.</p><div class="wl-facts"><div><h4>Атмосфера</h4><p>Старые стены, внутренний двор и горные тропы напоминают о времени, когда в крепости готовили новых охотников на чудовищ. Теперь её масштаб особенно заметен на фоне немногих обитателей.</p></div><div><h4>Роль в истории</h4><p>В игровой истории крепость связана с подготовкой ведьмаков, воспоминаниями о Цири и встречами старых товарищей. Здесь профессия Геральта раскрывается через повседневную жизнь, а не только через заказы.</p></div></div><div class="wl-people"><h4>Связанные персонажи</h4><p>Весемир, Эскель, Ламберт и Цири.</p></div><details><summary>Что заметить в игре</summary><p>Посмотри на разрушенные укрепления и тренировочные площадки: окружение рассказывает о прошлом Школы Волка.</p></details></div></article><article class="wl-location" id="wl-novigrad"><img src="images/locations/novigrad.jpg" alt="Новиград" loading="lazy"><div class="wl-body"><span class="wl-tag">02 · Город торговли и противоречий</span><h3>Новиград</h3><p>Шумные площади, гавань и тесные переулки складываются в город, где за богатством скрываются страх и борьба за влияние. Здесь информация иногда ценнее серебряного меча.</p><div class="wl-facts"><div><h4>Атмосфера</h4><p>Рядом существуют купеческие дома, таверны, мастерские и бедные кварталы. В The Witcher 3 влияние Вечного Огня и преследование магов делают город опасным даже для тех, кто не носит оружия.</p></div><div><h4>Роль в истории</h4><p>Новиград — один из этапов поисков Цири. Геральту приходится обращаться к знакомым, разбираться в чужих интересах и искать следы среди городских слухов.</p></div></div><div class="wl-people"><h4>Связанные персонажи</h4><p>Трисс Меригольд, Лютик и Золтан Хивай.</p></div><details><summary>Что заметить в игре</summary><p>Обрати внимание на контраст между оживлёнными рынками и закоулками: у разных частей города свой характер.</p></details></div></article><article class="wl-location" id="wl-skellige"><img src="images/locations/skellige.jpg" alt="Скеллиге" loading="lazy"><div class="wl-body"><span class="wl-tag">03 · Острова, кланы и море</span><h3>Скеллиге</h3><p>Скалистые берега, холодное море и поселения, живущие традициями кланов. Путь между островами ощущается путешествием на край знакомого мира.</p><div class="wl-facts"><div><h4>Атмосфера</h4><p>Жизнь архипелага связана с морем, семейными узами и репутацией. Залы правителей соседствуют с небольшими деревнями, а горные дороги ведут к руинам и местам старых легенд.</p></div><div><h4>Роль в истории</h4><p>В The Witcher 3 Геральт и Йеннифэр ищут здесь следы Цири. Одновременно ведьмак знакомится с местными обычаями и оказывается рядом с борьбой за будущее островов.</p></div></div><div class="wl-people"><h4>Связанные персонажи</h4><p>Йеннифэр, Крах ан Крайт, Керис и Хьялмар.</p></div><details><summary>Что заметить в игре</summary><p>Не ограничивайся главными поселениями: вид с горных троп и небольшие побочные истории передают характер островов.</p></details></div></article><p class="wl-source"><a href="https://en.wikipedia.org/wiki/The_Witcher_3:_Wild_Hunt">Об игре и её мире</a></p></section><?php else: ?><section class="wl-locations" aria-labelledby="wl-title"><h2 id="wl-title">Three faces of the Continent</h2><p class="wl-lead">A stronghold, a great city, and an island archipelago. Explore these locations from The Witcher 3 without spoilers for their endings.</p><div class="wl-jumps"><a href="#wl-kaer-morhen">Kaer Morhen</a><a href="#wl-novigrad">Novigrad</a><a href="#wl-skellige">Skellige</a></div><article class="wl-location" id="wl-kaer-morhen"><img src="images/locations/kaer-morhen.jpg" alt="Kaer Morhen" loading="lazy"><div class="wl-body"><span class="wl-tag">01 · Home of the School of the Wolf</span><h3>Kaer Morhen</h3><p>A mountain stronghold where wind and training blades break the silence. For Geralt, it is a place of return, linked to his training and his fellow witchers.</p><div class="wl-facts"><div><h4>Atmosphere</h4><p>Old walls, a courtyard, and mountain trails recall a time when new monster hunters trained here. The few remaining inhabitants make the scale of the fortress feel even greater.</p></div><div><h4>Role in the story</h4><p>In the games, the stronghold connects witcher training, memories of Ciri, and reunions with old companions. It reveals the everyday life behind Geralt’s profession.</p></div></div><div class="wl-people"><h4>Connected characters</h4><p>Vesemir, Eskel, Lambert, and Ciri.</p></div><details><summary>What to notice in the game</summary><p>Look at the damaged fortifications and training grounds: the surroundings tell the story of the School of the Wolf.</p></details></div></article><article class="wl-location" id="wl-novigrad"><img src="images/locations/novigrad.jpg" alt="Novigrad" loading="lazy"><div class="wl-body"><span class="wl-tag">02 · Trade and contradictions</span><h3>Novigrad</h3><p>Busy squares, a harbour, and narrow alleys form a city where wealth hides fear and struggles for influence. Information can be worth more than a silver sword here.</p><div class="wl-facts"><div><h4>Atmosphere</h4><p>Merchant houses, taverns, workshops, and poorer quarters stand side by side. In The Witcher 3, the Eternal Fire’s influence and the persecution of mages make the city dangerous even for those without weapons.</p></div><div><h4>Role in the story</h4><p>Novigrad is one stage of the search for Ciri. Geralt turns to old acquaintances and follows rumours through competing interests.</p></div></div><div class="wl-people"><h4>Connected characters</h4><p>Triss Merigold, Dandelion, and Zoltan Chivay.</p></div><details><summary>What to notice in the game</summary><p>Notice the contrast between lively markets and back alleys: each part of the city has its own character.</p></details></div></article><article class="wl-location" id="wl-skellige"><img src="images/locations/skellige.jpg" alt="Skellige" loading="lazy"><div class="wl-body"><span class="wl-tag">03 · Islands, clans, and the sea</span><h3>Skellige</h3><p>Rocky shores, cold seas, and settlements shaped by clan traditions. Travelling between the islands feels like a journey to the edge of the familiar world.</p><div class="wl-facts"><div><h4>Atmosphere</h4><p>Life in the archipelago revolves around the sea, family ties, and reputation. Great halls stand alongside small villages, while mountain roads lead to ruins and old legends.</p></div><div><h4>Role in the story</h4><p>In The Witcher 3, Geralt and Yennefer follow Ciri’s trail here. The witcher also encounters local customs and the struggle over the islands’ future.</p></div></div><div class="wl-people"><h4>Connected characters</h4><p>Yennefer, Crach an Craite, Cerys, and Hjalmar.</p></div><details><summary>What to notice in the game</summary><p>Venture beyond the main settlements: mountain views and smaller side stories capture the character of the islands.</p></details></div></article><p class="wl-source"><a href="https://en.wikipedia.org/wiki/The_Witcher_3:_Wild_Hunt">About the game and its world</a></p></section><?php endif; ?>
        <section class="factions">
            <h3><?= htmlspecialchars($lang['factions_title']) ?></h3>
            <div class="faction-tabs">
                <button class="tab-button active" data-faction="northern">
                    <?= htmlspecialchars($lang['faction_northern_name']) ?>
                </button>
                <button class="tab-button" data-faction="nilfgaard">
                    <?= htmlspecialchars($lang['faction_nilfgaard_name']) ?>
                </button>
                <button class="tab-button" data-faction="sorcerers">
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

    <script>
(() => {
 const buttons = document.querySelectorAll('[data-faction]');
 function select(button) {
  buttons.forEach(item => {
   const active = item === button;
   item.classList.toggle('active', active);
   item.setAttribute('aria-pressed', String(active));
   document.getElementById(item.dataset.faction).style.display = active ? 'block' : 'none';
  });
 }
 buttons.forEach(button => {
  button.type = 'button';
  button.setAttribute('aria-controls', button.dataset.faction);
  button.addEventListener('click', () => select(button));
 });
 if (buttons.length) select(buttons[0]);
})();
</script>
</body>
</html>
