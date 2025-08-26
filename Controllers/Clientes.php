<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

class Clientes extends Controller
{
    public function __construct() {
        parent::__construct();
        session_start();
    }
    public function index()
    {
        if (empty($_SESSION['correoCliente'])) {
            header('Location: ' . BASE_URL);
        }
        //ajustes clientes
        $data['perfil'] = 'si';
        $data['title'] = 'Tu Perfil';
        $data['verificar'] = $this->model->getVerificar($_SESSION['correoCliente']);
        $this->views->getView('principal', "perfil", $data);
    }
    public function registroDirecto()
    {       
        if (isset($_POST['nombre']) && isset($_POST['clave'])) {
            if (empty($_POST['nombre']) || empty($_POST['correo']) || empty($_POST['clave'])) {
                $mensaje =array('msg' => 'TODOS LOS CAMPOS SON REQUERIDOS', 'icono' => 'warning');
            }else {
                $nombre = $_POST['nombre'];
                $correo = $_POST['correo'];
                $clave = $_POST['clave'];
                $verificar = $this->model->getVerificar($correo);
                if (empty($verificar)) {
                    $token = md5($correo);
                    $hash = password_hash($clave, PASSWORD_DEFAULT);
                    $data = $this->model->registroDirecto($nombre, $correo, $hash, $token);
                    if ($data > 0) {
                        $_SESSION['correoCliente'] = $correo;
                        $_SESSION['nombreCliente'] = $nombre;
                        $mensaje =array('msg' => 'Registro Exitoso', 'icono' => 'success', 'token' => $token);
                    }else {
                        $mensaje =array('msg' => 'Registro Fallido', 'icono' => 'error');
                    }
                } else {
                    $mensaje =array('msg' => 'YA TIENES UNA CUENTA', 'icono' => 'warning');
                }
            }
            echo json_encode($mensaje, JSON_UNESCAPED_UNICODE);
            die();
        }
    }
    public function enviarCorreo()
    {
        if (isset($_POST['correo']) && isset($_POST['token'])) {
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
                $mail->addAddress($_POST['correo']);
            
                //Content
                $mail->isHTML(true);                                 //Establecer el formato de correo electrónico en HTML
                $mail->Subject = 'TIENES UN MENSAJE DE ' . TITLE;
                $mail->Body    = 'Para verificar tu correo en nuestra tienda <a href="'. BASE_URL .'clientes/verificarCorreo/' . $_POST['token'] . '">CLICK AQUÍ</a>';
                $mail->AltBody = 'GRACIAS POR ELEGIRNOS';
            
                $mail->send();
                $mensaje =array('msg' => 'CORREO ENVIADO, REVISA TU BANDEJA DE ENTRA - SPAM', 'icono' => 'success');
            } catch (Exception $e) {
                $mensaje =array('msg' => 'ERROR AL ENVIAR CORREO: '. $mail->ErrorInfo, 'icono' => 'error');
            }
        } else {
            $mensaje =array('msg' => 'ERROR FATAL', 'icono' => 'error');
        }
        echo json_encode($mensaje, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function verificarCorreo($token)
    {
        $verificar = $this->model->getToken($token);
        if (!empty($verificar)) {
            $data = $this->model->actualizarVerify($verificar['id']);
            header('Location: ' . BASE_URL . 'clientes');
        }
    }
    //login Directo
    public function loginDirecto()
    {       
        if (isset($_POST['correoLogin']) && isset($_POST['claveLogin'])) {
            if (empty($_POST['correoLogin']) || empty($_POST['claveLogin'])) {
                $mensaje =array('msg' => 'TODOS LOS CAMPOS SON REQUERIDOS', 'icono' => 'warning');
            }else {
                $correo = $_POST['correoLogin'];
                $clave = $_POST['claveLogin'];
                $verificar = $this->model->getVerificar($correo);
                if (!empty($verificar)) {
                    if (password_verify($clave, $verificar['clave'])) {
                        $_SESSION['idCliente'] = $verificar['id'];
                        $_SESSION['correoCliente'] = $verificar['correo'];
                        $_SESSION['nombreCliente'] = $verificar['nombre'];
                        $mensaje =array('msg' => 'OK', 'icono' => 'success');
                    }else {
                        $mensaje =array('msg' => 'CONTRASEÑA INCORRECTA', 'icono' => 'error');
                    }
                } else {
                    $mensaje =array('msg' => 'EL CORREO NO EXISTE', 'icono' => 'warning');
                }
            }
            echo json_encode($mensaje, JSON_UNESCAPED_UNICODE);
            die();
        }
    }
    //registrrar pedidos
    public function registrarPedido()
    {
           
             $datos = file_get_contents('php://input');
    $json = json_decode($datos, true);
    $pedidos = $json['pedidos'];
    $productos = $json['productos'];
    if (is_array($pedidos) && is_array($productos)) {
        $id_transaccion = $pedidos['id'] ?? '';
        $monto = $pedidos['purchase_units'][0]['amount']['value'] ?? '';
        $estado = $pedidos['status'] ?? '';
        $fecha = date('Y-m-d H:i:s');
        $email = $pedidos['payer']['email_address'] ?? '';
        $nombre = $pedidos['payer']['name']['given_name'] ?? '';
        $apellido = $pedidos['payer']['name']['surname'] ?? '';
        // Verificar si la dirección de envío existe
        if (isset($json['purchase_units'][0]['shipping']['address'])) {
            $direccion = $json['purchase_units'][0]['shipping']['address']['address_line_1'] ?? 'Sin dirección';
            $ciudad = $json['purchase_units'][0]['shipping']['address']['admin_area_2'] ?? 'Sin ciudad';
        } else {
            $direccion = 'Sin dirección';
            $ciudad = 'Sin ciudad';
        }
        // Correo del cliente desde la sesión
        $id_cliente = $_SESSION['idCliente'] ?? 'correo-no-registrado';
        // Guardar en base de datos
        $data = $this->model->registrarPedido($id_transaccion, $monto, $estado, $fecha, $email, $nombre, $apellido, $direccion, $ciudad, $id_cliente);
        if ($data > 0) {
            foreach ($productos as $producto) {
                    $temp = $this->model->getProducto($producto['idProducto']);
                    $this->model->registrarDetalle($temp['nombre'], $temp['precio'], $producto['cantidad'], $data, $producto['idProducto']);
                }
            $mensaje = array('msg' => 'pedido registrado ', 'icono' => 'success' );
        } else {
            $mensaje = array('msg' => 'error al registrar pedido', 'icono' => 'error' );
        }
    } else {
            $mensaje = array('msg' => 'error con los datos', 'icono' => 'error' );       
    }
    echo json_encode($mensaje);
    die;
    }
    //listar productos pendientes
    public function listarpendientes()
    {
        $id_cliente = $_SESSION['idCliente'];
        $data = $this->model->getPedidos($id_cliente);
        for ($i=0; $i < count($data) ; $i++) { 
            $data[$i]['accion'] = '<div class="text-center"><button class="btn btn-primary" type="button" onclick="verPedido('. $data[$i]['id'].')"><i class="fas fa-eye"></i></button></div>';
        }
        echo json_encode($data);
        die();
    }

    public function verPedido($idPedido)
    {
        $data['pedido'] = $this->model->getPedido($idPedido);
        $data['productos'] = $this->model->verPedidos($idPedido);

        $data['moneda'] = MONEDA;
        echo json_encode($data);
        die();
    }

    //listar productos 
    public function listarProductos()
    {
        $id_cliente = $_SESSION['idCliente'];
        $data = $this->model->getProductos($id_cliente);
        for ($i=0; $i < count($data) ; $i++) { 
            $comprobar = $this->model->comprobarCalificacion($data[$i]['id_producto'],  $id_cliente); //clasificacion o puntear
            $total = (empty($comprobar)) ? 0 : $comprobar['cantidad'] ;
            $una_estrella = ($total >= 1) ? 'text-warning' : 'text-muted'; 
            $dos_estrella = ($total >= 2) ? 'text-warning' : 'text-muted'; 
            $tres_estrella = ($total >= 3) ? 'text-warning' : 'text-muted'; 
            $cuatro_estrella = ($total >= 4) ? 'text-warning' : 'text-muted'; 
            $cinco_estrella = ($total == 5) ? 'text-warning' : 'text-muted'; 
            $data[$i]['calificacion'] = '<ul class="list-unstyled d-flex justify-content-between">
                                <li class="calificacion">
                                    <i class="fas fa-star '.$una_estrella.' "onclick="agregarCalificacion('.$data[$i]['id_producto'].', 1)"></i>
                                    <i class="fas fa-star '.$dos_estrella.' "onclick="agregarCalificacion('.$data[$i]['id_producto'].', 2)"></i>
                                    <i class="fas fa-star  '.$tres_estrella.' "onclick="agregarCalificacion('.$data[$i]['id_producto'].', 3)"></i>
                                    <i class="fas fa-star '.$cuatro_estrella.'"onclick="agregarCalificacion('.$data[$i]['id_producto'].', 4)"></i>
                                    <i class="fas fa-star '.$cinco_estrella.' "onclick="agregarCalificacion('.$data[$i]['id_producto'].', 5)"></i>
                                    </li>
                                </ul>';
        }
        echo json_encode($data);
        die();
    }

    public function agregarCalificacion(){
        $id_cliente = $_SESSION['idCliente'];
        $datos = file_get_contents('php://input');
        $json = json_decode($datos, true);
        $comprobar = $this->model->comprobarCalificacion($json['id_producto'], $id_cliente);
        if (empty($comprobar)) {
                   $data = $this->model->agregarCalificacion($json['cantidad'], $json['id_producto'], $id_cliente);
         if ($data > 0) {
                        $mensaje =array('msg' => 'Calificacion Agregada', 'icono' => 'success');
                    }else {
                        $mensaje =array('msg' => 'Error Al Calificar', 'icono' => 'error');
                    }
        } else {
                   $data = $this->model->cambiarCalificacion($json['cantidad'], $json['id_producto'], $id_cliente);
         if ($data == 1) {
                        $mensaje =array('msg' => 'Calificacion Modificada', 'icono' => 'success');
                    }else {
                        $mensaje =array('msg' => 'Error Al Calificar', 'icono' => 'error');
                    }
        }
        
                    echo json_encode($mensaje);
                    die();

    }


    //Cerrar Sección
    public function salir()
    {
        session_destroy();
        header('Location: ' . BASE_URL);
    }

    

}