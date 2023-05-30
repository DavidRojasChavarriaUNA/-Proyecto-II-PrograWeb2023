<?php

  include_once('./models/Votacion.php');
  include_once('./models/OpcionModel.php');
  include_once('./models/Codes.php');
  include_once('./models/ResultadoVotacionModel.php');
  include_once('./models/VotacionUsersModel.php');

  header('Access-Control-Allow-Origin: *');
  header('Access-Control-Allow-Methods: GET, POST');
  header("Access-Control-Allow-Headers: X-Requested-With");
  
  class VotanteController extends Controller {      

    public function index($idUsuario) {
        $respuesta = VotacionModel::GetAllVotacionesPendientesVotarUser($idUsuario);
        return $respuesta;
    }

    public function votar($idVotacion) {
        $idOpcionSeleccionada = null; 
        $respuesta = VotacionModel::GetVotacionById($idVotacion, $idOpcionSeleccionada);
        return $respuesta;
    }

    public function confirmOptionVote($Datos) {
      //$opcionSeleccionada = ResultadoVotacionModel::ReadModelFromPost();
      $opcionSeleccionada = $Datos["OpcionSeleccionada"];
      $respuesta = ResultadoVotacionModel::CreateResultadoVotacion($opcionSeleccionada);
      $mensaje = "{$respuesta["Code"]} - {$respuesta["message"]}";
      if ($respuesta["Code"] == CodeSuccess) {
        //$votacionUsuario = VotacionUsersModel::ReadModelFromPost($this->User['id']);
        $votacionUsuario = $Datos["votacionUsuario"];
        $respuesta = VotacionUsersModel::CreateVotacionUser($votacionUsuario);
        //si hay un mensaje anterior se concatena al nuevo
        $respuesta["message"] = (!empty($mensaje)? "{$mensaje} \n" : "") . "{$respuesta["Code"]} - {$respuesta["message"]}";
      }
      return $respuesta;
    }

  }
?>