<?php
$error_message = isset($_GET['error']) ? $_GET['error'] : '';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Registration Page</title>
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
    <div class="title">Crea il tuo account amministratore</div>
    <?php if (!empty($error_message)) { ?>
      <div class="error"><?php echo $error_message; ?></div>
    <?php } ?>

    <form method='POST' action="../../../server/admin/register_user.php" class="container" onsubmit="return validateForm()">
      <div class="form-group">
        <label for="nome">Inserisci il nome</label>
        <input type="text" id="nome" name="nome" placeholder="Nome" required />
      </div>
      <div class="form-group">
        <label for="cognome">Inserisci il cognome</label>
        <input type="text" id="cognome" name="cognome" placeholder="Cognome" required />
      </div>
      <div class="form-group">
        <label for="email">Inserisci l’email</label>
        <input type="email" id="email" name="email" placeholder="nome@example.com" required />
        <span id="email-error" class="error"></span>
      </div>
      <div class="form-group">
        <label for="password">Inserisci la password</label>
        <div style="position: relative">
          <input type="password" id="password" name="password" placeholder="Scrivila qui" required />
          <span class="password-toggle toggle-1" onclick="togglePasswordVisibility('password', 'toggle-1')"><i class="fa-solid fa-eye"></i></span>
        </div>
        <span id="password-error" class="error"></span>
      </div>
      <div class="form-group">
        <label for="password_confirm">Conferma password</label>
        <div style="position: relative">
          <input type="password" id="password_confirm" placeholder="Scrivila qui" required />
          <span class="password-toggle toggle-2" onclick="togglePasswordVisibility('password_confirm', 'toggle-2')"><i class="fa-solid fa-eye"></i></span>
        </div>
        <span id="password-confirm-error" class="error"></span>
      </div>
      <button type="submit" class="register-button">REGISTRATI</button>

      <a href="login.php" class="login-link">
        Hai già un account? <span>Accedi</span>
      </a>
    </form>
  </div>

  <script src="../../common/js/set_password.js"></script>
  <script src='../../common/js/registration_form_validation.js'> </script>
</body>

</html>