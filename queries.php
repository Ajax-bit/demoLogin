<?php
include "db.php";

class Query extends db {
    // Establecemos conexión
    function __construct(){
        parent::__construct();
    }

    public function checkId($n){

        $checkId = "SELECT id FROM Users WHERE Username='$n'";

        return $this->consultar($checkId);

    }

    public function checkUser(){

        $checkUser = "SELECT Username, Surname, Email, Position FROM Users";

        return $this->consultar($checkUser);

    }

    public function validate($user){

        $check = "SELECT Password FROM Users WHERE Username='$user'";

        return $this->consultar($check);

    }

    public function register($user, $surn, $email, $pos, $pass){

        $create = "INSERT INTO Users (Username, Surname, Email, Position, Password) VALUES ('$user', '$surn', '$email', '$pos', '$pass')";

        return $this->consultar($create);
    }


    public function update($id, $n, $s, $e, $p){

        $update = "UPDATE Users SET Username='$n', Surname='$s', Email='$e', Position='$p' WHERE id='$id'";
    
        return $this->consultar($update);
    }


}
?>