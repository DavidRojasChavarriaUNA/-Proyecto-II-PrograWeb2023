import 'bootstrap/dist/css/bootstrap.min.css'
import 'bootstrap'
import '../css/siteInterno.css'
import '../js/AutoFileToBase64.min.js'

const CodeSuccess = 0;
const CodeUnautorized = 401;
const CodeExpired = 440;
const CodeNotFound = 404;
const CodeError = 99;
const EstadoEnProceso = 1;
const EstadoActivo = 2;
const EstadoInactivo = 3;
const OpcionesPorDefecto = 2;

export const Codigos = {
    CodeSuccess,
    CodeUnautorized,
    CodeExpired,
    CodeNotFound,
    CodeError,
    EstadoEnProceso,
    EstadoActivo,
    EstadoInactivo,
    OpcionesPorDefecto
};