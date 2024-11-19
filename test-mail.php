<?php
if (mail("juniper.siivouspalvelut@gmail.com", "Test Email", "This is a test email from PHP")) {
    echo "Email sent successfully!";
} else {
    echo "Failed to send email.";
}
?>