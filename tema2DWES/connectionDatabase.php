<?php
class ConnectionDatabase
{
    protected $_conexion;

    public function __construct()
    {
        $servidor = 'localhost';
        $usuario = 'studium';
        $clave = 'studium';
        $baseDeDatos = 'studium_dws_p2';
        $this->_conexion = new mysqli(
            $servidor,
            $usuario,
            $clave,
            $baseDeDatos
        );
        if (mysqli_connect_error()) {
            die('Error de Conexion (' . mysqli_connect_errno() . ')
    ' . mysqli_connect_error());
        }
        $this->_conexion->set_charset("utf8");
    }

    public function getConnetion(){
        return $this->_conexion;
    }
}
?>