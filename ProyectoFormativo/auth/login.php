
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/login.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Hachi+Maru+Pop&family=Indie+Flower&family=Parkinsans:wght@300..800&family=Ruda:wght@400..900&family=Underdog&display=swap" rel="stylesheet">
    <title>login page</title>
</head>
<body>
    <div class="container-form">
    <form class="sign-in" action="../auth/login.php" method="POST">
        <h2>Iniciar Sesión</h2>

        <div class="social-networks">
            <ion-icon name="logo-linkedin"></ion-icon>
            <ion-icon name="logo-whatsapp"></ion-icon>
            <ion-icon name="logo-instagram"></ion-icon>
            <ion-icon name="logo-facebook"></ion-icon>
        </div>
        <span>Usar correo y contraseña enviados a su gmail</span>

        <div class="container-select">
            <select name="tipoDocu" required>
                <option value="">Tipo de documento</option>
                <option value="TI">Tarjeta de Identidad</option>
                <option value="CC">Cédula de Ciudadanía</option>
                <option value="Nacionalidad">Nacionalidad</option>
                <option value="CE">Cédula de Extranjería</option>
            </select>
        </div>

        <div class="container-input">
            <ion-icon name="mail-unread-outline"></ion-icon>
            <input type="text" name="email" placeholder="Número de documento">
        </div>

        <div class="container-input">
            <ion-icon name="lock-closed-outline"></ion-icon>
            <input type="password" name="password" placeholder="Password">
        </div>
        <button type="submit">Iniciar Sesión</button>
    </form>

    </div>
    <div class="container-welcome">
        <div class="welcome-sign-up welcome">
            <h3>¡Bienvenido!</h3>
            <p>Ingrese sus datos personales para usar todas las funciones del sitio </p>
        </div>
    </div>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>