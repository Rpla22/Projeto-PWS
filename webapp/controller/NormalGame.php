<?php
use ArmoredCore\Controllers\BaseController;
use ArmoredCore\WebObjects\Redirect;
use ArmoredCore\WebObjects\Session;
use ArmoredCore\WebObjects\View;

class NormalGame extends BaseController
{
    public function index(){
        if(!Session::has("jogo")){
            $jogo = new Jogo();
            Session::set("jogo", $jogo);
            $msg = "Clique em Novo Jogo para Começar";
            $pontos = session::get("jogo")->numeroBloqueadosP1->pontos;
            $vencedor = "3";
            return View::make('jogo.index', ['msg' => $msg, 'pontos'=>$pontos, 'vencedor' => $vencedor]);
        }

        if(session::get("jogo")->player == 1){
            $msg = "Jogo a decorrer!";
            $pontos = session::get("jogo")->numeroBloqueadosP1->pontos;
            $vencedor = "3";
            return View::make('jogo.index', ['msg' => $msg, 'pontos'=>$pontos,'vencedor' => $vencedor]);
        } else if(session::get("jogo")->player == 2){
            // fazer aqui um controlo de fluxo
            $this->computerPlay();
        }else{
            session::get("jogo")->numeroBloqueadosP2->calcularPontos();
            $msg= 'Computador fez '. session::get("jogo")->numeroBloqueadosP2->pontos;
            $pontos = session::get("jogo")->numeroBloqueadosP1->pontos;
            $vencedor = session::get("jogo")->CalcularVencedor(session::get("jogo")->numeroBloqueadosP1->pontos, session::get("jogo")->numeroBloqueadosP2->pontos);

            $this->guardarJogo();

            return View::make('jogo.index', ['msg' => $msg, 'pontos'=>$pontos, 'vencedor' => $vencedor]);
        }


    }

    public function novoJogo(){
        Session::remove("jogo");
        $msg = "Novo Jogo!";
        $pontos = "";
        return Redirect::FlashtoRoute('jogo/index', ['msg' => $msg, 'pontos'=>$pontos]);
    }

    public function bloquear($index){
        if(session::get("jogo")->player == 1 ){
            if( session::get("jogo")->numeroBloqueadosP1->num[$index-1] == 10){
                $msg = "Numero desbloqueado!";
                session::get("jogo")->numeroBloqueadosP1->num[$index-1] = $index;
                return Redirect::FlashtoRoute('jogo/index', ['msg' => $msg]);
            }else{
                $msg = "Numero bloqueado!";
                session::get("jogo")->numeroBloqueadosP1->num[$index-1] = 10;
                return Redirect::FlashtoRoute(  'jogo/index', ['msg' => $msg]);
            }
        }
    }

    public function rodarDados(){
        if(session::get("jogo")->player == 1 ){
            $sumDados = session::get("jogo")->rdado1 + session::get("jogo")->rdado2;
            $sum = 0;
            for($i=1; $i<=9; $i++){
                if(session::get("jogo")->numeroBloqueadosP1->num[$i-1] ==10){
                    $sum +=  $i;
                }
            }
            if(!session::get("jogo")->numeroBloqueadosP1->checkJogada($sum, $sumDados)){
                $msg = "Numeros Incorretos!";
                return Redirect::FlashtoRoute('jogo/index', ['msg' => $msg]);
            }

            session::get("jogo")->numeroBloqueadosP1->bloquearNumeros();
            session::get("jogo")->getDados();
            $sumDados = session::get("jogo")->rdado1 + session::get("jogo")->rdado2;

            if(session::get("jogo")->checkJogadaFinal(session::get("jogo")->numeroBloqueadosP1->num, $sumDados)){
                session::get("jogo")->numeroBloqueadosP1->calcularPontos();
                session::get("jogo")->player = 2;
                return Redirect::toRoute(  'jogo/index');
            }
            $msg="Jogada válida";
            return Redirect::FlashtoRoute(  'jogo/index', ['msg' => $msg]);
        }

    }

    public function computerPlay(){

            $validacao = 0;
            $numeros = session::get("jogo")->numeroBloqueadosP2->num;
            $sumDados = session::get("jogo")->rdado1 + session::get("jogo")->rdado2;
            if ($validacao == 0) {
                for ($i = 1; $i <= 9; $i++) {
                    if ($sumDados == $numeros[$i - 1] && $numeros[$i - 1] != 0) {
                        session::get("jogo")->numeroBloqueadosP2->num[$i - 1] = 0;
                        $validacao = 1;
                    }
                }
            }
            if ($validacao == 0) {
                for ($i = 1; $i <= 9; $i++) {
                    if ($validacao = 1) {
                        break;
                    }
                    for ($j = 1; $j <= 9; $j++) {
                        if ($sumDados == $numeros[$i - 1] + $numeros[$j - 1] && $numeros[$i - 1] != 0 && $numeros[$j - 1] != 0 && $numeros[$i - 1] != $numeros[$j - 1]) {
                            session::get("jogo")->numeroBloqueadosP2->num[$i - 1] = 0;
                            session::get("jogo")->numeroBloqueadosP2->num[$j - 1] = 0;
                            $validacao = 1;
                            break;
                        }
                    }
                }
            }

        if ($validacao == 0) {
            for ($i = 1; $i <= 9; $i++) {
                if ($validacao = 1) {
                    break;
                }
                for ($x = 1; $x <= 9; $x++) {
                    if ($validacao = 1) {
                        break;
                    }
                    for ($j = 1; $j <= 9; $j++) {
                        if ($sumDados == $numeros[$i - 1] + $numeros[$j - 1] + $numeros[$x - 1]&& $numeros[$x - 1] != 0&& $numeros[$i - 1] != 0 && $numeros[$j - 1] != 0 && $numeros[$i - 1] != $numeros[$j - 1] && $numeros[$i - 1] != $numeros[$x - 1] && $numeros[$x - 1] != $numeros[$j - 1] ) {
                            session::get("jogo")->numeroBloqueadosP2->num[$i - 1] = 0;
                            session::get("jogo")->numeroBloqueadosP2->num[$j - 1] = 0;
                            session::get("jogo")->numeroBloqueadosP2->num[$x - 1] = 0;
                            $validacao = 1;
                            break;
                        }
                    }
                }
            }
        }
            session::get("jogo")->getDados();

        if(session::get("jogo")->checkJogadaFinal(session::get("jogo")->numeroBloqueadosP2->num,$sumDados)){
            session::get("jogo")->player = 3;
            return Redirect::toRoute(  'jogo/index');
        }
        return Redirect::toRoute(  'jogo/index');
    }

    public function guardarJogo(){
        $jogo = new Game();
        $jogo->pontos = session::get("jogo")->pontos;
        $jogo->users_id = session::get("user")->id;
        $jogo->save();
    }


}