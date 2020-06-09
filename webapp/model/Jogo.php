<?php


class Jogo
{
    public $player;
    public $rdado1;
    public $rdado2;

    public $numeroBloqueadosP1;
    public $numeroBloqueadosP2;

    public $pontos;

    public function getDados(){
        $this->rdado1= rand(1,6);
        $this->rdado2= rand(1,6);
    }

    public function __construct() {
        $this->numeroBloqueadosP1 = new NumerosBloqueados();
        $this->numeroBloqueadosP2 = new NumerosBloqueados();
        $this->player=1;
        $this->getDados();
    }

    public function checkJogadaFinal($numeros, $sumDados){
        $val = false;
        $somaNumeros = 0;
        for($i=1; $i<=9; $i++){
            if($numeros[$i-1] !=0){
                $somaNumeros +=  $i;
            }
        }

        if( $somaNumeros < $sumDados){
            $val= true;
        }else if($somaNumeros > $sumDados){

            for ($i= 1; $i<=9; $i++) {
                if($numeros[$i-1] == $sumDados && $numeros[$i-1]!=0 ){
                    return false;
                }
            }

            for ($i= 1 ; $i<=9 ; $i++){
                for ($j= 1 ; $j<=9 ; $j++) {
                    $soma = $numeros[$i-1] + $numeros[$j-1];
                    if ($soma == $sumDados && $numeros[$i-1]!=0 && $numeros[$j-1]!=0 && $numeros[$i-1]!=$numeros[$j-1] ){
                        return false;
                    }
                }
            }

            for ($i= 1 ; $i<=9 ; $i++){
                for ($x= 1 ; $x<=9 ; $x++){
                    for ($j= 1 ; $j<=9 ; $j++) {
                        $soma = $numeros[$i-1] + $numeros[$j-1] + $numeros[$x-1];
                        if ($soma == $sumDados && $numeros[$i-1]!=0 && $numeros[$j-1]!=0 && $numeros[$x-1]!=0 && $numeros[$i-1]!=$numeros[$j-1] && $numeros[$x-1]!=$numeros[$j-1] && $numeros[$i-1]!=$numeros[$x-1] ){
                            return false;
                        }
                    }
                }

            }

            return true;
        }
        return $val;
    }

    public function calcularVencedor($p1, $p2){
        if($p1> $p2){
            return 2;
        }elseif ($p1< $p2){
            //calcular
            $this->pontos = $p2 - $p1;
            return 1;
        }else{
            return 0;
        }



    }



}