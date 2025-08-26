<?php
class ProductosModel extends Query{
 
    public function __construct()
    {
        parent::__construct();
    }

    public function getProductos($estado)
    {
      $sql = "SELECT * FROM productos WHERE estado = $estado";
        return $this->selectAll($sql);
    }

    public function getCategorias()
    {
      $sql = "SELECT * FROM categorias WHERE estado = 1";
        return $this->selectAll($sql);
    }

    public function registrar($nombre, $descripcion, $precio, $cantidad, $imagen, $categoria, $color)
    {
        $sql = "INSERT INTO productos (nombre, descripcion, precio, cantidad, imagen, id_categoria, color) VALUES (?,?,?,?,?,?,?)";
        $array = array($nombre, $descripcion, $precio, $cantidad, $imagen, $categoria, $color);
        return $this->insertar($sql, $array);
    }

    


    public function eliminar($idPro)
    {
           $sql = "UPDATE productos SET estado = ? WHERE id = ?";
           $array = array(0, $idPro);
            return $this->save($sql, $array);
    }

    //mostrar productos activos
        public function getProducto($idPro)
    {
      $sql = "SELECT * FROM productos WHERE id = $idPro";
        return $this->select($sql);
    }

    //modificar
    public function modificar($nombre, $descripcion, $precio, $cantidad, $destino, $categoria, $color, $id)
    {
        $sql = "UPDATE productos SET nombre=?, descripcion=?, precio=?, cantidad=?, imagen=?, id_categoria=?, color=? WHERE id = ?";
        $array = array($nombre, $descripcion, $precio, $cantidad, $destino, $categoria, $color, $id);
        return $this->save($sql, $array);
    }
}
 
?>