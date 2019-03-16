<?php
class conexionn {
	private $_connection;
    private static $_instance; //The single instance
    private $_host = "localhost";
    private $_username = "hysguhzi_host1";
    private $_password = "hYjUNM87gtERp";
    private $_database = "hysguhzi_host1";

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