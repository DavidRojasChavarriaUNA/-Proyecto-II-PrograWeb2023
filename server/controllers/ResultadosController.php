<?php

include_once('./models/Votacion.php');
include_once('./models/Codes.php');
include_once('./models/ResultadoVotacionModel.php');
include_once('cors.php');

class ResultadosController extends Controller
{

  public function index()
  {
    $respuesta = VotacionModel::GetAllVotacionesActivasEInactivas();
    return $respuesta;

  }

  public function show($id)
  {
    $r = VotacionModel::GetVotacionById($id);
    $votacion = $r['votacion'];
    $opciones = $votacion['opciones'];
    $respuesta = ResultadoVotacionModel::getResultados($id);
    $ResultadosTotal = [];

    if ($respuesta["Code"] == CodeSuccess) {
      $resultados = $respuesta["resultados"];

      foreach ($resultados as $resultado) {

        foreach ($opciones as $opcion) {
          $cantidad = 0;
          if ($resultado['idOpcion'] == $opcion['id']) {
            $cantidad++;
          }
          $opc = [
            'opcion' => $opcion['nombre'],
            'cantidad' => $cantidad,
            'rutaImagen' => $opcion['rutaImagen']
          ];
          array_push($ResultadosTotal, $opc);
        }
      }
      unset($votacion["opciones"]);
      $votacion["resultados"] = $ResultadosTotal;
      return ["Code"=>0, "message" => "Resultados obtenidos con éxito.", "votacion" => $votacion];

    } else {
      return $respuesta;
    }
   
  }

}
?>