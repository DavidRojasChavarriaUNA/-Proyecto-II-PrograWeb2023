<?php

  include_once('Codes.php');

  class UserModel extends Model {

    protected static $table="users";

    public static function Autenticate($userToAutenticate) {
        try {
            if(!isset($userToAutenticate) || !isset($userToAutenticate["email"]) || !isset($userToAutenticate["password"]))
                return ["Code" => CodeUnautorized, "message" => "Usuario y contraseña es requerido."];

            $result = self::where('email',$userToAutenticate["email"]);
            if(!empty($result)){
                if(($result[0]['password']) == ($userToAutenticate["password"])){
                    return ["Code" => CodeSuccess, "message" => "Usuario autenticado", "id" => $result[0]['id']];
                }else{
                    return ["Code" => CodeUnautorized, "message" => "Usuario o contraseña inválido."];
                }
            
            }else{
                return ["Code" => CodeUnautorized, "message" => "Usuario o contraseña inválido."];
            }
        }
        catch (Exception $e) {
            return ["Code" => CodeError, "message" => "Ocurrió un error al autenticar el usuario, {$e->getMessage()}."];
        }
    }

    public static function CreateUser($item)
    {
        try {
            self::create($item);
            return ["Code" => 0, "message" => "Usuario creado con éxito."];
        } 
        catch (Exception $e) {
            return ["Code" => 99, "message" => "No se pudo crear el usuario, {$e->getMessage()}."];
        }
    }
    
    public static function getUserById($id){
        $users = self::find($id);
        if(!empty($users)){
            unset($users[0]['password']);
            return ["Code" => CodeSuccess, "message" => "Usuario encontrado", "User" => $users[0]];
        }
        return ["Code" => CodeNotFound, "message" => "No se encontró un usuario con el id: {$id}."];
    }

  }
?>
