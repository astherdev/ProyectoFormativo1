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
        echo "Contraseña actualizada. Ahora puedes iniciar sesión.";
    } else {
        echo "El enlace es inválido o ha expirado.";
    }
}
?>

<form method="POST" action="">
    <input type="hidden" name="token" value="<?php echo htmlspecialchars($token); ?>">
    <input type="password" name="nueva" placeholder="Nueva contraseña" required>
    <button type="submit">Actualizar contraseña</button>
</form>