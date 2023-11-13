<?php
require_once 'api/models/model.php';

class ModelosModel extends DB
{

    public function getModelosByModelo($modelo)
    {
        $query = $this->connect()->prepare('SELECT * FROM caracteristica WHERE modelo=?');
        $query->execute(([$modelo]));
        return $query->fetch(PDO::FETCH_OBJ);
    }

    public function getModelos()
    {
        $query = $this->connect()->prepare('SELECT * FROM caracteristica');
        $query->execute([]);
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    public function addModelo($modelo, $cilindrada, $velocidad_max, $tipo_uso, $capacidad_tanque)
    {
        $query = $this->connect()->prepare('INSERT INTO caracteristica (modelo, cilindrada, velocidad_max, tipo_uso, capacidad_tanque) VALUES (?,?,?,?,?)');
        $query->execute([$modelo, $cilindrada, $velocidad_max, $tipo_uso, $capacidad_tanque]);
    }


    public function updateModelo($modelo, $cilindrada, $velocidad_max, $tipo_uso, $capacidad_tanque)
    {
        $query = $this->connect()->prepare('UPDATE caracteristica SET cilindrada=?, velocidad_max=?, tipo_uso=?, capacidad_tanque=? WHERE modelo=?');
        $query->execute([$cilindrada, $velocidad_max, $tipo_uso, $capacidad_tanque, $modelo]);
    }

    public function getModelosByCilindrada($order)
    {
        $query = $this->connect()->prepare("SELECT * FROM caracteristica ORDER BY cilindrada $order");
        $query->execute([]);

        return $query->fetchAll(PDO::FETCH_OBJ);
    }
    public function getModelosByVelocidad($order)
    {
        $query = $this->connect()->prepare("SELECT * FROM caracteristica ORDER BY velocidad_max $order");
        $query->execute([]);

        return $query->fetchAll(PDO::FETCH_OBJ);
    }
    public function getModelosByTipo($order)
    {
        $query = $this->connect()->prepare("SELECT * FROM caracteristica ORDER BY tipo_uso $order");
        $query->execute([]);

        return $query->fetchAll(PDO::FETCH_OBJ);
    }
    public function getModelosByCapacidad($order)
    {
        $query = $this->connect()->prepare("SELECT * FROM caracteristica ORDER BY capacidad_tanque $order");
        $query->execute([]);

        return $query->fetchAll(PDO::FETCH_OBJ);
    }


}