<?php

define('CONTACT_ADDRESS', 'rlundquist3@gmail.com');

echo "Sending message:\n";
$email = $_POST['email'];
$subject = $_POST['subject'];
$message = $_POST['message'];

$headers = 'From: ' . $email;
echo $message = wordwrap($message, 70, "\r\n");

if (mail(CONTACT_ADDRESS, $subject, $message, $headers)) {
    echo 'Success';

    $autoReply = wordwrap("Hello -\n\n We've received your message regarding the Lillian Anderson Arboretum. We will be in contact soon.", 70, "\r\n");
    $headers = 'From: ' . CONTACT_ADDRESS;
    if (mail($email, $subject, $autoReply, $headers))
        echo 'Auto-reply sent';
}

?>
