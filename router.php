    <?php
    require './app/controller/viaje.controller.php';
    require './app/controller/conductor.controller.php';
   

    // base_url para redirecciones y base tag
    define('BASE_URL', '//' . $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']) . '/');

    $action = 'listar'; // accion por defecto si no se envia ninguna
    if (!empty($_GET['action'])) {
        $action = $_GET['action'];
    }


    // parsea la accion para separar accion real de parametros
    $params = explode('/', $action);
    //$res = new Response();

    switch ($params[0]) {
        case 'listar':
            $controller = new viajeController();
            $controller->listarViajes();
            break;

        //Muestra formulario Viaje
        case 'mostrarFormulario':
            $controller = new viajeController();
            $controller->mostrarformViajes(); // 👈 Muestra el formulario
            break;

        // Redirije al listar, ya que toma los datos para mandarlos a la base de datos 
        case 'agregarViaje':
            $controller = new viajeController();
            $controller->addViaje();
            break;

        //Edita el viaje por ID
        case 'editarViaje':
            $controller = new viajeController();
            $controller->mostrarformEditViaje($params[1]);
            break;
        // Toma los datos pero no muestra nada, redirige
        case 'update':
            $controller = new viajeController();
            $controller->updateViajes($params[1]);
            break;


        //Elimina Viaje
        case 'eliminar':
            $controller = new viajeController();
            $controller->eliminarViaje($params[1]);
            break;

        // Ver mas viajeDetalle
        case 'verMasViajes':
            $controller = new viajeController();
            $controller->mostrarViaje($params[1]);
            break;


        //Conductor listar
        case 'listarC':
            $controller = new conductorController();
            $controller->mostrarConductores();
            break;

        //Formulario de conductor
        case 'formularioC':
            $controller = new conductorController();
            $controller->mostrarformConductores();
            break;
        //Toma los datos, redirige al listarC
        case 'agregarC':
            $controller = new conductorController();
            $controller->agregarConductor();
            break;

        //Formulario de conductor edicion
        case 'editarC':
            $controller = new conductorController();
            $controller->mostrarFormEditConductor($params[1]);
            break;
        //Toma los datos, redirige al listarC
        case 'updateC':
            $controller = new conductorController();
            $controller->updateConductores($params[1]);
            break;


        //Elimina conductor
        case 'eliminarC':
            $controller = new conductorController();
            $controller->eliminarConductor($params[1]);
            break;

        // Ver mas detalle Conductor
        case 'verMasC':
            $controller = new conductorController();
            $controller->mostrarConductor($params[1]);
            break;

        //Ver conductores con sus viajes
        case 'viajesAsignados':
             $controller = new conductorController();
            $controller->verDetallesConViajes($params[1]);
            break;


        default:
            echo "404 Page Not Found";
            break;
    }
