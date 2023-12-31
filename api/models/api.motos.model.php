<?php
require_once 'api/models/model.php';

class MotosModel extends DB
{

    public function getMotos()
    {
        $query = $this->connect()->prepare('SELECT * FROM moto');
        $query->execute();
        $motos = $query->fetchAll(PDO::FETCH_OBJ);
        return $motos;
    }

    public function getMotoById($id)
    {
        $query = $this->connect()->prepare('SELECT * FROM moto JOIN caracteristica ON moto.modelo = caracteristica.modelo WHERE moto.id=?');
        $query->execute([$id]);
        $moto = $query->fetch(PDO::FETCH_OBJ);
        return $moto;
    }

    public function deleteMoto($id)
    {
        $query = $this->connect()->prepare('DELETE FROM moto WHERE id=?');
        $query->execute([$id]);
    }

    public function updateMoto($id, $marca, $modelo, $anio, $precio)
    {
        $query = $this->connect()->prepare('UPDATE moto SET marca=?, modelo=?, anio=?, precio=? WHERE id=?');
        $query->execute([$marca, $modelo, $anio, $precio, $id]);
    }

    public function getMoto($marca, $modelo, $anio, $precio)
    {
        $query = $this->connect()->prepare('SELECT id FROM moto WHERE marca=? AND modelo=? AND anio=? AND precio=?');
        $query->execute([$marca, $modelo, $anio, $precio]);
        $moto = $query->fetch(PDO::FETCH_OBJ);
        return $moto;
    }

    public function addMoto($marca, $modelo, $anio, $precio)
    {
        $query = $this->connect()->prepare('INSERT INTO moto (marca,modelo,anio,precio) VALUES (?,?,?,?)');
        $query->execute([$marca, $modelo, $anio, $precio]);
    }

    public function getMotosByMarca($order)
    {
        $query = $this->connect()->prepare("SELECT * FROM moto ORDER BY marca $order");
        $query->execute([]);

        return $query->fetchAll(PDO::FETCH_OBJ);
    }
    public function getMotosByModelo($order)
    {
        $query = $this->connect()->prepare("SELECT * FROM moto ORDER BY modelo $order");
        $query->execute([]);

        return $query->fetchAll(PDO::FETCH_OBJ);
    }
    public function getMotosByAnio($order)
    {
        $query = $this->connect()->prepare("SELECT * FROM moto ORDER BY anio $order");
        $query->execute([]);

        return $query->fetchAll(PDO::FETCH_OBJ);
    }
    public function getMotosByPrecio($order)
    {
        $query = $this->connect()->prepare("SELECT * FROM moto ORDER BY precio $order");
        $query->execute([]);

        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    public function getMotosFiltroMarca($marca)
    {
        $query = $this->connect()->prepare('SELECT * FROM moto JOIN caracteristica ON moto.modelo=caracteristica.modelo WHERE moto.marca=?');
        $query->execute([$marca]);
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    public function getMotosFiltroModelo($modelo)
    {
        $query = $this->connect()->prepare('SELECT * FROM moto JOIN caracteristica ON moto.modelo=caracteristica.modelo moto WHERE modelo=?');
        $query->execute([$modelo]);
        return $query->fetchAll(PDO::FETCH_OBJ);
    }
    public function getMotosFiltroAnio($anio)
    {
        $query = $this->connect()->prepare('SELECT * FROM moto JOIN caracteristica ON moto.modelo=caracteristica.modelo WHERE anio=?');
        $query->execute([$anio]);
        return $query->fetchAll(PDO::FETCH_OBJ);
    }
    public function getMotosFiltroPrecio($precio)
    {
        $query = $this->connect()->prepare('SELECT * FROM moto JOIN caracteristica ON moto.modelo=caracteristica.modelo WHERE precio=?');
        $query->execute([$precio]);
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

}
?>