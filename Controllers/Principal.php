<?php
class Principal extends Controller
{
    public function __construct() {
        parent::__construct();
        session_start();
    }
    
    //Vista about
    public function about()
    {
        $data['perfil'] = 'no';
        $data['title'] = 'Nosotros';
        $this->views->getView('principal', "about", $data);
    }
    //Vista shop
        public function shop($page)
    {
        $data['perfil'] = 'no';
        $page = (empty($page)) ? 1 : $page ;
        $porPagina = 18;
        $desde = ($page - 1) * $porPagina;
        $data['title'] = 'Productos';
        $data['productos'] = $this->model->getProductos($desde, $porPagina);
        $data['pagina'] = $page;
        $total = $this->model->getTotalProductos();
        $data['total'] = ceil($total['total'] / $porPagina);
        $this->views->getView('principal', "shop", $data);
    } 
    //Vista detail
    public function detail($id_producto)
    {
        $data['perfil'] = 'no';
        $data['producto'] = $this->model->getProducto($id_producto);
        if (empty($data['producto'])) {
            echo 'Pagina no encontrada';
            exit;
        }
        $id_categoria = $data['producto']['id_categoria'];
        $data['relacionados'] = $this->model->getAleatorios($id_categoria, $data['producto']['id']);

        //ver galeria
        $result = array();

        $directorio = 'assets/images/productos/' . $id_producto;
        if (file_exists($directorio)) { //si existe la imagen
            $imagenes = scandir($directorio);
            if (false !== $imagenes) {
                foreach ($imagenes as $file) {
                    if ('.' != $file && '..' != $file) {
                        array_push($result, $file);
                    }
                }
            }
        }
        $data['imagenes'] = $result;


        $data['title'] = $data['producto']['nombre'];
        $this->views->getView('principal', "detail", $data);
    } 
    //Vista categorias
        public function categorias($datos)
        {   
            $data['perfil'] = 'no';
            $id_categoria = 1;
            $page = 1;
            $array = explode(',', $datos);
            if (isset($array[0])) {
                if (!empty($array[0])) {
                    $id_categoria = $array[0];
                }
            }
            if (isset($array[1])) {
                if (!empty($array[1])) {
                   $page = $array[1];
                }
            }
            $page = (empty($page)) ? 1 : $page ;
            $porPagina = 15;
            $desde = ($page - 1) * $porPagina;

            $data['pagina'] = $page;
            $total = $this->model->getTotalProductosCat($id_categoria);
            $data['total'] = ceil($total['total'] / $porPagina);

            $data['productos'] = $this->model->getProductosCat($id_categoria, $desde, $porPagina );
            $data['title'] = 'Categorias';
            $data['id_categoria'] = $id_categoria;
            $this->views->getView('principal', "categorias", $data);
        }
    
    //Vista contactos
    public function contact()
    {
        $data['perfil'] = 'no';
        $data['title'] = 'contactos';
        $this->views->getView('principal', "contact", $data);
    } 
    //Vista lista deseo
        public function deseo()
        {
            $data['perfil'] = 'no';
            $data['title'] = 'Tu lista de deseos';
            $this->views->getView('principal', "deseo", $data);
        } 

        //obtener productos a partir de la lista carrito
        public function ListaProductos()
        {
            $datos = file_get_contents('php://input');
            $json = json_decode($datos, true);
            $array ['productos'] = array();
            $total = 0.00;
            if (!empty($json)) {
                foreach ($json as $producto) {
                $result = $this->model->getProducto($producto['idProducto']);
                $data ['id'] = $result['id'];
                $data ['nombre'] = $result['nombre'];
                $data ['precio'] = $result['precio'];
                $data ['cantidad'] = $producto['cantidad'];
                $data ['imagen'] = $result['imagen'];
                $SubTotal = $result['precio'] * $producto['cantidad'];
                $data ['subTotal'] = number_format($SubTotal, 3);
                array_push($array ['productos'], $data);
                $total += $SubTotal;
            }
            }
            $array['total'] = number_format($total, 3);
            $array['totalPaypal'] = number_format($total, 2, '.', '');
            $array['moneda'] = MONEDA;
            echo json_encode($array, JSON_UNESCAPED_UNICODE);
            die();
        } 

        //busqueda
        public function busqueda($valor)
        {
            $data = $this ->model->getBusqueda($valor);
            echo json_encode($data, JSON_UNESCAPED_UNICODE);
            die();
        }
    
}