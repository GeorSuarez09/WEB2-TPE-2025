
<?php
/**
 * Este archivo concentra todas las funciones que acceden 
 * a la Base de Datos.
 */
class viajeModel{
    private $db;
function __construct() {
    $this-> db = new PDO('mysql:host=localhost;dbname=uber_viajes;charset=utf8', 'root', '');
}

function getViaje() {
    // 2. ejecuto la consulta SQL (SELECT * FROM viaje)
    $query = $this->db->prepare('SELECT * FROM viaje');
    $query->execute();

    // 3. obtengo los resultados de la consulta
    $viaje = $query->fetchAll(PDO::FETCH_OBJ);

    return $viaje;
}

function getViajeById($ID_viaje){

    $query = $this->db->prepare('SELECT * FROM viaje WHERE ID_viaje = ?');
    $query->execute([$ID_viaje]);

    $viaje = $query->fetch(PDO::FETCH_OBJ);

    return $viaje;
}
 
function agregarViaje($fecha, $origen, $destino, $ID_conductor, $ID_usuario){
    $query = $this->db->prepare('INSERT INTO viaje (fecha, origen, destino, ID_conductor, ID_usuario) VALUES (?, ?, ?, ?, ?)');
    $query->execute([$fecha, $origen, $destino, $ID_conductor, $ID_usuario]);
    return $this->db->lastInsertId();
}

public function editarViaje($fecha, $origen, $destino, $ID_conductor, $ID_viaje, $ID_usuario) {
    $query = $this->db->prepare('UPDATE viaje SET fecha = ?, origen = ?, destino = ?, ID_conductor = ?, ID_usuario = ? WHERE ID_viaje = ?');
    return $query->execute([$fecha, $origen, $destino, $ID_conductor, $ID_usuario, $ID_viaje]);
}

function eliminarViaje($ID_viaje) {
        $query = $this->db->prepare('DELETE FROM viaje WHERE ID_viaje = ?');
        $query->execute([$ID_viaje]);
    }
 
    
    public function getViajesPorConductor($ID_conductor) {
    $query = $this->db->prepare("SELECT * FROM viaje WHERE ID_conductor = ?");
    $query->execute([$ID_conductor]);
    return $query->fetchAll(PDO::FETCH_OBJ);
}
}
