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
<?php ob_start(); require __DIR__ . '/head.php'; $homeHead = ob_get_clean(); echo str_replace('</head>', '<style>
.gh-home main{max-width:1200px;margin:50px auto;padding:0 24px}.gh-home main section{margin-bottom:64px}.gh-home #intro{scroll-margin-top:100px}.gh-home .intro>p{max-width:950px;margin:0 auto 20px}.gh-home .features{grid-template-columns:repeat(3,minmax(0,1fr));gap:24px}.gh-home .feature-card{min-width:0}
.gh-home .gh-columns{display:grid;grid-template-columns:repeat(3,minmax(0,1fr));gap:24px}.gh-home .gh-panel{background:#242321;border:1px solid #494132;border-radius:10px;padding:26px}.gh-home .gh-panel h3{font-size:1.45rem}.gh-home .gh-number{display:block;color:#c0a062;font-size:1.8rem;margin-bottom:12px}.gh-home .gh-eyebrow{display:block;text-align:center;color:#c0a062;font-size:.9rem;letter-spacing:.05em;margin-bottom:10px}.gh-home .gh-signs>p{text-align:center;color:#ccc;max-width:780px;margin:0 auto 24px}.gh-home .gh-sign-list{display:grid;gap:12px;max-width:900px;margin:auto}.gh-home details{border:1px solid #514630;background:#252421;border-radius:8px}.gh-home summary{cursor:pointer;padding:18px 22px}.gh-home summary strong{display:inline-block;color:#e0bd77;font-size:1.3rem;min-width:110px;margin-right:12px}.gh-home summary span{color:#d2cbc0}.gh-home details[open] summary{border-bottom:1px solid #514630}.gh-home details p{padding:18px 22px;margin:0}.gh-home .gh-link-card{display:flex;flex-direction:column;text-decoration:none;color:inherit;background:#292929;border:1px solid #494132;border-radius:10px;overflow:hidden}.gh-home .gh-link-card img{width:100%;height:210px;object-fit:cover}.gh-home .gh-link-card>div{padding:24px;display:flex;flex-direction:column;flex:1}.gh-home .gh-link-card h3{font-size:1.5rem}.gh-home .gh-link-label{margin-top:auto;color:#e0bd77;padding-top:12px}.gh-home .gh-link-card:hover{border-color:#c0a062}.gh-home a:focus-visible,.gh-home summary:focus-visible,.gh-home button:focus-visible{outline:3px solid #e0bd77;outline-offset:4px}.gh-home .scroll-down{margin:20px auto}.gh-home footer p{margin-bottom:0}
@media(max-width:800px){.gh-home .features,.gh-home .gh-columns{grid-template-columns:1fr}.gh-home .gh-link-card img{height:240px}.gh-home .nav-menu{flex-direction:row;gap:0}.gh-home .nav-menu li{margin:0}.gh-home .nav-menu a{font-size:14px;padding:8px}.gh-home header.parallax{background-attachment:scroll}.gh-home main{padding:0 18px}.gh-home summary span{display:block;margin:5px 0 0 18px}.gh-home main section{margin-bottom:44px}}
@media(prefers-reduced-motion:reduce){.gh-home *{animation:none!important;transition:none!important;scroll-behavior:auto!important}}

.gh-home .gh-sign-list summary{display:grid;grid-template-columns:44px 110px minmax(0,1fr) 16px;align-items:center;gap:18px;list-style:none}
.gh-home .gh-sign-list summary::-webkit-details-marker{display:none}
.gh-home .gh-sign-list summary::marker{content:""}
.gh-home .gh-sign-list summary::after{content:"";width:9px;height:9px;border-right:2px solid #e0bd77;border-bottom:2px solid #e0bd77;transform:rotate(-45deg);justify-self:center;transition:transform .2s}
.gh-home .gh-sign-list details[open] summary::after{transform:rotate(45deg)}
.gh-home .gh-sign-list .gh-sign-icon{display:block;width:44px;height:44px;color:#e0bd77;background:#171714;border-radius:6px;padding:3px}
.gh-home .gh-sign-list summary strong{min-width:0;margin:0}
.gh-home .gh-sign-list summary span{margin:0}
@media(max-width:600px){.gh-home .gh-sign-list summary{grid-template-columns:44px minmax(0,1fr) 16px;gap:4px 14px;padding:16px}.gh-home .gh-sign-list .gh-sign-icon{grid-column:1;grid-row:1 / 3}.gh-home .gh-sign-list summary strong{grid-column:2;grid-row:1}.gh-home .gh-sign-list summary span{grid-column:2;grid-row:2;font-size:.9rem}.gh-home .gh-sign-list summary::after{grid-column:3;grid-row:1 / 3}}
</style></head>', $homeHead); ?>

<body class="gh-home">
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
                <h3><?= $_SESSION['lang'] === 'ru' ? 'Школа Волка' : 'School of the Wolf' ?></h3>
                <p><?= htmlspecialchars($lang['feature2_text']) ?></p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">🔮</div>
                <h3><?= htmlspecialchars($lang['feature3_title']) ?></h3>
                <p><?= htmlspecialchars($lang['feature3_text']) ?></p>
            </div>
        </section>
<?php if ($_SESSION['lang'] === 'ru'): ?><section class="gh-craft"><span class="gh-eyebrow">Подготовка важнее удачи</span><h2>Ремесло ведьмака</h2><div class="gh-columns"><article class="gh-panel"><span class="gh-number">01</span><h3>Следы и свидетельства</h3><p>Прежде чем обнажить меч, Геральт осматривает место нападения, изучает следы и расспрашивает свидетелей. Знание повадок противника помогает понять, с кем предстоит столкнуться.</p></article><article class="gh-panel"><span class="gh-number">02</span><h3>Мечи и алхимия</h3><p>В играх стальной меч служит против людей и обычных зверей, а серебряный — против многих чудовищ. Масла, эликсиры и бомбы дополняют технику боя: подходящее снаряжение выбирают под конкретного врага.</p></article><article class="gh-panel"><span class="gh-number">03</span><h3>Выбор и последствия</h3><p>Не всякое чудовище оказывается врагом, и не каждый заказчик говорит правду. Иногда работа ведьмака — понять причину проклятия или решить, кому можно доверять.</p></article></div></section><section class="gh-signs"><h2>Пять ведьмачьих знаков</h2><p>Краткий справочник по базовому применению знаков в The Witcher 3. Нажми на название, чтобы раскрыть описание.</p><div class="gh-sign-list"><details><summary><svg class="gh-sign-icon" viewBox="0 0 64 64" aria-hidden="true" focusable="false"><path d="M32 5 L59 53 H5 L16 34 H33 L38 41 H20 L17 46 H47 L32 20 L25 31 H17 Z" fill="currentColor"/></svg><strong>Аард</strong><span>Телекинетический толчок</span></summary><p>Отбрасывает противников и помогает нарушить их равновесие. Также позволяет разрушать некоторые препятствия.</p></details><details><summary><svg class="gh-sign-icon" viewBox="0 0 64 64" aria-hidden="true" focusable="false"><path d="M32 7 L36 14 L17 47 H48 L35 25 L39 18 L60 54 H4 Z" fill="currentColor"/></svg><strong>Игни</strong><span>Огонь</span></summary><p>Обжигает врагов перед Геральтом и может поджечь их. Результат зависит от противника и развития знака.</p></details><details><summary><svg class="gh-sign-icon" viewBox="0 0 64 64" aria-hidden="true" focusable="false"><path d="M5 9 H59 L48 28 H28 L24 21 H44 L47 16 H18 L32 42 L36 34 H45 L32 55 Z" fill="currentColor"/></svg><strong>Квен</strong><span>Защита</span></summary><p>Создаёт защитный щит, который помогает пережить удар. Полезен, когда нужно сблизиться с опасным противником или восстановить инициативу.</p></details><details><summary><svg class="gh-sign-icon" viewBox="0 0 64 64" aria-hidden="true" focusable="false"><path d="M6 8 H59 L37 30 L32 25 L43 15 H23 L54 55 H3 L24 34 L29 39 L20 48 H38 Z" fill="currentColor"/></svg><strong>Ирден</strong><span>Магическая ловушка</span></summary><p>Создаёт область, замедляющую противников. Особенно полезен против призраков, которых помогает сделать уязвимыми для атак.</p></details><details><summary><svg class="gh-sign-icon" viewBox="0 0 64 64" aria-hidden="true" focusable="false"><path d="M5 10 H59 L55 17 H18 L32 42 L43 23 H51 L32 56 Z" fill="currentColor"/></svg><strong>Аксий</strong><span>Воздействие на разум</span></summary><p>Позволяет временно оглушить противника. При развитии соответствующего умения открывает дополнительные варианты в некоторых диалогах.</p></details></div></section><section><span class="gh-eyebrow">Продолжить знакомство</span><h2>У каждой дороги своя история</h2><div class="gh-columns"><a class="gh-link-card" href="about.php"><img src="images/portraits/geralt-bio.jpg" alt="" loading="lazy"><div><h3>О Геральте</h3><p>Его путь, близкие люди и история в книгах и играх.</p><span class="gh-link-label">Открыть раздел →</span></div></a><a class="gh-link-card" href="world.php"><img src="images/locations/kaer-morhen.jpg" alt="" loading="lazy"><div><h3>Мир Ведьмака</h3><p>Каэр Морхен, Новиград и Скеллиге: места, народы и опасности Континента.</p><span class="gh-link-label">Открыть раздел →</span></div></a><a class="gh-link-card" href="gallery.php"><img src="images/gallery/geralt2.jpg" alt="" loading="lazy"><div><h3>Галерея</h3><p>Кадры с Геральтом: открывай изображения и рассматривай детали.</p><span class="gh-link-label">Открыть раздел →</span></div></a></div></section><?php else: ?><section class="gh-craft"><span class="gh-eyebrow">Preparation before luck</span><h2>The witcher’s craft</h2><div class="gh-columns"><article class="gh-panel"><span class="gh-number">01</span><h3>Tracks and testimony</h3><p>Before drawing his sword, Geralt examines attack sites, follows tracks, and questions witnesses. Understanding a creature’s habits helps him identify what he is facing.</p></article><article class="gh-panel"><span class="gh-number">02</span><h3>Swords and alchemy</h3><p>In the games, steel is used against humans and ordinary beasts, while silver is used against many monsters. Oils, potions, and bombs complement swordsmanship: preparation depends on the enemy.</p></article><article class="gh-panel"><span class="gh-number">03</span><h3>Choices and consequences</h3><p>Not every monster is an enemy, and not every client tells the truth. A witcher’s work can mean understanding a curse or deciding whom to trust.</p></article></div></section><section class="gh-signs"><h2>Five witcher signs</h2><p>A short guide to the basic uses of signs in The Witcher 3. Select a name to reveal its description.</p><div class="gh-sign-list"><details><summary><svg class="gh-sign-icon" viewBox="0 0 64 64" aria-hidden="true" focusable="false"><path d="M32 5 L59 53 H5 L16 34 H33 L38 41 H20 L17 46 H47 L32 20 L25 31 H17 Z" fill="currentColor"/></svg><strong>Aard</strong><span>Telekinetic force</span></summary><p>Pushes enemies back and can knock them off balance. It can also destroy certain obstacles.</p></details><details><summary><svg class="gh-sign-icon" viewBox="0 0 64 64" aria-hidden="true" focusable="false"><path d="M32 7 L36 14 L17 47 H48 L35 25 L39 18 L60 54 H4 Z" fill="currentColor"/></svg><strong>Igni</strong><span>Fire</span></summary><p>Scorches enemies in front of Geralt and may ignite them. Its effect depends on the enemy and the sign’s upgrades.</p></details><details><summary><svg class="gh-sign-icon" viewBox="0 0 64 64" aria-hidden="true" focusable="false"><path d="M5 9 H59 L48 28 H28 L24 21 H44 L47 16 H18 L32 42 L36 34 H45 L32 55 Z" fill="currentColor"/></svg><strong>Quen</strong><span>Protection</span></summary><p>Creates a protective shield that helps Geralt withstand a hit. Useful when approaching a dangerous foe or regaining the initiative.</p></details><details><summary><svg class="gh-sign-icon" viewBox="0 0 64 64" aria-hidden="true" focusable="false"><path d="M6 8 H59 L37 30 L32 25 L43 15 H23 L54 55 H3 L24 34 L29 39 L20 48 H38 Z" fill="currentColor"/></svg><strong>Yrden</strong><span>Magic trap</span></summary><p>Creates an area that slows enemies. Particularly useful against wraiths, helping make them vulnerable to attacks.</p></details><details><summary><svg class="gh-sign-icon" viewBox="0 0 64 64" aria-hidden="true" focusable="false"><path d="M5 10 H59 L55 17 H18 L32 42 L43 23 H51 L32 56 Z" fill="currentColor"/></svg><strong>Axii</strong><span>Influence over the mind</span></summary><p>Can temporarily stun an opponent. Investing in the relevant ability also unlocks options in certain conversations.</p></details></div></section><section><span class="gh-eyebrow">Explore further</span><h2>Every path has a story</h2><div class="gh-columns"><a class="gh-link-card" href="about.php"><img src="images/portraits/geralt-bio.jpg" alt="" loading="lazy"><div><h3>About Geralt</h3><p>His journey, companions, and story in the books and games.</p><span class="gh-link-label">Explore section →</span></div></a><a class="gh-link-card" href="world.php"><img src="images/locations/kaer-morhen.jpg" alt="" loading="lazy"><div><h3>The Witcher’s world</h3><p>Kaer Morhen, Novigrad, and Skellige: places, peoples, and dangers of the Continent.</p><span class="gh-link-label">Explore section →</span></div></a><a class="gh-link-card" href="gallery.php"><img src="images/gallery/geralt2.jpg" alt="" loading="lazy"><div><h3>Gallery</h3><p>Images of Geralt: open a picture and explore the details.</p><span class="gh-link-label">Explore section →</span></div></a></div></section><?php endif; ?>
    </main>

    <footer>
        <p><?= $_SESSION['lang'] === 'ru' ? 'Геральт из Ривии — фан-сайт' : 'Geralt of Rivia — fan site' ?></p>
        <button class="back-to-top" onclick="scrollToTop()" aria-label="<?= htmlspecialchars($lang['back_to_top']) ?>">↑</button>
    </footer>

    <script src="js/script.js"></script>
</body>
</html>
