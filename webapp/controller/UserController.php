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
        $error ="";
        return View::make('home.register',['error' => $error]);
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
                $error = 'Utilizador ou email ja existente';
                return View::make('home.register', ['error' => $error]);;
            }
        }

        // validações de formulario
        if($second_password != $user->password){
            $error = 'Password nao coincide';
            return View::make('home.register', ['error' => $error]);;
        }


        if($user->is_valid()){
                $user->save();
                return Redirect::toRoute('home/index');;
            } else {
                // return form with data and errors
            $error='Algo deu errado';

                return View::make('home.register', ['error' => $error]);;
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

    public function perfil(){
        $error="";
        return view::make('userViews.user',['error' => $error] );

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

    public function atualizar()
    {
        $user = User::find (session::get("user")->id);
        $user->primeiro= Post::get('nome');
        $user->apelido= Post::get('apelido');
        $user->data_nasc = Post::get('data_nasc');
        $user->email = Post::get('email');

        // buscar utilizadores da DB
        $userDb = User::all();

        $password = Post::get('password');
        $npassword = Post::get('nPassword');
        $cpassword = Post::get('cPassword');
        if($password != session::get("user")->password){
            $error="Password Incorreta";
            return view::make('userViews.user',['error' => $error] );
        }

<<<<<<< Updated upstream
        if($npassword != $cpassword){
            $error="Password Nova Incorreta";
            return view::make('userViews.user',['error' => $error] );
        }
        $user->password= $npassword;

=======
>>>>>>> Stashed changes
        if($user->is_valid()) {
            $user->save();
            Session::set("user", $user);
            return Redirect::toRoute('home/index');
        }
    }

    public function pontos(){
        $data = Game::find('all', array('conditions' => array('users_id = ?', session::get("user")->id)));
        $pontos= 0;
        foreach ($data as $jogos){
            $pontos += $jogos->pontos;
        }

        return View::make('userViews.pontos', ['data'=> $data, 'pontos'=>$pontos]);;
    }

    public function admin(){
        $userDb = User::all();
        $error = "";
        return View::make('userViews.admin', ['data' => $userDb, 'error' => $error]);
    }
    /**
     * @param $id
     * @return mixed
     */
    public function destroy($id)
    {
        $allUser = User::all();
        $userDb = User::find($id);

        if($userDb->id ==  session::get("user")->id){
            $error = "Não é possivel bloquear a sua conta";
            return View::make('userViews.admin', ['data' => $allUser, 'error' => $error]);
        }

        if($userDb->permissao == 2){
            $error = "O utilizador que pretende bloquer é um administrador";
            return View::make('userViews.admin', ['data' => $allUser, 'error' => $error]);
        }

        if($userDb->permissao != 0 ){
            $userDb->permissao = 0;
            if($userDb->is_valid()) {
                $userDb->save();
                $error = "";
                return Redirect::FlashtoRoute('user/admin', ['data' => $allUser, 'error' => $error]);
            }
        }else{
            $userDb->permissao = 1;
            if($userDb->is_valid()) {
                $userDb->save();
                $error = "";
                return Redirect::FlashtoRoute('user/admin', ['data' => $allUser, 'error' => $error]);

            }
        }
    }

    public function logout(){
        Session::destroy();
        Redirect::toRoute('home/index');
    }


    public function promover($id)
    {
        $allUsers = User::all();
        $userDb = User::find($id);

        if($userDb->id ==  session::get("user")->id){
            $error = "Não é possivel despromover-se";
            return View::make('userViews.admin', ['data' => $allUsers, 'error' => $error]);
        }

        if($userDb->permissao ==  0){
            $error = "Não é possivel promover um user bloqueado";
            return View::make('userViews.admin', ['data' => $allUsers, 'error' => $error]);
        }


        if($userDb->permissao != 2 ){
            $userDb->permissao = 2;
            if($userDb->is_valid()) {
                $userDb->save();
                $error = "";
                return Redirect::FlashtoRoute('user/admin', ['data' => $allUsers, 'error' => $error]);
            }
        }else{
            $userDb->permissao = 1;
            if($userDb->is_valid()) {
                $userDb->save();
                $error = "";
                return Redirect::FlashtoRoute('user/admin', ['data' => $allUsers, 'error' => $error]);

            }
        }
    }

}