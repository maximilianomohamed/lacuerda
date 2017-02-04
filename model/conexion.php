<?php
Class Conexion {

	public $conexion;

	function conectarBD() {
		//conection:
		$db_host="localhost"; //mysql.hostinger.com.ar
		$db_user="root"; //u559727960_cuerd
		$db_pass=""; //123maxi
		$db_base="lacuerda"; //	u559727960_cuerd

		try {
			$this->conexion = new PDO("mysql:dbname=$db_base;host=$db_host",$db_user,$db_pass);
			}
		catch(PDOException $e){
			echo "ERROR". $e->getMessage();
			}
	}

	function desconectarBD() {
		$this->conexion = null;
	}


	function getConexion(){
		return $this -> conexion;
	}
}
?>