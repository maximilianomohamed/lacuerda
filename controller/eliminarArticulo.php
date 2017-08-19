<?php
    session_start();
    require_once('./configTwig.php');
    require_once('../model/abmUsados.php');
    require_once('../model/abmProductoNuevo.php');
    if(isset($_SESSION['rol'])){
        $datos['user'] = $_SESSION['nombre'];
        if($_SESSION['rol'] == "admin"){
            $datos['direccion'] = "./menu.html";        
            if(isset($_GET['tipo']) && isset($_GET['id']) && ($_GET['tipo'] == 'nuevo')){
                eliminarArticuloNuevo($_GET['id']);
            }elseif(isset($_GET['tipo']) && isset($_GET['id']) && ($_GET['tipo'] == 'usado')){
                eliminarArticuloUsado($_GET['id']); 
            }    
            header('Location: ./articulos.php');
        }else{
            header('Location: ./ingresar.php'); 
        }        
    }else{
	header('Location: ./ingresar.php');        
    }
?>