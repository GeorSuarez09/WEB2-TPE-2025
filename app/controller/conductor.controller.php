<?php
require_once './app/model/conductor.model.php';
require_once './app/view/conductor.view.php';
require_once './app/model/viaje.model.php';
class conductorController
{
    private $model;
    private $view;
    private $modelViaje;

    function __construct()
    {
        $this->model = new conductorModel();
        $this->view = new conductorView();
         $this->modelViaje = new viajeModel();
    }

    function mostrarConductores()
    {
        // pido los conductores al modelo
        $conductor = $this->model->getConductor();

        // se las mando a la vista
        $this->view->verConductores($conductor);
    }

    

    public function mostrarConductor($ID_conductor)
    {
        $conductor = $this->model->getConductorById($ID_conductor);
    
        if (!$conductor) {
            return $this->view->mostrarErrores("No se a encontrado el conductor con la id: $ID_conductor");
        }
 
       return $this->view->conductorDetalles($conductor);
    }
    public function mostrarformConductores()
    {
        $this->model->getConductor();
        $this->view->formularioConductores();
    }
    function agregarConductor()
    {
        // Verifica si se ha enviado el formulario
        if (
            !isset($_POST['nombre']) || empty($_POST['nombre']) ||
            !isset($_POST['vehiculo']) || empty($_POST['vehiculo'])
        ) {
            return $this->view->mostrarErrores('Falta completar todos los campos obligatorios');
        }


        // Asigna las variables correctamente
        $nombre = $_POST['nombre'];
        $vehiculo = $_POST['vehiculo'];
        
        // Agrega el conductor a la base de datos
        $ID_conductor = $this->model->agregarConductor($nombre, $vehiculo);
        if (!$ID_conductor) {
            return $this->view->mostrarErrores('Error al insertar conductor');
        }


        // Redirige al listado de conductores
        header('Location: ' . BASE_URL . 'listarC');
        
    }
       public function mostrarFormEditConductor($ID_conductor)
    {
        $conductor = $this->model->getConductorById($ID_conductor);
        if (!$conductor) {
            return $this->view->mostrarErrores('El conductor que esta buscando no esta disponible');
        }

        $this->view->formEditarConductor($ID_conductor, $conductor);
    }
    public function updateConductores($ID_conductor)
    {

     // Verifica si se ha enviado el formulario
        if (
            !isset($_POST['nombre']) || empty($_POST['nombre']) ||
            !isset($_POST['vehiculo']) || empty($_POST['vehiculo'])
        ) {
            return $this->view->mostrarErrores('Falta completar todos los campos obligatorios');
        }

  
        // Asigna las variables correctamente
        $nombre = $_POST['nombre'];
        $vehiculo = $_POST['vehiculo'];
        
        // Validar los datos según sea necesario
        $conductorEditado = $this->model->editarConductor( $ID_conductor, $nombre, $vehiculo);
        if (!$conductorEditado) {
           return $this->view->mostrarErrores("No se pudo actualizar el conductor.");
        } 
           // redirijo al home
        header('Location: ' . BASE_URL . 'listarC');
    }
       
    
    public function eliminarConductor($ID_conductor) {
    if ($this->modelViaje->getViajesPorConductor($ID_conductor)) {
        return $this->view->mostrarErrores("No se puede eliminar el conductor porque tiene viajes asociados.");
    }

    $this->model->eliminarConductor($ID_conductor);
    header("Location: " . BASE_URL . 'listarC');
}
public function verDetallesConViajes($ID_conductor) {
    $conductor = $this->model->getConductorById($ID_conductor);
    $viajes = $this->modelViaje->getViajesPorConductor($ID_conductor);

    if (!$conductor) {
        return $this->view->mostrarErrores("El conductor no existe.");
    }


    $this->view->mostrarDetallesConViajes($conductor, $viajes);
}


}
