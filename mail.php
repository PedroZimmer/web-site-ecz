<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);
$mail2 = new PHPMailer(true);

$name = $_POST['name'];
$subject = $_POST['subject'];
$email = $_POST['email'];

// $name = 'Teste';
// $subject = 'Teste';
// $email = 'pedrokaow@gmail.com';


try {
    //Server settings
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.zoho.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'suporte_ecz@zohomail.com';                     //SMTP username
    $mail->Password   = 'sup#ECZ#1965#28081700';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;

    $mail2->isSMTP();                                            //Send using SMTP
    $mail2->Host       = 'smtp.zoho.com';                     //Set the SMTP server to send through
    $mail2->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail2->Username   = 'suporte_ecz@zohomail.com';                     //SMTP username
    $mail2->Password   = 'sup#ECZ#1965#28081700';                               //SMTP password
    $mail2->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail2->Port       = 465;
    
    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('suporte_ecz@zohomail.com', 'Pedro Zimmermann - ECZ');
    $mail->addAddress('pedrokaow@gmail.com', 'Pedro Teste');     //Add a recipient
    $mail->addReplyTo('pedroxlzmm@gmail.com', 'Pedro Teste Profissional');
    // $mail->addCC('cc@example.com');
    // $mail->addBCC('bcc@example.com');

    $mail2->setFrom('suporte_ecz@zohomail.com', 'Escritorio Contabil Zimmermann');
    $mail2->addAddress($email, $name);     //Add a recipient
    $mail2->addReplyTo('suporte_ecz@zohomail.com', 'Suporte ECZ');
    // $mail->addCC('cc@example.com');
    // $mail->addBCC('bcc@example.com');

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Alguem quer que entremos em contato.';
    $mail->Body    = 'Nome: ' . $name . '<br>' . 'Email: ' . $email . '<br>' . 'Assunto: ' . $subject . '<br>' . 'Hora: ' . date('d/m/Y H:i:s');

    //Content

    
    $mail2->isHTML(true);                                  //Set email format to HTML
    $mail2->Subject = 'Recebemos sua mensagem!';
    $mail2->Body    = 'Olá ' . $name . ',<br><br>Recebemos sua mensagem e entraremos em contato o mais breve possível.<br><br>Atenciosamente,<br><br><img src="https://images2.imgbox.com/3a/14/YH17MFOx_o.jpg" style="width: 35px">  <span style="font-family: Bembo; font-size: 35px;">Escritório Contábil Zimmermann</span>';
    $mail2->Body    .= '<br>' . 'Rua 28 de Agosto, 1700, Sala 5, Centro, Guaramirim - SC, Brasil | CNPJ: 85.290.948/0001-81';
    $mail2->Body    .= '<br>' . 'Data: ' . date('d/m/Y H:i:s');



    $mail2->send();
    $mail->send();
   
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}