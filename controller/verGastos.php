<?php
	session_start();
	require_once('../model/abmGasto.php');
	require_once('./configTwig.php');
	if(isset($_SESSION['rol'])) {
		$datos['user'] = $_SESSION['nombre'];
		if($_SESSION['rol'] == "admin"){
			$datos['direccion'] = "./menu.html";
		}
		else{
			$datos['direccion'] = "./menuBack.html";
		}
		
			$mes = $_GET["mes"];
			$anio = $_GET["anio"];
			$tipo = $_GET["tipo"];
			if(isset($_GET["correcto"])){
				$datos['correcto'] = true;
			}

			if(hayGastos($mes, $anio)){
				$datos['gastos'] = detalleGastos($mes,$anio,$tipo);
				$datos['anio'] = $anio;
				$datos['nroMes'] = $mes;
						switch ($mes) {
					    case 1:
					        $dato['mes'] = "Enero"; 
					        break;
					    case 2:
					        $datos['mes'] = "Febrero"; 
					        break;
					    case 3:
					        $datos['mes'] = "Marzo"; 
					        break;
					    case 4:
					        $datos['mes'] = "Abril"; 
					        break;
					    case 5:
					        $datos['mes'] = "Mayo"; 
					        break;
					    case 6:
					        $datos['mes'] = "Junio"; 
					        break;
					    case 7:
					        $datos['mes'] = "Julio"; 
					        break;
					    case 8:
					        $datos['mes'] = "Agosto"; 
					        break;
					    case 9:
					        $datos['mes'] = "Septiembre"; 
					        break;
					    case 10:
					        $datos['mes'] = "Octubre"; 
					        break;
					    case 11:
					        $datos['mes'] = "Noviembre"; 
					        break;
					    case 12:
					        $datos['mes'] = "Diciembre"; 
					        break;

					}
					renderizar('gastos.html',$datos);

			}
			else{
				if($tipo == "saleMes"){
					if(isset($_GET["correcto"])){
						header('Location: ../controller/movimientosMensuales.php?correctamente');
					}
					else{
						header('Location: ../controller/movimientosMensuales.php?noGastos');
					}
				}
				else{
					if(isset($_GET["correcto"])){
						header('Location: ../controller/cajasDelMes.php?correctamente');
					}
					else{
						header('Location: ../controller/cajasDelMes.php?noGastos');
					}
				}

			}
	}
	else{
		header('Location: ./ingresar.php');
	}


	
	
	
?>


