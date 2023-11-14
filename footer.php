<?php
echo <<<'EOT'
<footer>
<div class="footer-content">
    <a class="footer__logo-link" href="index.php">
        <img alt="Кроссы и точка" src="./images/logo_footer.svg" class="footer__logo-image" />
    </a>
    <nav>
        <ul class="nav-list">
            <li class="nav-item">
                <a href="order.php" class="nav-link">💬 Заказ</a>
            </li>
            <li class="nav-item">
                <a href="contragent.php" class="nav-link">😊 Партнеры</a>
            </li>
            <li class="nav-item">
                <a href="warehouse.php" class="nav-link">📺 Склад</a>
            </li>
        </ul>
    </nav>
</div>
<div class="copyright">
    <p class="copyright-text">КРОССЫ И ТОЧКА® 2023</p>
</div>
</footer>
EOT;
?>
