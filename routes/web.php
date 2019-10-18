<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->post('/salas/{sala}/agendar', 'AgendamentoController@agendar');
$router->post('/agendamentos/{id}/cancelar', 'AgendamentoController@cancelar');
$router->get('/agendamentos/hoje', 'AgendamentoController@agendamentosDoDia');
