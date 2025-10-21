<?php

class UserModel {
    private $db;

    function __construct() {
     // 1. abro conexión con la DB
     $this->db = new PDO('mysql:host=localhost;dbname=uber_viajes;charset=utf8', 'root', '');
    }

    public function get($ID_usuario) {
        $query = $this->db->prepare('SELECT * FROM usuario WHERE ID_usuario = ?');
        $query->execute([$ID_usuario]);
        $usuario = $query->fetch(PDO::FETCH_OBJ);

        return $usuario;
    }

    public function getByUser($nombre) {
        $query = $this->db->prepare('SELECT * FROM usuario WHERE nombre = ?');
        $query->execute([$nombre]);
        $nombre = $query->fetch(PDO::FETCH_OBJ);

        return $nombre;
    }
    
    public function getAll() {
        // 2. ejecuto la consulta SQL (SELECT * FROM tareas)
        $query = $this->db->prepare('SELECT * FROM usuario');
        $query->execute();

        // 3. obtengo los resultados de la consulta
        $usuario = $query->fetchAll(PDO::FETCH_OBJ);

        return $usuario;
    }

    function insert($nombre, $password, $email) {
        $query = $this->db->prepare("INSERT INTO usuario(usuario, password, email) VALUES(?,?, ?)");
        $query->execute([$nombre, $password, $email]);

        // var_dump($query->errorInfo());

        return $this->db->lastInsertId();
    }
}
