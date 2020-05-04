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

Router::get('home/game',	'NormalGame/index');

Router::get('home/login',	'UserController/index');
Router::post('home/login',	'UserController/login');
Router::get('home/logout',	'UserController/logout');

Router::get('home/register',	'UserController/create');

Router::get('home/leaderboard',	'Leaderboard/index');

Router::resource('user', 'UserController');




/************** End of URLEncoder Routing Rules ************************************/