<?php

	session_start();
	require_once('./configTwig.php');
	require_once('./conexionBusqueda.php');
	require_once('../model/abmVenta.php');
		if(isset($_SESSION['rol'])) {
			$datos['user'] = $_SESSION['nombre'];
			if($_SESSION['rol'] == "admin"){
				$datos['direccion'] = "./menu.html";
			}
			else{
				$datos['direccion'] = "./menuBack.html";
			}
			//Variable de forma de pago
			$laFormaDePago = $_POST['formaDePago'];
			$datos['formaDePago'] = $laFormaDePago;
			renderizar('actualizarVenta.html',$datos);
		}
			/*if(ventaSinfinalizar()){
					$Mostrar = "";
					//Filtro anti-XSS
					$caracteres_malos = array("<", ">", "\"", "'", "/", "<", ">", "'", "/");
					$caracteres_buenos = array("& lt;", "& gt;", "& quot;", "& #x27;", "& #x2F;", "& #060;", "& #062;", "& #039;", "& #047;");
					$consultaBusqueda = str_replace($caracteres_malos, $caracteres_buenos, $consultaBusqueda);


					$consulta = mysql_query("SELECT p.descripcionProducto, m.nombreMarca, p.precioventa, p.idProducto, p.codigoBarras FROM producto p INNER JOIN marca m ON(p.idMarca = m.idMarca)WHERE descripcionProducto LIKE '%$consultaBusqueda%'");

					//Obtiene la cantidad de filas que hay en la consulta
					$filas = mysql_num_rows($consulta);

					//Si no existe ninguna fila que sea igual a $consultaBusqueda, entonces mostramos el siguiente mensaje
					if ($filas === 0) {
						$Mostrar = "<div class='col-lg-12'>
						     			<div class='alert alert-warning alert-dismissable'>
						                      <button type='button' class='close' data-dismiss='alert'>&times;</button>
						                      No hay ningun producto con esa descripción.
						                </div>
						           	</div>";
					} else {
						
						$Mostrar .= '<div class="row">
						                    <div class="col-lg-12">
						                         <div class="panel panel-default">
								                  <!-- /.panel-heading -->
								                    <div class="panel-body">
						                        <div class="table-responsive">
						                            <table class="table table-bordered table-hover table-striped">
						                                <thead>
						                                    <tr>
						                                        <th>Descripción</th>
						                                        <th>Marca</th>
						                                        <th>Precio</th>
						                                        <th></th>
						                                    </tr>
						                                </thead>
						                                <tbody>';
						//La variable $resultado contiene el array que se genera en la consulta, así que obtenemos los datos y los mostramos en un bucle
						while($resultados = mysql_fetch_array($consulta)) {
							$codigoBarras= $resultados['codigoBarras'];
							$producto = $resultados['descripcionProducto'];
							$marca = $resultados['nombreMarca'];
							$precio  = $resultados['precioventa'];
						

							//Output
							$Mostrar .= '
		                                   
		                                    <tr class="warning">
		                                        <td>'.$producto.'</td>
		                                        <td>'.$marca.'</td>
		                                        <td>$'.$precio.'</td>
		                                        <td><a href="../controller/generarVenta.php?codigoAgregar='.$codigoBarras.'"
			                                        	<button class="btn btn-success btn-xs">
			                                        		<i class="fa fa-plus">  </i> Agregar
			                                        	</button>
		                                        	</a></td>
		                                    </tr>';
		                                    
		                               

						};//Fin while $resultados
							$Mostrar .=' </tbody>
		                            </table>
		                            </div>
		                            </div>
		                        </div>
		                    </div>
		 
		                </div>';
					}; //Fin else $filas


				//Devolvemos el mensaje que tomará jQuery
				echo $Mostrar;
			}
			else{
				echo "";
			}

			
		}
		else{
			header('Location: ./ingresar.php');
		}
		
		*/
		

?>

	