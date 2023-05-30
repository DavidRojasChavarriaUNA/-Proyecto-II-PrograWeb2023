<?php

include_once('./models/UserModel.php');
include_once('./models/Codes.php');
include_once('cors.php');

class  SeguridadController extends Controller{

    public function LoadAutenticatedUser($id){
        $respuesta = UserModel::getUserById($id);
        return $respuesta;
    }

    public function register($userToRegister) {
        $respuesta = UserModel::CreateUser($userToRegister);
        return $respuesta;
    }
    
    public function autenticate($userToAutenticate) {
        $respuesta = UserModel::Autenticate($userToAutenticate);
        return $respuesta;
    }

}

?>