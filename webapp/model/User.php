<?php

/**
 * Created by PhpStorm.
 * User: smendes
 * Date: 17-05-2016
 * Time: 14:16
 */
class User extends \ActiveRecord\Model
{

    protected $fillable = array('primeiro','apelido','username', 'password', 'data_nasc','email');

    static $validates_presence_of = array(
        array('primeiro'),
        array('apelido'),
        array('username','message' => 'Erro no Registo'),
        array('password','message' => 'Erro no Login'),
        array('data_nasc'),
        array('email'),
    );


    public function rules()
    {
        return [
            'primeiro' => 'required',
            'apelido' => 'required',
            'username' => 'required',
            'password' => 'required',
            'data_nasc' => 'required',
            'email' => 'required|email',

        ];
    }


}