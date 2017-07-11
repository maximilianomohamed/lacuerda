 
window.onload = function() {
    document.getElementById("codigo").focus();
};

//calcula la ganancia del producto
   
function actualizarPrecioVenta(){ 
    //nombre del formulario a validar
    var formulario = document.getElementById('formulario');
    //si se realizo la validacion por html5 sigo
    if(formulario.checkValidity()){  
       //realizo el alta con ajax        
       var precio = document.getElementById('precio');
       var ganancia = document.getElementById('ganancia');
    
            $.post( "../controller/actualizarPrecio.php", { precio: precio.value , ganancia: ganancia.value }, function(data) {
             // me devuelve el idProducto del producto que acaba de agregar
             preciodeVenta = jQuery.parseJSON(data);

             //seteo el input con el precio de venta
              $('#precioVenta').val(preciodeVenta);
            


            });
    }
}

$('#confirm-delete').on('show.bs.modal', function(e) {
    $(this).find('.danger').attr('href', $(e.relatedTarget).data('href'));
});