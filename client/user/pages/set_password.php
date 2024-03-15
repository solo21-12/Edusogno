<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Set password Page</title>
    <link rel="stylesheet" href="../../common/styles/navbar.css" />
    <link rel="stylesheet" href="../../common/styles/styles.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Barlow:ital,wght@0,600;1,400;1,500;1,600&family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&family=Roboto:ital,wght@1,400;1,700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <link rel="icon" type="image/jpeg" href="../../common/assets/logo.jpeg">
</head>

<body>
    <?php include("../../common/components/navbar.php"); ?>
    <div class="top-container">
        <div class="title">Imposta la tua password</div>
        <form method="post" action="../../../server/user/set_password.php" class="container" onsubmit="return validateForm()">
            <div class="form-group">
                <label for="password">Inserisci la password</label>
                <div style="position: relative">
                    <input type="password" name="password" id="password" placeholder="Scrivila qui" />
                    <span class="password-toggle toggle-1" onclick="togglePasswordVisibility('password', 'toggle-1')"><i class="fa-solid fa-eye"></i></span>
                </div>
                <span id="password-error" class="error"></span>

            </div>
            <div class="form-group">
                <label for="password">Conferma password</label>
                <div style="position: relative">
                    <input type="password" id="password_confirm" placeholder="Scrivila qui" />
                    <span class="password-toggle toggle-2" onclick="togglePasswordVisibility('password_confirm', 'toggle-2')"><i class="fa-solid fa-eye"></i></span>
                </div>
                <span id="password-confirm-error" class="error"></span>

            </div>
            <input type="hidden" name="email" value="<?php echo isset($_GET['email']) ? $_GET['email'] : ''; ?>" />
            <button type="submit" class="register-button">Impostare la password</button>
            <div class='login-link-wrapper'>
                <a href="sign_up.php" class="login-link">
                    Non hai ancora un profilo? <span>Registrati</span>
                </a>
                <a href="login.php" class="login-link">
                    Hai già un account? <span>Accedi</span>
                </a>
            </div>
        </form>
    </div>
    </div>
    <script src="../../common/js/set_password.js"></script>
    <script src='../.../common/js/password_validtion.js'>

    </script>

</body>

</html>