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
        $user = new User();
        $user->username = Post::get('username');
        $user->password = Post::get('password');
        $user->data_nasc = Post::get('data_nasc');
        $user->email = Post::get('email');
        $second_password = Post::get('secondPassword');


        if($second_password != $user->password){
            Redirect::flashToRoute('home/register', ['user' => $user]);
        }else
            if($user->is_valid()){
                $user->save();
                Redirect::toRoute('home/index');
            } else {

                // return form with data and errors

            }
    }

    public function login()
    {
        $us = Post::get("username");
        $pw = Post::get("password");

        $user = User::all();
        foreach ($user as $value){
            if($value->username == $us && $value->password == $pw ){
                Session::set("user", $value);
                Redirect::toRoute('home/index');
            }
        }

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