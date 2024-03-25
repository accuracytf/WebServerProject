<ul class="navbar">
    <li><a href="index.php">Hem</a></li>
    <li><a href="index.php?page=posts">Posts</a></li>
    <li><a href="index.php?page=blog">Profil</a></li>
    <?php
    if (isset($_SESSION["inloggad"])) {
        echo '<li><a href="index.php?page=logout">Logga ut</a></li>';
    } else {
        echo '<li><a href="index.php?page=login">Logga in</a></li>';
    } ?>
</ul>


