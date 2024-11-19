<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // siistii tiedot
    $name = htmlspecialchars(trim($_POST["name"]));
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $subject = htmlspecialchars(trim($_POST["subject"]));
    $message = htmlspecialchars(trim($_POST["message"]));
    $contactMethod = htmlspecialchars(trim($_POST["contact-method"]));

    // minulle tulevia tietoja
    $to = "	info@junipersiivouspalvelut.fi"; // oma email
    $email_subject = "Yhteydenottopyyntö: $name";
    $email_body = "Nimi: $name\n"
                . "Aihe: $subject\n"                
                . "Sähköposti / puhelinnumero: $email\n"
                . "Yhteydenottotapa: $contactMethod\n\n"
                . "Viesti:\n$message";

    $headers = "From: info@junipersiivouspalvelut.fi\r\n"; // Replace with a valid email from your domain
    $headers .= "Reply-To: $email\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

    // lähetä email mulle
    if (mail($to, $email_subject, $email_body, $headers)) {
        // kiitossivulle
        header("Location: ./kiitosviesti.html");
        exit();
    } else {
        echo "Viestin lähettämisessä tapahtui virhe. Yritä uudelleen myöhemmin.";
    }
} else {
    // lähetä vierailija indexiin, jos vahingossa tuli php-tiedostoon
    header("Location: ./index.html#yhteydenotto");
    exit();
}
?>
