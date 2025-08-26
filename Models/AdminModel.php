<?php
class AdminModel extends Query{
 
    public function __construct()
    {
        parent::__construct();
    }
    public function getUsuario($correo)
    {
        $sql = "SELECT * FROM usuarios WHERE correo = '$correo'";
        return $this->select($sql);
    }
    public function getTotales($estado)
    {
        $sql = "SELECT COUNT(*) AS total FROM pedidos WHERE proceso = '$estado'";
        return $this->select($sql);
    }
        public function getProductos()
    {
        $sql = "SELECT COUNT(*) AS total FROM productos WHERE estado = 1";
        return $this->select($sql);
    }
    
    function productosMinimos() {
        $sql = "SELECT * FROM productos WHERE cantidad < 15 AND estado = 1 ORDER BY cantidad DESC LIMIT  5";
        return $this->selectAll($sql);
    }

  public function mejoresProductos()
    {
    $sql = "SELECT producto AS nombre, SUM(cantidad) AS total FROM detalle_pedidos GROUP BY producto ORDER BY total DESC LIMIT 5"; 
    return $this->selectAll($sql);
    }

    }
?>