<?php

include_once('./models/Votacion.php');
include_once('./models/Codes.php');
include_once('InternalController.php');

class VotacionController extends InternalController
{

  public function create($votacion)
  {
    if (!isset($votacion))
      $votacion = VotacionModel::GenerateDefaultVotacion();

    return $votacion;
  }

  public function newOption($data, $destiny) 
  {
    $votacion = VotacionModel::ReadModelFromPost($data);
    $votacion = VotacionModel::AddNewDefaultOption($votacion);
    return ["Code" => 0, "message" => "Opción eliminada.", "votacion" => $votacion];
  }

  public function removeOption($data, $idOpcion) 
  {
    $votacion = VotacionModel::ReadModelFromPost($data);
    $votacion = VotacionModel::RemoveOpcionById($votacion, $idOpcion);
    return ["Code" => 0, "message" => "Opción eliminada.", "votacion" => $votacion];
  }

  public function store($data)
  {
    $votacion = VotacionModel::ReadModelFromPost($data);
    $respuesta = VotacionModel::CreateVotacion($votacion);
    return $respuesta;
  }

  public function index()
  {
    $respuesta = VotacionModel::GetAllVotaciones();
    return $respuesta;
  }

  public function edit($id)
  {
      $respuesta = VotacionModel::GetVotacionById($id);
      return $respuesta;
  }

  public function update($_, $data)
  {
    $votacion = VotacionModel::ReadModelFromPost($data);
    $respuesta = VotacionModel::UpdateVotacion($votacion, null);
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