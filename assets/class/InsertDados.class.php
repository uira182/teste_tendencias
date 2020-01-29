<?php

/**
 * Classe de Insert dados no Banco de dados MySql.
 */
class InsertDados extends Conexao {

    private $dateTime;
    private $open;
    private $high;
    private $low;
    private $close;
    private $volume;

    function __construct($dateTime, $open, $high, $low, $close, $volume){
        parent:: __construct();

        $this->dateTime = $dateTime;
        $this->open = $open;
        $this->high = $high;
        $this->low = $low;
        $this->close = $close;
        $this->volume = $volume;

        $this->insertDados();   
    }
    private function comparaDados(){
        $sql = "SELECT * FROM msft WHERE date='{$this->dateTime}'";
        $result = parent:: getAll($sql);
        $nR = count($result); 
        if($nR > 0){
            return false;
        }else{
            return true;
        }
    }

    private function insertDados(){
        if($this->comparaDados()){
            $sql = "INSERT INTO msft (date, open, high, low, close, volume) VALUE ('{$this->dateTime}', '{$this->open}', '{$this->high}', '{$this->low}', '{$this->close}', '{$this->volume}')";
            parent:: execute($sql);
        }
    }

}
