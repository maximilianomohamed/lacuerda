<?php
session_start();
require_once('../model/abmRegistro.php');
require_once('./configTwig.php');
if(isset($_SESSION['rol'])) {
        $datos['user'] = $_SESSION['nombre'];
        if($_SESSION['rol'] == "admin"){
                $datos['direccion'] = "./menu.html";
        }
        else{
                $datos['direccion'] = "./menuBack.html";
        }
        
        $idVenta = $_GET["id"];
        $datos['detalles']=detallesCompletos($idVenta);
        renderizar('detalleVenta.html',$datos);
        
}
else{
        header('Location: ./ingresar.php');
}