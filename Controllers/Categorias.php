<?php
class Categorias extends Controller
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
        $data['title'] = 'categorias';
        $this->views->getView('admin/categorias', "index", $data);
    }
    public function listar()
    {
        $data = $this->model->getCategorias(1);
        for ($i=0; $i < count($data); $i++) { 
            $data[$i]['imagen'] = '<img class="img-thumbnail" src="'.$data[$i]['imagen'].'" alt="'.$data[$i]['categoria'].'"  width="70px">';
            $data[$i]['accion'] = '<div class="d-flex" >
            <button class="btn btn-primary" type="button" onclick="editCat('.$data[$i]['id'].')"><i class="fas fa-edit"></i></button>
            <button class="btn btn-danger" type="button"  onclick="eliminarCat('.$data[$i]['id'].')" ><i class="fas fa-trash"></i></button>
        </div>';
}
        echo json_encode($data);
        die();
    }
public function registrar()
    {
        if (isset($_POST['categoria'])) {
            $categoria = $_POST['categoria'];
            $imagen = $_FILES['imagen'];
            $tmp_name = $imagen['tmp_name'];
            $id = $_POST['id'];
            $ruta = 'assets/images/categorias/';
            $nombreImg = date('YmdHis');
            if (empty($_POST['categoria'])) {
                $respuesta = array('msg' => 'todo los campos son requeridos', 'icono' => 'warning');
            } else {
                if (!empty($imagen['name'])) {
                    $destino = $ruta . $nombreImg . '.jpg'; 
                } else if (!empty($_POST['imagen_actual']) && empty($imagen['name'])) {
                    $destino = $_POST['imagen_actual'];
                } else {
                    $destino = $ruta . 'default.png';
                }                
                if (empty($id)) {
                    $result = $this->model->verificarCategoria($categoria);
                    if (empty($result)) {
                        $data = $this->model->registrar($categoria, $destino);
                        if ($data > 0) {
                            if (!empty($imagen['name'])) {
                                move_uploaded_file($tmp_name, $destino);
                            }
                            $respuesta = array('msg' => 'categoria registrado', 'icono' => 'success');
                        } else {
                            $respuesta = array('msg' => 'error al registrar', 'icono' => 'error');
                        }
                    } else {
                        $respuesta = array('msg' => 'Categoria ya existe', 'icono' => 'warning');
                    }
                } else {
                    $data = $this->model->modificar($categoria, $destino, $id);
                    if ($data == 1) {
                        if (!empty($imagen['name'])) {
                            move_uploaded_file($tmp_name, $destino);
                        }
                        $respuesta = array('msg' => 'categoria modificado', 'icono' => 'success');
                    } else {
                        $respuesta = array('msg' => 'error al modificar', 'icono' => 'error');
                    }
                }
            }
            echo json_encode($respuesta);
        }
        die();
    }
    //eliminar categoria
    public function delete($idCat) 
    {
        if (is_numeric($idCat)) {
            $data = $this->model->eliminar($idCat);
                if ($data == 1) {
                        $respuesta = array('msg' => 'Categoria Eliminada', 'icono' => 'success');
                    } else {
                        $respuesta = array('msg' => 'Error al Eliminar', 'icono' => 'error');
                    }
        }else {
                    $respuesta = array('msg' => 'Error Fatal', 'icono' => 'error');
            
        }
            echo json_encode($respuesta); 
            die(); //abortar proceso     
    }
    //editar categoria
        public function edit($idCat) 
    {
        if (is_numeric($idCat)) {
            $data = $this->model->getCategoria($idCat);
            echo json_encode($data, JSON_UNESCAPED_UNICODE); 
        }
            die(); //abortar proceso     
    }
}
