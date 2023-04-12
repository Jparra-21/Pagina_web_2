<?php
if (isset($_POST['Email'])) {

    // EDIT THE FOLLOWING TWO LINES:
    $email_to = "javierparraguirrel@gmail.com";
    $email_subject = "Nuevo Contacto";

    function problem($error)
    {
        echo "We're sorry, but there were error(s) found with the form you submitted. ";
        echo "These errors appear below.<br><br>";
        echo $error . "<br><br>";
        echo "Please go back and fix these errors.<br><br>";
        die();
    }

    // validation expected data exists
    if (
        !isset($_POST['nombre']) ||
        !isset($_POST['email']) ||
        !isset($_POST['telefono']) ||
        !isset($_POST['mensaje'])
    ) {
        problem("Lo sentimos pero hay un problema con su mensaje.");
    }

    $nombre = $_POST['nombre']; // required
    $email = $_POST['email']; // required
    $telefono = $_POST['telefono']; // required
    $mensaje = $_POST['Message']; // required

    $error_mensaje = "";
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';

    if (!preg_match($email_exp, $email)) {
        $error_mensaje .= 'The Email address you entered does not appear to be valid.<br>';
    }

    $string_exp = "/^[A-Za-z .'-]+$/";

    if (!preg_match($string_exp, $name)) {
        $error_mensaje .= 'The Name you entered does not appear to be valid.<br>';
    }

    if (strlen($message) < 2) {
        $error_mensaje .= 'The Message you entered do not appear to be valid.<br>';
    }

    if (strlen($error_mensaje) > 0) {
        problem($error_mensaje);
    }

    $email_mensaje = "Form details below.\n\n";

    function clean_string($string)
    {
        $bad = array("content-type", "bcc:", "to:", "cc:", "href");
        return str_replace($bad, "", $string);
    }

    $email_mensaje .= "Nombre: " . clean_string($name) . "\n";
    $email_mensaje .= "Email: " . clean_string($email) . "\n";
    $email_mensaje .= "Telefono: " . clean_string($telefono) . "\n";
    $email_mensaje .= "Mensaje: " . clean_string($mensaje) . "\n";

    // create email headers
    $headers = 'De: ' . $email . "\r\n" .
        'Responder-a: ' . $email . "\r\n" .
        'X-Mailer: PHP/' . phpversion();
    @mail($email_to, $email_subject, $email_message, $headers);
?>

    <!-- INCLUDE YOUR SUCCESS MESSAGE BELOW -->

    Gracias por contactarnos.

<?php
}
?>