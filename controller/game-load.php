<?php

class PartidoModel {
    private $db;

    public function __construct($config) {
        require_once __DIR__ . '/../core/database.php';
        $this->db = new Core\Database($config);
    }

    public function getPartidosPorEstadio($nombreEstadio) {
        $sql = "SELECT Titular, Fecha, Estatus, Estadio, País, Municipio 
                FROM v_partido 
                WHERE Estadio = :estadio
                ORDER BY Fecha ASC";
        
        return $this->db->fetchAll($sql, ['estadio' => $nombreEstadio]);
    }

    public function getInfoEstadio($nombreEstadio) {
        $sql = "SELECT Estadio, País, Municipio 
                FROM v_partido 
                WHERE Estadio = :estadio 
                LIMIT 1";
        
        return $this->db->fetch($sql, ['estadio' => $nombreEstadio]);
    }
}
?>