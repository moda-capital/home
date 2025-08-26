<?php
class Usuarios extends Controller
{
    public function __construct() {
        parent::__construct();
        session_start();
               if (empty($_SESSION['nombre_usuario'] )) {//comprobar inicio sesion admin
            header('Location: '. BASE_URL   . 'admin');
            exit;
        }
    }
    public function index()
    {
        $data['title'] = 'Usuarios';
        $this->views->getView('admin/usuarios', "index", $data);
    }
    public function listar()
    {
        $data = $this->model->getUsuarios(1);
        for ($i=0; $i < count($data); $i++) { 
            $data[$i]['accion'] = '<div class="d-flex" >
            <button class="btn btn-primary type="button" onclick="editUser('.$data[$i]['id'].')"><i class="fas fa-edit"></i></button>
            <button class="btn btn-danger" type="button"  onclick="eliminarUser('.$data[$i]['id'].')" ><i class="fas fa-trash"></i></button>
        </div>';
}
        echo json_encode($data);
        die();
    }
    public function registrar(){
        if (isset($_POST['nombre'])) {
                $nombre = $_POST['nombre'];
                $apellido = $_POST['apellido'];
                $correo = $_POST['correo'];
                $clave = $_POST['clave'];
                $id = $_POST['id'];
                $hash = password_hash($clave, PASSWORD_DEFAULT);
            if (empty($_POST['nombre']) || empty($_POST['apellido'])) {
                $respuesta = array('msg' => 'Todo los campos son requeridos', 'icono' => 'warning');
            } else {
                if (empty($id)) {
                    $result = $this->model->verificarCorreo($correo);
                if (empty($result)) { //si no existe ningun dato en result
                        $data = $this->model->registrar($nombre, $apellido, $correo, $hash);
                if ($data > 0) {
                        $respuesta = array('msg' => 'Usuario Registrado', 'icono' => 'success');
                    } else {
                        $respuesta = array('msg' => 'Error Al Registrar', 'icono' => 'error');
                    }
                } else {//Caso contrario 
                    $respuesta = array('msg' => 'El Correo ya Existe', 'icono' => 'warning');
                }
            //modificar
                } else {
                    $data = $this->model->modificar($nombre, $apellido, $correo, $id);
                if ($data == 1) {
                        $respuesta = array('msg' => 'Usuario Modificado', 'icono' => 'success');
                    } else {
                        $respuesta = array('msg' => 'Error Al Modificar', 'icono' => 'error');
                    }
                }

            }
            echo json_encode($respuesta);      
        }
        die();
    }
    //eliminar usuario
    public function delete($idUser) 
    {
        if (is_numeric($idUser)) {
            $data = $this->model->eliminar($idUser);
                if ($data == 1) {
                        $respuesta = array('msg' => 'Usuario Eliminado', 'icono' => 'success');
                    } else {
                        $respuesta = array('msg' => 'Error al eliminar', 'icono' => 'error');
                    }
        }else {
                    $respuesta = array('msg' => 'Error Fatal', 'icono' => 'error');
            
        }
            echo json_encode($respuesta); 
            die(); //abortar proceso     
    }
    //editar usuario
        public function edit($idUser) 
    {
        if (is_numeric($idUser)) {
            $data = $this->model->getUsuario($idUser);
            echo json_encode($data, JSON_UNESCAPED_UNICODE); 
        }
            die(); //abortar proceso     
    }
}