<?php

class AuthView {

    public function showLogin($error, $nombre) {
        require_once './templates/form_login.phtml';
    }

    public function showError($error, $nombre) {
        echo "<h1>$error</h1>";
    }
}
