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
