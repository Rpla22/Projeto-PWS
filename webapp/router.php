<?php
/**
 * Created by PhpStorm.
 * User: smendes
 * Date: 02-05-2016
 * Time: 11:18
 */
use ArmoredCore\Facades\Router;

/****************************************************************************
 *  URLEncoder/HTTPRouter Routing Rules
 *  Use convention: controllerName@methodActionName
 ****************************************************************************/

Router::get('/',			'HomeController/index');
Router::get('home/',		'HomeController/index');
Router::get('home/index',	'HomeController/index');



Router::get('home/login',	'UserController/index');
Router::post('home/login',	'UserController/login');
Router::get('home/logout',	'UserController/logout');
Router::get('home/register',	'UserController/create');
Router::post('user/store',	'UserController/store');
Router::get('home/leaderboard',	'Leaderboard/index');


Router::get('user/perfil',	'UserController/perfil');
Router::get('user/pontos',	'UserController/pontos');
Router::get('user/admin',	'UserController/admin');
Router::post('user/atualizar',	'UserController/atualizar');


Router::get('jogo/index',	'NormalGame/index');
Router::post('jogo/bloquear',	'NormalGame/bloquear');
Router::get('jogo/novoJogo',	'NormalGame/novoJogo');
Router::get('jogo/rodarDados',	'NormalGame/rodarDados');

Router::resource('user', 'UserController');




/************** End of URLEncoder Routing Rules ************************************/