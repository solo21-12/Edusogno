<div class="navbar">
    <a href="index.php" class="navbar-logo">
        <img src="../../common/assets/logo.jpeg" alt="Logo" class="navbar-logo-image" />
        <p>
            Edu
            <br />
            Sogno
        </p>
    </a>
    <?php
    if (isset($_COOKIE['user'])) {
        if (isset($_GET['logout'])) {
            setcookie('user', '', time() - 3600, '/');
            header('Location: login.php');
            exit;
        }
        echo '<a href="?logout" class="navbar-logout">Disconnettersi</a>';
    }
    ?>
</div>