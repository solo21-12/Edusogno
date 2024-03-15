<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>password reset Page</title>
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

    <form method="post" action="../../../server/common/send_email.php" class="top-container">
        <div class="title">reimposta la tua password</div>
        <form action="../../../server/common/send_email.php" method="post">
            <div class="container">
                <div class="form-group">
                    <label for="email">Inserisci l’e-mail</label>
                    <input type="email" name="email" id="email" placeholder="name@example.com" />
                </div>

                <input type="submit" value="Ripristina" class="register-button"></input>
                <div class='login-link-wrapper'>
                    <a href="sign_up.php" class="login-link">
                        Non hai ancora un profilo? <span>Registrati</span>
                    </a>
                    <a href="login.php" class="login-link">
                        Hai già un account? <span>Accedi</span>
                    </a>

                </div>
            </div>
        </form>
    </form>
    </div>
</body>

</html>