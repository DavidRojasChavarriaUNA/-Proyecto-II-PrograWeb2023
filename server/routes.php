<?php
    
    Route::get('/', 'SitioPublicidadController@index');
    Route::post('server/seguridad/register','SeguridadController@register'); 
    Route::post('server/seguridad/autenticate', 'SeguridadController@autenticate');
    Route::get('server/seguridad/(:number)', 'SeguridadController@LoadAutenticatedUser');

    Route::get('/sitioInterno', 'SitioInternoController@Home');
    
    Route::resource('/votacion', 'VotacionController');
    Route::post('server/votacion/newOption', 'VotacionController@newOption');
    Route::post('server/votacion/removeOption','VotacionController@removeOption');
    Route::put('server/votacion/newOption', 'VotacionController@newOption');
    Route::put('server/votacion/removeOption','VotacionController@removeOption');

    Route::get('server/votacion/(:number)/edit','VotacionController@edit');  
    Route::get('server/votacion/(:number)/delete','VotacionController@destroy');
    Route::get('server/votacion/(:number)/desactivar','VotacionController@cambiarEstado');
    
    Route::get('server/votante/(:number)', 'VotanteController@index');
    Route::get('server/votante/(:number)/votar', 'VotanteController@votar');
    Route::get('server/votante/(:number)/chooseOption', 'VotanteController@chooseOption');
    Route::post('server/votante/confirmOptionVote', 'VotanteController@confirmOptionVote');

    Route::get('server/resultados', 'ResultadosController@index');
    Route::get('server/resultados/(:number)/votar', 'ResultadosController@votar');
    Route::get('server/resultados/(:number)','ResultadosController@show');

    Route::dispatch();
?>
