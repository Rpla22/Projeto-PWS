<?php
use ArmoredCore\Controllers\BaseController;
use ArmoredCore\WebObjects\Redirect;
use ArmoredCore\WebObjects\Session;
use ArmoredCore\WebObjects\View;

class NormalGame extends BaseController
{
    public function index(){
        return View::make('home.game');
    }

}