<?php
$basePath = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/');
$indexUrl = "{$basePath}/../../admin/pages/index.php";
?>

<div class="navbar">
    <a href="<?php echo $indexUrl; ?>" class="navbar-logout">
        <img src="../../common/assets/logo.jpeg" alt="Logo" class="navbar-logo-image" />
        <p>
            Edu
            <br />
            Sogno
        </p>
    </a>
    <?php
    if (isset($_COOKIE['admin'])) {
        if (isset($_GET['logout'])) {
            setcookie('admin', '', time() - 3600, '/');
            header('Location: login.php');
            exit;
        }
        echo '<a href="?logout" class="navbar-logout">Disconnettersi</a>';
    }
    ?>
</div>