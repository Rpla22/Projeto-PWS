<?php

/**
 * Created by PhpStorm.
 * User: smendes
 * Date: 17-05-2016
 * Time: 14:16
 */
class User extends \ActiveRecord\Model
{

    protected $fillable = array('username', 'password', 'data_nasc','email');

    static $validates_presence_of = array(
        array('username'),
        array('password','message' => 'As passwords nao correspondem'),
        array('data_nasc'),
        array('email')
    );


    public function rules()
    {
        return [
            'username' => 'required|unique:posts|max:255',
            'password' => 'required',
            'data_nasc' => 'required',
            'email' => 'required|email',

        ];
    }


}