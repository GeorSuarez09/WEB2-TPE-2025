    <?php
    require './app/controller/viaje.controller.php';
    require './app/controller/conductor.controller.php';
     require './app/controller/auth.controller.php';

    require_once './app/middlewares/session.middleware.php';
    require_once './app/middlewares/guard.middleware.php';
   

    // base_url para redirecciones y base tag
    define('BASE_URL', '//' . $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']) . '/');

    $action = 'listar'; // accion por defecto si no se envia ninguna
    if (!empty($_GET['action'])) {
        $action = $_GET['action'];
    }
    // parsea la accion para separar accion real de parametros
    $params = explode('/', $action);
    $request = new StdClass();
    $request = (new SessionMiddleware())->run($request);


    // parsea la accion para separar accion real de parametros
    $params = explode('/', $action);
    //$res = new Response();

    switch ($params[0]) {
        case 'listar':
            $controller = new viajeController();
            $controller->listarViajes($request->usuario);
            break;

        //Muestra formulario Viaje
        case 'mostrarFormulario':
            $controller = new viajeController();
            $controller->mostrarformViajes($request->usuario); // 👈 Muestra el formulario
            break;

        // Redirije al listar, ya que toma los datos para mandarlos a la base de datos 
        case 'agregarViaje':
            $request = (new GuardMiddleware())->run($request);
            $controller = new viajeController();
            $controller->addViaje($request);
            break;

        //Edita el viaje por ID
        case 'editarViaje':
            $request = (new GuardMiddleware())->run($request);
            $controller = new viajeController();
            $controller->mostrarformEditViaje($params[1]);
            break;
        // Toma los datos pero no muestra nada, redirige
        case 'update':
            $request = (new GuardMiddleware())->run($request);
            $controller = new viajeController();
            $controller->updateViajes($params[1]);
            break;


        //Elimina Viaje
        case 'eliminar':
            $request = (new GuardMiddleware())->run($request);
            $controller = new viajeController();
            $controller->eliminarViaje($params[1], $request);
            break;

        // Ver mas viajeDetalle
        case 'verMasViajes':
            $controller = new viajeController();
            $controller->mostrarViaje($params[1]);
            break;


        //Conductor listar
        case 'listarC':
            $controller = new conductorController();
            $controller->mostrarConductores($request->usuario);
            break;

        //Formulario de conductor
        case 'formularioC':
            $controller = new conductorController();
            $controller->mostrarformConductores($request->usuario);
            break;
        //Toma los datos, redirige al listarC
        case 'agregarC':
             $request = (new GuardMiddleware())->run($request);
            $controller = new conductorController();
            $controller->agregarConductor($request);
            break;

        //Formulario de conductor edicion
        case 'editarC':
             $request = (new GuardMiddleware())->run($request);
            $controller = new conductorController();
            $controller->mostrarFormEditConductor($params[1]);
            break;
        //Toma los datos, redirige al listarC
        case 'updateC':
             $request = (new GuardMiddleware())->run($request);
            $controller = new conductorController();
            $controller->updateConductores($params[1]);
            break;


        //Elimina conductor
        case 'eliminarC':
              $request = (new GuardMiddleware())->run($request);
            $controller = new conductorController();
            $controller->eliminarConductor($params[1], $request);
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

        case 'login':
        $controller = new AuthController();
        $controller->showLogin($request);
        break;
    case 'do_login':
        $controller = new AuthController();
        $controller->doLogin($request);
        break;
    case 'logout':
        $request = (new GuardMiddleware())->run($request);
        $controller = new AuthController();
        $controller->logout($request);
        break;


        default:
            echo "404 Page Not Found";
            break;
    }
