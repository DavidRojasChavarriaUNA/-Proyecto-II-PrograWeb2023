<?php

include_once('./models/Votacion.php');
include_once('./models/Codes.php');
include_once('cors.php');

class VotacionController extends Controller
{

  public function index()
  {
    $respuesta = VotacionModel::GetAllVotaciones();
    return $respuesta;
  }

  public function store($votacion)
  {
    $respuesta = VotacionModel::CreateVotacion($votacion);
    return $respuesta;
  }

  public function edit($id)
  {
      $respuesta = VotacionModel::GetVotacionById($id);
      return $respuesta;
  }

  public function update($votacion)
  {
    $respuesta = VotacionModel::UpdateVotacion($votacion);
    return $respuesta;
  }
  public function destroy($id)
  {
    $respuesta = VotacionModel::DestroyVotacionWithOpciones($id);
    return $respuesta;
  }

  public function cambiarEstado($id)
  {
    $respuesta = VotacionModel::GetVotacionById($id);
    if ($respuesta["Code"] == CodeSuccess) {
      $votacion = $respuesta["votacion"];
      $descripcion = $votacion['descripcion'];
      $fechaHoraInicio = $votacion['fechaHoraInicio'];
      $fechaHoraFin = $votacion['fechaHoraFin'];
      $item = [
        'id' => $id,
        'descripcion' => $descripcion,
        'idEstado' => 3,
        'fechaHoraInicio' => $fechaHoraInicio,
        'fechaHoraFin' => $fechaHoraFin
      ];
      $respuesta = VotacionModel::ChangeState($item);
    } 
    return $respuesta;
  }
}
?>