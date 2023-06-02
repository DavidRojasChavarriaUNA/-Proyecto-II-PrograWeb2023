import 'bootstrap/dist/css/bootstrap.min.css'
import 'bootstrap'
import 'bootstrap-icons/font/bootstrap-icons.css'
import '../css/siteInterno.css'

const None = -1;
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
    None,
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