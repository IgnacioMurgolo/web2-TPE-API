<?php
require_once 'api/models/model.php';

class UserModel extends DB
{
    public function getByUsername($username)
    {
        $query = $this->connect()->prepare('SELECT * FROM usuario WHERE usuario = ?');
        $query->execute([$username]);

        return $query->fetch(PDO::FETCH_OBJ);
    }
}