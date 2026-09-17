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
<?php ob_start(); require __DIR__ . '/head.php'; $galleryHead=ob_get_clean(); echo str_replace('</head>', '<style>
header.gc-cover{display:grid;grid-template-columns:minmax(0,1fr) minmax(0,1fr);align-items:center;gap:40px;max-width:1160px;margin:0 auto;padding:70px 24px 32px;background:transparent;color:#eee;text-align:left}
header.gc-cover::before{display:none}header.gc-cover img{display:block;max-width:100%;width:auto;height:auto;max-height:72vh;object-fit:contain;margin:auto;border-radius:8px}
header.gc-cover .header-content{padding:0;margin:0;text-align:left}header.gc-cover h1{font-size:clamp(2rem,4vw,3.6rem);line-height:1.2;color:#e0bd77}header.gc-cover p{font-size:1.2rem;color:#ddd}
@media(max-width:650px){header.gc-cover{grid-template-columns:1fr;gap:24px;padding:72px 18px 28px}header.gc-cover img{max-height:62vh}header.gc-cover .header-content{text-align:center}header.gc-cover h1{font-size:2rem}}
</style></head>', $galleryHead); ?>

<body>
    <div class="language-switcher">
        <a href="?lang=en" class="<?= $_SESSION['lang'] === 'en' ? 'active' : '' ?>">EN</a>
        <a href="?lang=ru" class="<?= $_SESSION['lang'] === 'ru' ? 'active' : '' ?>">RU</a>
    </div>

    <header class="gc-cover"><img src="images/banners/gallery-cover.jpg" alt="<?= $_SESSION['lang'] === 'ru' ? 'Портрет Геральта' : 'Portrait of Geralt' ?>">
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
                <button type="button" class="gallery-item gg-card" data-gallery-index="<?= $index ?>">
                    <img src="images/gallery/<?= htmlspecialchars($image['file']) ?>" 
                         alt="<?= htmlspecialchars($image['desc']) ?>"
                         loading="lazy">
                    <span class="gg-label"><?= htmlspecialchars($image['desc']) ?></span>
                </button>
                <?php endforeach; ?>
            </div>
        </section>

    </main>

    <footer>
        <p><?= htmlspecialchars($lang['footer_text']) ?></p>
    </footer>

    <dialog id="gg-viewer" aria-label="<?= $_SESSION['lang'] === 'ru' ? 'Просмотр фотографий' : 'Image viewer' ?>">
        <button type="button" id="gg-close" aria-label="<?= $_SESSION['lang'] === 'ru' ? 'Закрыть' : 'Close' ?>">×</button>
        <button type="button" id="gg-prev" aria-label="<?= $_SESSION['lang'] === 'ru' ? 'Предыдущее фото' : 'Previous image' ?>">❮</button>
        <figure><img id="gg-image" alt=""><figcaption id="gg-caption"></figcaption><div id="gg-count"></div></figure>
        <button type="button" id="gg-next" aria-label="<?= $_SESSION['lang'] === 'ru' ? 'Следующее фото' : 'Next image' ?>">❯</button>
    </dialog>
    <style>
    .gg-card { display:block; width:100%; padding:0; border:0; background:#222; color:#fff; font:inherit; cursor:pointer; }
    .gg-card:focus-visible { outline:3px solid #d8b878; outline-offset:4px; }
    .gg-label { display:block; position:absolute; bottom:0; left:0; right:0; padding:12px; background:rgba(0,0,0,.8); transform:translateY(100%); transition:transform .2s; pointer-events:none; }
    .gg-card:hover .gg-label, .gg-card:focus-visible .gg-label { transform:translateY(0); }
    #gg-viewer { position:fixed; inset:0; width:100vw; max-width:none; height:100dvh; max-height:none; box-sizing:border-box; margin:0; padding:64px 68px 24px; border:0; background:rgba(0,0,0,.94); color:#fff; overflow:auto; }
    #gg-viewer[open] { display:flex; align-items:center; justify-content:center; gap:12px; opacity:1; visibility:visible; }
    #gg-viewer::backdrop { background:rgba(0,0,0,.8); }
    #gg-viewer figure { margin:0; min-width:0; max-width:1200px; text-align:center; }
    #gg-image { display:block; width:auto; height:auto; max-width:100%; max-height:calc(100dvh - 160px); object-fit:contain; margin:auto; border-radius:6px; }
    #gg-caption { padding:14px 0 6px; font-size:18px; overflow-wrap:anywhere; }
    #gg-count { color:#bbb; font:14px sans-serif; }
    #gg-viewer button { position:fixed; display:grid; place-items:center; width:44px; height:44px; padding:0; border:1px solid #888; border-radius:8px; background:#222; color:#fff; font:26px sans-serif; cursor:pointer; z-index:1; }
    #gg-viewer button:hover { background:#444; }
    #gg-viewer button:focus-visible { outline:3px solid #d8b878; outline-offset:3px; }
    #gg-close { top:12px; right:16px; }
    #gg-prev { top:50%; left:12px; transform:translateY(-50%); }
    #gg-next { top:50%; right:12px; transform:translateY(-50%); }
    @media(max-width:600px) { #gg-viewer { padding:64px 12px 80px; } #gg-prev,#gg-next { top:auto; bottom:16px; transform:none; } .gg-label { transform:none; } }
    </style>
    <script>
    (() => {
        const cards = Array.from(document.querySelectorAll('[data-gallery-index]'));
        const viewer = document.getElementById('gg-viewer');
        const picture = document.getElementById('gg-image');
        const caption = document.getElementById('gg-caption');
        const count = document.getElementById('gg-count');
        let index = 0;
        let opener = null;
        let oldOverflow = '';
        function show(next) {
            index = (next + cards.length) % cards.length;
            const source = cards[index].querySelector('img');
            picture.src = source.src;
            picture.alt = source.alt;
            caption.textContent = source.alt;
            count.textContent = `${index + 1} / ${cards.length}`;
        }
        cards.forEach((card, i) => card.addEventListener('click', () => {
            opener = card;
            show(i);
            if (!viewer.open) {
                oldOverflow = document.body.style.overflow;
                viewer.showModal();
                document.body.style.overflow = 'hidden';
                document.getElementById('gg-close').focus();
            }
        }));
        document.getElementById('gg-close').addEventListener('click', () => viewer.close());
        document.getElementById('gg-prev').addEventListener('click', () => show(index - 1));
        document.getElementById('gg-next').addEventListener('click', () => show(index + 1));
        viewer.addEventListener('click', event => { if (event.target === viewer) viewer.close(); });
        viewer.addEventListener('close', () => {
            document.body.style.overflow = oldOverflow;
            opener?.focus();
            opener?.blur();
        });
        viewer.addEventListener('keydown', event => {
            if (event.key === 'ArrowLeft' || event.key === 'ArrowRight') {
                event.preventDefault();
                show(index + (event.key === 'ArrowRight' ? 1 : -1));
            }
        });
        const header = document.querySelector('.parallax');
        window.addEventListener('scroll', () => {
            if (header) header.style.backgroundPositionY = `${window.scrollY * 0.7}px`;
        }, { passive: true });
    })();
    </script>
</body>
</html>
