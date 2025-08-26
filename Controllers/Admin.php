<?php
class Admin  extends Controller
{
    public function __construct()
    {
        parent::__construct();
        session_start();
    }
    public function index()
    {
               if (!empty($_SESSION['nombre_usuario'] )) {//comprobar inicio sesion admin
            header('Location: '. BASE_URL   . 'admin/home');//si la sesion ya esta iniciada..
            exit;
        }
        $data['title'] = 'Acceso al sistema';
        $this->views->getView('admin', "login", $data);
    }
    public function validar()
    {
        if (isset($_POST['email']) && isset($_POST['clave'])) {
            if (empty($_POST['email']) || empty($_POST['clave'])) {
                $respuesta = array('msg' => 'Todo los campos son requeridos', 'icono' => 'warning');
            } else {
                $data = $this->model->getUsuario($_POST['email']);
                if (empty($data)) {
                    $respuesta = array('msg' => 'Datos Incorrectos ', 'icono' => 'warning');
                } else {
                    if (password_verify($_POST['clave'], $data['clave'])) {
                        $_SESSION['email'] = $data['correo'];
                        $_SESSION['nombre_usuario'] = $data['nombre'];
                        $respuesta = array('msg' => 'Datos Correctos ', 'icono' => 'success');
                    } else {
                        $respuesta = array('msg' => 'Contraseña Incorrecta ', 'icono' => 'warning');
                    }
                }
            }
        } else {
            $respuesta = array('msg' => 'Error Fatal', 'icono' => 'Error');
        }
        echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function home()
    {
        if (empty($_SESSION['nombre_usuario'] )) {//comprobar inicio sesion admin
            header('Location: '. BASE_URL   . 'admin');
            exit;
        }

        $data['title'] = 'Panel Administrativo';
        $data['pendientes'] = $this->model->getTotales(1);
        $data['procesos'] = $this->model->getTotales(2);
        $data['finalizados'] = $this->model->getTotales(3);
        $data['productos'] = $this->model->getProductos();
        $this->views->getView('admin/administracion', "index", $data);
    }

public function productosMinimos()
{
    if (empty($_SESSION['nombre_usuario'] )) {//comprobar inicio sesion admin
            header('Location: '. BASE_URL   . 'admin');
            exit;
    }
    header('Content-Type: application/json');
    $data = $this->model->productosMinimos();
    echo json_encode($data, JSON_UNESCAPED_UNICODE);
    die();
}

public function mejoresProductos()
{
           if (empty($_SESSION['nombre_usuario'] )) {//comprobar inicio sesion admin
            header('Location: '. BASE_URL   . 'admin');
            exit;
        }
    header('Content-Type: application/json');
    $data = $this->model->mejoresProductos();
    echo json_encode($data, JSON_UNESCAPED_UNICODE);
    die();
}


    public function salir()
    {
        session_destroy();
        header('Location:' .BASE_URL);
    }
}
