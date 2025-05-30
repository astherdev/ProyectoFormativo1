
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/login_register.css">
    <title>login page</title>
</head>
<body>
    <div class="container">
        <div class="container-form">
        <form class="sign-in" action="../auth/login.php" method="POST">
            <h2>Iniciar Sesión</h2>

            <div class="social-networks">
                <ion-icon name="logo-linkedin"></ion-icon>
                <ion-icon name="logo-whatsapp"></ion-icon>
                <ion-icon name="logo-instagram"></ion-icon>
                <ion-icon name="logo-facebook"></ion-icon>
            </div>
            <span>Use su correo y su contraseña</span>

            <div class="container-input">
                <ion-icon name="mail-unread-outline"></ion-icon>
                <input type="text" name="email" placeholder="Email">
            </div>

            <div class="container-input">
                <ion-icon name="lock-closed-outline"></ion-icon>
                <input type="password" name="password" placeholder="Password">
            </div>
            <?php
            session_start();
            if (isset($_SESSION['error'])) {
                echo "<div class='error'>" . $_SESSION['error'] . "</div>";
                unset($_SESSION['error']);
            }

            if (isset($_SESSION['success'])) {
                echo "<div class='success'>" . $_SESSION['success'] . "</div>";
                unset($_SESSION['success']);
            }
            ?>

            <a href="#">¿Olvidaste tu contraseña?</a>
            <button type="submit">Iniciar Sesión</button>
        </form>

        </div>

        <div class="container-form">
            <form class="sign-up" action="../auth/register.php" method="POST">
                <h2>Registrarse</h2>
                <div class="social-networks">
                    <ion-icon name="logo-linkedin"></ion-icon>
                    <ion-icon name="logo-whatsapp"></ion-icon>
                    <ion-icon name="logo-instagram"></ion-icon>
                    <ion-icon name="logo-facebook"></ion-icon>
                </div>
                <span>Use su correo electronico para registrarse</span>
                <div class="container-input">
                    <ion-icon name="person-outline"></ion-icon>
                    <input type="text" name="nombre" placeholder="Nombre" required>
                </div>
                <div class="container-input">
                    <ion-icon name="person-outline"></ion-icon>
                    <input type="text" name="apellido" placeholder="Apellidos" >
                </div>
                <div class="container-input">
                    <ion-icon name="mail-unread-outline"></ion-icon>
                    <input type="text" name="email" placeholder="Email" required >
                </div>
                <div class="container-input">
                    <ion-icon name="lock-closed-outline"></ion-icon>
                    <input type="password" name="password" placeholder="Password" required >
                </div>
                <button type="submit">Registrarse</button>
            </form>
        </div>
        <div class="container-welcome">
            <div class="welcome-sign-up welcome">
                <h3>¡Bienvenido!</h3>
                <p>Ingrese sus datos personales para usar todas las funciones del sitio</p>
                <button class="button" id="btn-sign-up">Registrarse</button>
            </div>
            <div class="welcome-sign-in welcome">
                <h3>¡Hola!</h3>
                <p>Registrese con sus datos personales para usar todas las funciones del sitio</p>
                <button class="button" id="btn-sign-in">Iniciar Sesión</button>
            </div>
        </div>
    </div>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="../assets/js/script.js"></script>
    
</body>
</html>