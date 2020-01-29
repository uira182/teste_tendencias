<?php

/**
 * Classe de Insert dados no Banco de dados MySql.
 */
class SelectDados extends Conexao {

    private $symbol;

    function __construct($symbol, $ini, $fim){
        parent:: __construct();
        $this->symbol = $symbol;
        $this->selectDados($ini, $fim);   
    }
    private function selectDados($ini, $fim){
    $sql = "SELECT * FROM {$this->symbol} ORDER BY date DESC LIMIT $ini, $fim";
        $result = parent:: getAll($sql);
        $result = json_encode($result, true);
        echo($result);
    }
}

?>
