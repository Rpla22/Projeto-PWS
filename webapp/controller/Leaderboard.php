<?php
use ArmoredCore\Controllers\BaseController;
use ArmoredCore\WebObjects\Redirect;
use ArmoredCore\WebObjects\Session;
use ArmoredCore\WebObjects\View;

class Leaderboard extends BaseController
{
    public function index(){

        $data = Game::find_by_sql('select sum(g.pontos) as pontos,  u.username as user
                                        from `games` g INNER JOIN USERS u
                                        on g.users_id = u.id
                                        group by users_id order by pontos desc');
        return View::make('home.leaderboard',['data' => $data]);
    }

}