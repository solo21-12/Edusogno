<?php
if (isset($_SESSION['admin_id'])) {
  header("Location: index.php");
  exit;
}
$error_message = isset($_GET['error']) ? $_GET['error'] : '';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login Page</title>
  <link rel="stylesheet" href="../../common/styles/navbar.css" />
  <link rel="stylesheet" href="../../common/styles/styles.css" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Barlow:ital,wght@0,600;1,400;1,500;1,600&family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&family=Roboto:ital,wght@1,400;1,700&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
  <link rel="icon" type="image/jpeg" href="../../common/assets/logo.jpeg">

</head>

<body>
  <?php include("../../common/components/navbarAdmin.php"); ?>

  <div class="top-container">
    <div class="title">Hai già un account?</div>
    <?php if (!empty($error_message)) { ?>
      <div class="error"><?php echo $error_message; ?></div>
    <?php } ?>
    <form method="POST" action="../../../server/admin/login_user.php" class="container">
      <div class="form-group">
        <label for="email">Inserisci l’e-mail</label>
        <input type="email" name="email" id="email" placeholder="name@example.com" />
      </div>
      <div class="form-group">
        <label for="password">Inserisci la password</label>
        <div style="position: relative">
          <input type="password" name="password" id="password" placeholder="Scrivila qui" />
          <span class="password-toggle"><i class="fa-solid fa-eye"></i></span>
        </div>
      </div>
      <button class="register-button">ACCEDI</button>
      <div class='login-link-wrapper'>
        <a href="sign_up.php" class="login-link">
          Non hai ancora un profilo? <span>Registrati</span>
        </a>
      </div>
    </form>
  </div>
  </div>

  <script src="../../common/js/password_toggler.js"></script>
</body>

</html>