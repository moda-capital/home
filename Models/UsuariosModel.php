<?php
class UsuariosModel extends Query{
 
    public function __construct()
    {
        parent::__construct();
    }

    public function getUsuarios($estado)
    {
      $sql = "SELECT id, nombre, apellido, correo, perfil FROM usuarios WHERE estado = $estado";
        return $this->selectAll($sql);
    }

    public function registrar($nombre, $apellido, $correo, $clave)
    {
        $sql = "INSERT INTO usuarios (nombre, apellido, correo, clave) VALUES (?,?,?,?)";
        $array = array($nombre, $apellido, $correo, $clave);
        return $this->insertar($sql, $array);
    }

    public function verificarCorreo($correo)
    {
        $sql = "SELECT correo FROM usuarios WHERE correo = '$correo' AND estado = 1";
        return $this->select($sql);
    }

    public function eliminar($idUser)
    {
           $sql = "UPDATE usuarios SET estado = ? WHERE id = ?";
           $array = array(0, $idUser);
            return $this->save($sql, $array);
    }

    //mostrar usuarios activos
        public function getUsuario($idUser)
    {
      $sql = "SELECT id, nombre, apellido, correo FROM usuarios WHERE id = $idUser";
        return $this->select($sql);
    }

    //modificar
    public function modificar($nombre, $apellido, $correo, $id)
    {
        $sql = "UPDATE usuarios SET nombre=?, apellido=?, correo=? WHERE id = ?";
        $array = array($nombre, $apellido, $correo, $id);
        return $this->save($sql, $array);
    }
}
 
?>