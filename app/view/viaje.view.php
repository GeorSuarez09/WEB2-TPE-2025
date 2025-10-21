
<?php 
class viajeView{

    function verViajes($viajes, $conductores, $usuario){
        require_once 'templates/viajes/viajelista.phtml';
    }
    function formularioViaje($conductores, $usuario){
        require_once 'templates/viajes/formViaje.phtml';
    }
    function formEditarViaje($ID_viaje, $viaje, $conductor, $conductores){
      require_once 'templates/viajes/formEditarViaje.phtml';
    }
    function viajeDetalles($viaje, $conductor){
        require_once 'templates/viajes/viajeDetalle.phtml';
    }
  function mostrarErrores($mensaje){
    echo "<div class='error'>$mensaje</div>";
}
}

?>