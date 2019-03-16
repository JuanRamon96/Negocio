<?php 
include "modelo/config/conexion.php";
class m_modelo extends conexion{
	public $numerofilas;
	public $error;
	public function __construct (){
		parent::__construct();
	}
	// METODO PARA INSERTAR, MODIFICAR Y ELIMINAR REGISTROS
	public function _insertar($query){
		$result = $this->link->query($query);
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
