<?php
	require 'phpmailer/PHPMailerAutoload.php';
    $mail = new PHPMailer;
    $mail->isSMTP();
    $mail->Host='smtp.gmail.com';
    $mail->port=587;
    $mail->SMTPAuth=true;
    $mail->SMTPSecure='tls';

    $mail->Username='alisataylorm.m@gmail.com';
    $mail->Password='alisa1074';

    $mail->setFrom('alisataylorm.m@gmail.com','Kymobudget');
    $mail->addAddress($email);
    $mail->addReplyTo('noreply@gmail.com');
    $mail->isHTML(true);
    $mail->Subject='KYMOBUDGET Account Verification';
    $mail->Body    = "<h4>KYMOBUDGET</h4><p>Dear ".$firstname.", please verify your account by clicking <a href='https://kymobudget.herokuapp.com/verify-user.php?token=".$token."&email=".$email."'>verify</a></p>";
    if (!$mail->send()) {
        echo "Message could not be sent!";
        echo 'Mailer Error: ' . $mail->ErrorInfo;
    }else{
        echo "Message has been sent!";
    }

?>
