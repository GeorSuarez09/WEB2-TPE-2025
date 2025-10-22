<?php
require_once './app/model/viaje.model.php';
require_once './app/view/viaje.view.php';
require_once './app/model/conductor.model.php';

class viajeController
{
    private $model;
    private $view;
    private $modelConductor;

    function __construct()
    {
        $this->model = new viajeModel();
        $this->view = new viajeView();
         $this->modelConductor = new conductorModel();
    }

function listarViajes($usuario)
{
    $viajes = $this->model->getViaje();

    $conductores = $this->modelConductor->getConductor();

    $this->view->verViajes($viajes, $conductores, $usuario);
}


    public function mostrarViaje($ID_viaje)
    {
        $viaje = $this->model->getViajeById($ID_viaje);
    
        if (!$viaje) {
            return $this->view->mostrarErrores("No se a encontrado el viaje con la id: $ID_viaje");
        }
        $ID_conductor = $viaje->ID_conductor;
        $conductor = $this->modelConductor->getConductorById($ID_conductor);
       return $this->view->viajeDetalles($viaje, $conductor);
    }

    public function mostrarformViajes($usuario)
    {
        $conductores = $this->modelConductor->getConductor();
        $this->view->formularioViaje($conductores, $usuario);
    }
    public function addViaje($request)
    {


        // Verifica si se ha enviado el formulario
        if (
            !isset($_POST['fecha']) || empty($_POST['fecha']) ||
            !isset($_POST['origen']) || empty($_POST['origen']) ||
            !isset($_POST['destino']) || empty($_POST['destino']) ||
            !isset($_POST['ID_conductor']) || empty($_POST['ID_conductor']) ||
            !isset($_POST['ID_usuario']) || empty($_POST['ID_usuario'])
        ) {
            return $this->view->mostrarErrores('Falta completar todos los campos obligatorios', $request->usuario);
        }


        // Asigna las variables correctamente
        $fecha = $_POST['fecha'];
        $origen = $_POST['origen'];
        $destino = $_POST['destino'];
        $ID_conductor = $_POST['ID_conductor'];
        $ID_usuario = $_POST['ID_usuario'];

        // Agrega el viaje a la base de datos
        $ID_viaje = $this->model->agregarViaje($fecha, $origen, $destino, $ID_conductor, $ID_usuario);

        if (!$ID_viaje) {
            return $this->view->mostrarErrores('Error al insertar viaje', $request->usuario);
        }

        // redirijo al home
        header('Location: ' . BASE_URL . 'listar');
    }
    public function mostrarFormEditViaje($ID_viaje)
    {
        $viaje = $this->model->getViajeById($ID_viaje);
        if (!$viaje) {
            return $this->view->mostrarErrores('El viaje que esta buscando no esta disponible');
        }

        $conductor = $this->modelConductor->getConductorById($viaje->ID_conductor);
        $conductores = $this->modelConductor->getConductor();
        $this->view->formEditarViaje($ID_viaje, $viaje, $conductor, $conductores);
    }
    public function updateViajes($ID_viaje)
    {

        // Verifica si se ha enviado el formulario
        if (
            !isset($_POST['fecha']) || empty($_POST['fecha']) ||
            !isset($_POST['origen']) || empty($_POST['origen']) ||
            !isset($_POST['destino']) || empty($_POST['destino']) ||
            !isset($_POST['ID_conductor']) || empty($_POST['ID_conductor']) ||
            !isset($_POST['ID_usuario']) || empty($_POST['ID_usuario'])
        ) {
            return $this->view->mostrarErrores('Falta completar todos los campos obligatorios');
        }

        // Asigna las variables correctamente
        $fecha = $_POST['fecha'];
        $origen = $_POST['origen'];
        $destino = $_POST['destino'];
        $ID_conductor = $_POST['ID_conductor'];
        $ID_usuario = $_POST['ID_usuario'];

        // Validar los datos según sea necesario
        $viajeEditado = $this->model->editarViaje($fecha, $origen, $destino, $ID_conductor, $ID_viaje, $ID_usuario);
        if (!$viajeEditado) {
           return $this->view->mostrarErrores("No se pudo actualizar el viaje.");
        } 
           // redirijo al home
        header('Location: ' . BASE_URL . 'listar');
    }
 
    public function eliminarViaje($ID_viaje, $request){
    
        $viaje =$this->model->getViajeById($ID_viaje);
        $eliminar =  $this->model->eliminarViaje($ID_viaje);
        if($viaje && !$eliminar){
    
            header('Location: ' . BASE_URL . 'listar'); 
        } else {
            return $this->view->mostrarErrores("No se pudo eliminar el viaje.", $request->usuario);
        }    
    
    }
    
}
