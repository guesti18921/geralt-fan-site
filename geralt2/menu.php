<?php
$currentPage = basename(
    parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) ?? ''
);

if ($currentPage === '') {
    $currentPage = 'index.php';
}

$pages = [
    'index.php' => 'home',
    'about.php' => 'about',
    'gallery.php' => 'gallery',
    'world.php' => 'world',
];
?>

<nav>
    <ul class="nav-menu">
        <?php foreach ($pages as $file => $label): ?>
            <li>
                <a
                    href="<?= htmlspecialchars($file) ?>"
                    class="<?= $currentPage === $file ? 'active' : '' ?>"
                    <?= $currentPage === $file ? 'aria-current="page"' : '' ?>
                >
                    <?= htmlspecialchars($lang[$label]) ?>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
</nav>