<?php
if (isset($_POST['email'])) {

    // Editar Las siguientes lineas
    $email_to = "Yasna.mora.moraga@gmail.com";
    $email_subject = "Nuevo Contacto";

    function problem($error)
    {
        echo "Lo sentimos pero hay un problema(s) con su mensaje.";
        echo "Estos rrores parecen acontinuacion.<br><br>";
        echo $error . "<br><br>";
        echo "Porfavor regrese y arregle estos problemas.<br><br>";
        die();
    }

    // Validacion que existan los datos
    if (
        !isset($_POST['nombre']) ||
        !isset($_POST['email']) ||
        !isset($_POST['telefono']) ||
        !isset($_POST['mensaje'])
    ) {
        problem("Lo sentimos pero hay un problema con su mensaje.");
    }

    $nombre = $_POST['nombre']; // requerido
    $email = $_POST['email']; // requerido
    $telefono = $_POST['telefono']; // requerido
    $mensaje = $_POST['mensaje']; // requerido

    $error_mensaje = "";
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';

    if (!preg_match($email_exp, $email)) {
        $error_mensaje .= 'El email que ingreso al parecer no es valido.<br>';
    }

    $string_exp = "/^[A-Za-z .'-]+$/";

    if (!preg_match($string_exp, $nombre)) {
        $error_mensaje .= 'El mensaje que ingreso no es valido.<br>';
    }

    if (strlen($mensaje) < 2) {
        $error_mensaje .= 'EL mensaje que ingreso no es valido.<br>';
    }

    if (strlen($error_mensaje) > 0) {
        problem($error_mensaje);
    }

    $email_mensaje = "Mensaje de contacto a continuacion:\n\n";

    function clean_string($string)
    {
        $bad = array("content-type", "bcc:", "to:", "cc:", "href");
        return str_replace($bad, "", $string);
    }

    $email_mensaje .= "Nombre: " . clean_string($nombre) . "\n";
    $email_mensaje .= "Email: " . clean_string($email) . "\n";
    $email_mensaje .= "Telefono: " . clean_string($telefono) . "\n";
    $email_mensaje .= "Mensaje: " . clean_string($mensaje) . "\n";

    // Encabezado
    $headers = 'De: ' . $email . "\r\n" .
        'Responder-a: ' . $email . "\r\n" .
        'X-Mailer: PHP/' . phpversion();
    mail($email_to, $email_subject, $email_mensaje, $headers);
    header("Location: index.html");
}
?>


    <html><body><p>Gracias por contactarnos.</p>
    <button onclick="history.go(-1);">Back </button></body></html>