<?php
class conexion {
	private static $dbhost = 'localhost';
	private static $dbusr = 'root';
	private static $dbpwd = 'Arandas2018';
	private static $dbname = 'p2';
	protected $link;
    public function __construct() {
	//}
	//public function conexionf (){	
		$this->link = new mysqli(self::$dbhost,self::$dbusr,self::$dbpwd,self::$dbname);
		if($link->connect_error){
			echo "Error de conexión: ".$link->connect_errno." $link->connect_error\n";
			exit;
		}else{
			return $this->link;
		}
	}
}
?>