<?php
    
    Route::get('/', 'SitioPublicidadController@index');
    Route::post('server/seguridad/register','SeguridadController@register'); 
    Route::post('server/seguridad/autenticate', 'SeguridadController@autenticate');
    Route::get('server/seguridad/(:number)', 'SeguridadController@LoadAutenticatedUser');

    Route::get('/sitioInterno', 'SitioInternoController@Home');
    
    Route::resource('/votacion', 'VotacionController');
    Route::post('/votacion/newOption', 'VotacionController@newOption');
    Route::post('/votacion/removeOption','VotacionController@removeOption');
    Route::put('/votacion/newOption', 'VotacionController@newOption');
    Route::put('/votacion/removeOption','VotacionController@removeOption');

    Route::get('/votacion/(:number)/edit','VotacionController@edit');  
    Route::get('/votacion/(:number)/delete','VotacionController@destroy');
    Route::get('/votacion/(:number)/desactivar','VotacionController@cambiarEstado');
    
    Route::get('server/votante/(:number)', 'VotanteController@index');
    Route::get('server/votante/(:number)/votar', 'VotanteController@votar');
    Route::post('server/votante/confirmOptionVote', 'VotanteController@confirmOptionVote');

    Route::get('/resultados', 'ResultadosController@index');
    Route::get('/resultados/(:number)/votar', 'ResultadosController@votar');
    Route::get('/resultados/(:number)','ResultadosController@show');

    Route::dispatch();
?>
