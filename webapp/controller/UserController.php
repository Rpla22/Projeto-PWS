<?php
use ArmoredCore\Controllers\BaseController;
use ArmoredCore\WebObjects\Post;
use ArmoredCore\WebObjects\Redirect;
use ArmoredCore\WebObjects\View;
use Armoredcore\WebObjects\Session;
use ArmoredCore\Interfaces\ResourceControllerInterface;

class UserController extends BaseController implements ResourceControllerInterface{

    public function index(){

        return View::make('home.login');
    }

    public function create(){
        return View::make('home.register');
    }

    public function store()
    {
        // create new resource (activerecord/model) instance
        // your form name fields must match the ones of the table fields
        // buscar os dados do POST
        $user = new User();
        $user->primeiro= Post::get('primeiro');
        $user->apelido= Post::get('apelido');
        $user->username = Post::get('username');
        $user->password = Post::get('password');
        $user->data_nasc = Post::get('data_nasc');
        $user->email = Post::get('email');
        $second_password = Post::get('secondPassword');

        // buscar utilizadores da DB
        $userDb = User::all();

        // validar se o utilador ja existe
        foreach($userDb as $value){
            if($value->username == $user->username || $value->email == $user->email){
                $user = new User();
                Redirect::flashToRoute('home/register', ['user' => $user]);
            }
        }

        // validações de formulario
        if($second_password != $user->password){
            $user = new User();
            Redirect::flashToRoute('home/register', ['user' => $user]);
        } else if($user->is_valid()){
                $user->save();
                Redirect::toRoute('home/index');
                return;
            } else {
                // return form with data and errors
                $user = new User();
                Redirect::flashToRoute('home/register', ['user' => $user]);
            }
    }

    public function login()
    {
        $us = Post::get("username");
        $pw = Post::get("password");
        $user = User::all();


        foreach ($user as $value){
            if(strtoupper($value->username) == strtoupper($us) && $value->password == $pw && $value->permissao!=0 ){
                Session::set("user", $value);
                Redirect::toRoute('home/index');
                return;
            }
        }
        $user = new User();
        Redirect::flashToRoute('home/login', ['user' => $user]);

    }

    public function show($id)
    {

    }

    public function edit($id)
    {

    }

    /**
     * @param $id
     * @return mixed
     */
    public function update($id)
    {

    }

    /**
     * @param $id
     * @return mixed
     */
    public function destroy($id)
    {

    }

    public function logout(){
        Session::destroy();
        Redirect::toRoute('home/index');
    }

}