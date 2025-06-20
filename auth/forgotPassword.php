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
            $mail->Username = 'asistenciasensli@gmail.com';
            $mail->Password = 'ocjz gofb vurq hzho';
            $mail->SMTPSecure = PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            // Destinatario
            $mail->setFrom('asistenciasensli@gmail.com', 'Sensli');
            $mail->addAddress($correo);

            // Contenido
            $mail->isHTML(true);
            $mail->Subject = 'Recupera tu contraseña en Sensli';
            $mail->Body = "
            <p>Hola,</p>
            <p>Recibimos una solicitud para restablecer tu contraseña. Haz clic en el siguiente enlace:</p>
            <p><a href='http://localhost/Sensli1/ProyectoFormativo/auth/resetPassword.php?token=$token'>Restablecer contraseña</a></p>
            <p>Si no solicitaste este cambio, ignora este correo.</p>
            <p>Saludos,<br>Equipo Sensli</p>
            ";
            $mail->AltBody = "Recibiste este correo para restablecer tu contraseña en Sensli. Si no fuiste tú, ignóralo.";

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