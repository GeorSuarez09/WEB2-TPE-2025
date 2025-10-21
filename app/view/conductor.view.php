<?php
class ConductorView {
    public function verConductores($conductores) {
         require_once 'templates/conductor/listarConductores.phtml';
    }

    public function formularioConductores(){
        require_once 'templates/conductor/formularioC.phtml';
    }

    public function formEditarConductor($ID_conductor, $conductor){
      require_once 'templates/conductor/formEditarC.phtml';
    }
    public function conductorDetalles($conductor){
      require_once 'templates/conductor/detalleC.phtml';
    }
    public function mostrarDetallesConViajes($conductor, $viajes) {
    require 'templates/conductor/detalleCyV.phtml'; 
}

      function mostrarErrores($mensaje){
    echo "<div class='error'>$mensaje</div>";
}
}