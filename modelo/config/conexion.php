<?php
class conexion {
	private static $dbhost = 'localhost';
	private static $dbusr = 'root';
	private static $dbpwd = '';
	private static $dbname = 'negocio';
	protected $link;
    public function __construct() {
	//}
	//public function conexionf (){	
		$this->link = new mysqli(self::$dbhost,self::$dbusr,self::$dbpwd,self::$dbname.$_SESSION['id_cliente']);
		if($link->connect_error){
			echo "Error de conexi&oacute;n: ".$link->connect_errno." $link->connect_error\n";
			exit;
		}else{
			return $this->link;
			
		}
	}
}
?>