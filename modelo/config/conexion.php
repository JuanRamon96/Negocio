<?php
class conexion {
	private $_connection;
    private static $_instance; //The single instance
    private $_host = "localhost";
    private $_username = "hysguhzi_negocio";
    private $_password = "iUyhM89YtR";
    private $_database = "hysguhzi_negocio";

    public function __construct()
    {
        $this->_connection = new mysqli($this->_host, $this->_username,$this->_password, $this->_database);
        
        if(mysqli_connect_error())
        {
            trigger_error("Error al conectar con la Base de datos:" . mysql_connect_error(),E_USER_ERROR);
        }else{
        	 return $this->_connection;
        }
    }
}
?>