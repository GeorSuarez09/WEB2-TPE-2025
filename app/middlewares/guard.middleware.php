<?php

    class GuardMiddleware {
        public function run($request) {
            if($request->usuario) {
                return $request;
            } else {
                header("Location: ".BASE_URL."login");
                exit();
            }
        }
    }
