<?php


class Game extends \ActiveRecord\Model
{
    protected $fillable = array('pontos','users_id');

    static $validates_presence_of = array(
        array('pontos'),
        array('users_id'),
    );


}