import uk from 'uikit'
import Icons from 'uikit/dist/js/uikit-icons'
import 'uikit/dist/css/uikit.min.css'
uk.use(Icons)

import '../css/SitePublicidad.css'

const CodeSuccess = 0;
const CodeNotFound = 404;
const CodeError = 99;

export const Codigos = {
    CodeSuccess,
    CodeNotFound,
    CodeError
};