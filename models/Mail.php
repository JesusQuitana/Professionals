<?php
namespace Model;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use Exception;

abstract class Mail {
    public static function enviarConfirmacion(string $email, string $nombre, string $token) : bool {
        $htmlConfirmacion = "<!DOCTYPE html> <html lang='es'> <head> <meta charset='UTF-8'> <meta name='viewport' content='width=device-width, initial-scale=1.0'> <style> body { font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif; line-height: 1.5; } h1 { color: #26A6AB; } </style> </head> <body> <h1>&#9874; Professional'S &#9874;</h1><hr> <p>Ingresa el siguiente token valido para confirmar tu cuenta en <span style='font-style: italic;'>Profesional&prime;s</span> y disfrutar de los servicios que ofrecemos.</p> <p><strong>Token: </strong>{$token}.</p> <p style='font-style: italic;'>Profesional&prime;s Team &copy;</p> </body> </html>";

        $mail = new PHPMailer();                  
        try { 
            $mail->isSMTP();
            $mail->Host = $_ENV["EMAIL_HOST"];
            $mail->Port = $_ENV["EMAIL_PORT"];
            $mail->SMTPAuth = true;
            $mail->Username = $_ENV["EMAIL_USERNAME"];
            $mail->Password = $_ENV["EMAIL_PASSWORD"];

            $mail->setFrom("correo@correo.com", "Profesional");
            $mail->addAddress($email, $nombre);
            
            $mail->isHTML(true);
            $mail->Subject = "Confirmacion de cuenta.";
            $mail->Body = $htmlConfirmacion;
            $mail->AltBody = "Usa el siguiente token: {$token}, para confirmar tu cuenta.";

            if($mail->send()) {
                return true;
            }
        }
        catch(Exception $e) {
            return false;
        }
    }

    public static function enviarOlvido(string $email, string $nombre, string $token) : bool {
        $htmlOlvido = "<!DOCTYPE html> <html lang='es'> <head> <meta charset='UTF-8'> <meta name='viewport' content='width=device-width, initial-scale=1.0'> <style> body { font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif; line-height: 1.5; } h1 { color: #26A6AB; } </style> </head> <body> <h1>&#9874; Professional'S &#9874;</h1><hr> <p>Ingresa el siguiente token valido para reestablecer el password de tu cuenta en <span style='font-style: italic;'>Profesional&prime;s</span> y seguir disfrutando de los servicios que ofrecemos.</p> <p><strong>Token: </strong>{$token}.</p> <p style='font-style: italic;'>Profesional&prime;s Team &copy;</p> </body> </html>";

        $mail = new PHPMailer();                  
        try { 
            $mail->isSMTP();
            $mail->Host = $_ENV["EMAIL_HOST"];
            $mail->Port = $_ENV["EMAIL_PORT"];
            $mail->SMTPAuth = true;
            $mail->Username = $_ENV["EMAIL_USERNAME"];
            $mail->Password = $_ENV["EMAIL_PASSWORD"];

            $mail->setFrom("correo@correo.com", "Profesional");
            $mail->addAddress($email, $nombre);
            
            $mail->isHTML(true);
            $mail->Subject = "Reestablecer cuenta.";
            $mail->Body = $htmlOlvido;
            $mail->AltBody = "Usa el siguiente token: {$token}, para reestablecer tu cuenta.";

            if($mail->send()) {
                return true;
            }
        }
        catch(Exception $e) {
            return false;
        }
    }
}