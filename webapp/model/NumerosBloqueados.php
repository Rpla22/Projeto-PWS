<?php

class NumerosBloqueados
{
    public $num = array("1","2","3","4","5","6","7","8","9");
    public $pontos=0;

    public function checkJogada($num ,$sumDados)
    {
        if ($num == $sumDados) {
            return true;
        }
        return false;
    }

    public function bloquearNumeros(){
        for($i=1; $i<=9 ; $i++) {
            if ($this->num[$i - 1] == 10) {
                $this->num[$i - 1] = 0;
            }
        }
    }

    public function calcularPontos(){
        for($i=1; $i<=9 ; $i++) {
            if($this->num[$i - 1]!=0 ){
                $this->pontos +=$i;
            }
        }
    }
}