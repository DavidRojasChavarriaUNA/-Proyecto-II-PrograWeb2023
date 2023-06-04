<?php
    
    Route::post('server/seguridad/register','SeguridadController@register'); 
    Route::post('server/seguridad/autenticate', 'SeguridadController@autenticate');
    Route::get('server/seguridad/(:number)', 'SeguridadController@LoadAutenticatedUser');
    
    Route::resource('server/votacion', 'VotacionController');

    Route::get('server/votacion/(:number)/edit','VotacionController@edit');  
    Route::get('server/votacion/(:number)/delete','VotacionController@destroy');
    Route::get('server/votacion/(:number)/desactivar','VotacionController@cambiarEstado');
    Route::post('server/votacion/(:number)','VotacionController@update'); 
    
    Route::get('server/votante/(:number)', 'VotanteController@index');
    Route::get('server/votante/(:number)/votar', 'VotanteController@votar');
    Route::get('server/votante/(:number)/chooseOption', 'VotanteController@chooseOption');
    Route::post('server/votante/confirmOptionVote', 'VotanteController@confirmOptionVote');

    Route::get('server/resultados', 'ResultadosController@index');
    Route::get('server/resultados/(:number)','ResultadosController@show');

    Route::dispatch();
?>
