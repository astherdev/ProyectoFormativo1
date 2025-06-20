<form method="POST" action="forgotPassword.php">
    <input type="email" name="correo" placeholder="Tu correo" required>
    <button type="submit">Recuperar contraseña</button>
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once "../db/connection.php";
    $correo = $_POST['correo'];

    $sql = "SELECT * FROM instructores WHERE Correo = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $correo);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        // Genera un token único
        $token = bin2hex(random_bytes(32));
        $sql = "UPDATE instructores SET reset_token=?, reset_token_expira=DATE_ADD(NOW(), INTERVAL 1 HOUR) WHERE Correo=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $token, $correo);
        $stmt->execute();

        // Envía el correo
        require '../vendor/autoload.php';
        $mail = new PHPMailer\PHPMailer\PHPMailer(true);

        try {
            // Configuración SMTP
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = '*****@gmail.com';
            $mail->Password = 'sdpk rcfo jwfl eqmt';
            $mail->SMTPSecure = PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            // Destinatario
            $mail->setFrom('*****@gmail.com', 'Sensli');
            $mail->addAddress($correo);

            // Contenido
            $mail->isHTML(true);
            $mail->Subject = 'Recupera tu contraseña';
            $mail->Body = "Haz clic en el siguiente enlace para restablecer tu contraseña:<br>
                <a href='http://localhost/Sensli1/ProyectoFormativo/auth/resetPassword.php?token=$token'>Restablecer contraseña</a>";

            $mail->send();
            echo "Correo enviado. Revisa tu bandeja de entrada.";
        } catch (Exception $e) {
            echo "Error al enviar el correo: {$mail->ErrorInfo}";
        }
    } else {
        echo "Correo no encontrado.";
    }
}
?>