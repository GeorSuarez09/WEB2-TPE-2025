<?php

class conductorModel{
       private $db;
function __construct() {
    $this->db = new PDO('mysql:host=localhost;dbname=uber_viajes;charset=utf8', 'root', '');
}
 
function getConductor(){
      // 2. ejecuto la consulta SQL (SELECT * FROM viaje)
    $query = $this-> db->prepare('SELECT * FROM conductor');
    $query->execute();

    // 3. obtengo los resultados de la consulta
    $conductor = $query->fetchAll(PDO::FETCH_OBJ);

    return $conductor;
}
function getConductorById($ID_conductor){
     $query = $this->db->prepare('SELECT * FROM conductor WHERE ID_conductor = ?');
        $query->execute([$ID_conductor]);
        $conductor = $query->fetch(PDO::FETCH_OBJ);

        return $conductor;
}
function agregarConductor($nombre, $vehiculo){
       $query = $this->db->prepare("INSERT INTO conductor(nombre, vehiculo) VALUES(?,?)");
        $query->execute([$nombre, $vehiculo]);
          $ID_conductor = $this->db->lastInsertId(); 
        return $ID_conductor;
}

function editarConductor($ID_conductor, $nombre, $vehiculo){
    $query = $this->db->prepare('UPDATE conductor SET `nombre` = ? , `vehiculo` = ? WHERE `ID_conductor` = ?');
  return  $query->execute([$nombre, $vehiculo, $ID_conductor]);
}

function eliminarConductor($ID_conductor){
     $query = $this->db->prepare('DELETE FROM conductor WHERE ID_conductor = ?');
     $query->execute([$ID_conductor]);
}


}
?>