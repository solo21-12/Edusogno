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
    session_start();
    if (isset($_SESSION['user_id'])) {
        if (isset($_GET['logout'])) {
            session_unset();
            session_destroy();
            header('Location: login.php');
            exit;
        }
        echo '<a href="?logout" class="navbar-logout">Disconnettersi</a>';
    }
    ?>
</div>