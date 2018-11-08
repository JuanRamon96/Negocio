<?php 
include "config/conexion.php";
class m_modelo extends conexion{
	public $db;
	public $numerofilas;
	public $error;
	
	public function __construct()
    {
        $this->db = conexion::__construct();
    }

	// METODO PARA INSERTAR, MODIFICAR Y ELIMINAR REGISTROS
	public function _insertar($query){
		$result = $this->db->query($query);
		
		if (!$result){
			$error = 'si';
		}else{
			$error = 'no';
		}
		return $error;
	}
	
	// METODO PARA OBTENER RESULTADOS DE LA BD
	public function _consultar($query){
		$result = $this->link->query($query);
		$this->numerofilas = $result->num_rows;
		if (!$result) {			
			$this->error = 'si';
			echo 'Se produjo un error en el modelo';
		}
        else{
			$this->error = 'no';
			while ($resultado[] = $result->fetch_array());		
		}
		return $resultado;
	}

}
?>
