<?php
require_once "../db/connection.php";
$token = $_GET['token'] ?? '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $token = $_POST['token'];
    $nueva = $_POST['nueva'];

    // Verifica el token y que no haya expirado
    $sql = "SELECT * FROM instructores WHERE reset_token=? AND reset_token_expira > NOW()";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        // Actualiza la contraseña
        $sql = "UPDATE instructores SET Contrasena=?, reset_token=NULL, reset_token_expira=NULL WHERE reset_token=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $nueva, $token);
        $stmt->execute();
        echo "<script>alert('Contraseña actualizada. Ahora puedes iniciar sesión.'); window.location.href='login.php';</script>";
        exit;
    } else {
        echo "<script>alert('El enlace es inválido o ha expirado.');</script>";
    }
}
?>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../assets/css/resetPassword.css">
    <title>Actualizar contraseña</title>
</head>
<div id = "modal-bg">
    <div id = "modal-content">
        <form method="POST" action="">
            <input type="hidden" name="token" value="<?php echo htmlspecialchars($token); ?>">
            <input type="password" name="nueva" placeholder="Nueva contraseña" required>
            <button type="submit">Actualizar contraseña</button>
        </form>
    </div>
</div>