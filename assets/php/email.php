<?php

// Replace this with your own email address
$to = 'kleosling@gmail.com';

function url(){
  return sprintf(
    "%s://%s",
    isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https' : 'http',
    $_SERVER['SERVER_NAME']
  );
}

if($_POST) {

   $fname = trim(stripslashes($_POST['fname']));
   $lname = trim(stripslashes($_POST['fname']));
   $email = trim(stripslashes($_POST['email']));
   $subject = trim(stripslashes($_POST['subject']));
   $contact_message = trim(stripslashes($_POST['message']));

   $name = $fname . ' ' . $lname;
   
	if ($subject == '') { $subject = "Presentación del formulario de contacto"; }

   // Set Message
   $message .= "Email from: " . $name . "<br />";
	 $message .= "Email address: " . $email . "<br />";
   $message .= "Message: <br />";
   $message .= nl2br($contact_message);
   $message .= "<br /> ----- <br /> Este correo electrónico fue enviado desde su sitio " . url() . " Formulario de contacto. <br />";

   // Set From: header
   $from =  $name . " <" . $email . ">";

   // Email Headers
	$headers = "From: " . $from . "\r\n";
	$headers .= "Reply-To: ". $email . "\r\n";
 	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

   ini_set("sendmail_from", $to); // for windows server
   $mail = mail($to, $subject, $message, $headers);

	if ($mail) { echo "OK"; }
   else { echo "Algo ha ido mal. Por favor, inténtelo de nuevo."; }

}

?>