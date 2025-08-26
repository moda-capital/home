<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

class Contactos extends Controller
{
    public function __construct() {
        parent::__construct();
        session_start();
    }
    public function index()
    {
        if (isset($_POST['nombre']) && isset($_POST['email']) && isset($_POST['mensaje'])) {
            if (empty($_POST['nombre']) || empty($_POST['email']) || empty($_POST['mensaje']) ) {
                 $mensaje =array('msg' => 'TODO LOS CAMPOS SON REQUERIDOS', 'icono' => 'warning');
            }else{
                $mail = new PHPMailer(true);
            try {
                //Server settings
                $mail->SMTPDebug = 0;                     //Habilitar salida de depuración detallada
                $mail->isSMTP();                                          //Enviar usando SMTP
                $mail->Host       = HOST_SMTP;                     //Configure el servidor SMTP para enviar a través de
                $mail->SMTPAuth   = true;                                  //Habilitar autenticación SMTP
                $mail->Username   = USER_SMTP;                    //nombre de usuario SMTP
                $mail->Password   = PASS_SMTP;                               //Contraseña SMTP
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Habilitar el cifrado TLS implícito
                $mail->Port       = PUERTO_SMTP;                                    
            
                //Recipients
                $mail->setFrom('info.modacapital@gmail.com', TITLE);
                $mail->addAddress($_POST['email']);
            
                //Content
                $mail->isHTML(true);                                 //Establecer el formato de correo electrónico en HTML
                $mail->Subject = $_POST['nombre'] .' Mensaje desde la: ' . TITLE;
                $mail->Body    = $_POST['mensaje'];
                $mail->AltBody = 'GRACIAS POR ELEGIRNOS';
            
                $mail->send();
                $mensaje =array('msg' => 'CORREO ENVIADO, REVISA TU BANDEJA DE ENTRA - SPAM', 'icono' => 'success');
            } catch (Exception $e) {
                $mensaje =array('msg' => 'ERROR AL ENVIAR CORREO: '. $mail->ErrorInfo, 'icono' => 'error');
            }
            }
        } else {
            $mensaje =array('msg' => 'ERROR FATAL', 'icono' => 'error');
        }
        echo json_encode($mensaje, JSON_UNESCAPED_UNICODE);
        die();
    }

}