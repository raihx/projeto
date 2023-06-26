<?php

  use PHPMailer\PHPMailer\PHPMailer;
  require 'PHPMailer-master/src/Exception.php';
  require 'PHPMailer-master/src/PHPMailer.php';
  require 'PHPMailer-master/src/SMTP.php';

  function generateEmail($recipient,$subject,$message,$source) {
    switch($source) {
      case "recover_password":
        $mail = new PHPMailer();
        $mail->IsSMTP();

        $mail->SMTPDebug  = 0;  
        $mail->SMTPAuth   = TRUE;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;
        $mail->Host       = "smtp.gmail.com";
        $mail->Username   = "parcesul@gmail.com";
        $mail->Password   = "rvvvlpszobyjigoo";
        $mail->CharSet    = "UTF-8";

        $mail->IsHTML(true);
        $mail->AddAddress($recipient);
        $mail->SetFrom("parcesul@gmail.com", "Parcesul SA");
        $mail->Subject = $subject;
        $mail->Body = "<div style='padding:50px; text-align:center; background-color:#0059ff; width:fit-content; border:1px solid white; border-radius:5px;'>
                        <h2 style='color:white;'>O código de recuperação da sua password é:</h2>
                        <br>
                        <h1 style='color:white;'>" . $message . "</h1>
                        <br>
                        <h4 style='color:#ee4508;'>Este código irá expirar em 5 minutos</h4>
                      </div>";
        
        if(!$mail->Send()) {
          
          return false;
        
        } else {

          return true;
        }

      break;

    }
  }
?>
