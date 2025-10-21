<?php

    class SessionMiddleware {

        public function run($request){
             // 🚀 Aseguramos que la sesión esté iniciada SIEMPRE
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
            if(isset($_SESSION['USER_ID'])){
                $request->usuario = new StdClass();
                $request->usuario->ID_usuario = $_SESSION['USER_ID'];
                $request->usuario->nombre = $_SESSION['USER_NAME']; 
                $request->usuario->email = $_SESSION['USER_GMAIL'];
            } else {
                $request->usuario = null;
            }
            return $request;
        }

    }
