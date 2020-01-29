<?php

    require_once("../class/Conexao.class.php");
    require_once("../class/InsertDados.class.php");
    require_once("../class/SelectDados.class.php");

    if(isset($_POST['posttime'])){
        $dados = json_decode($_POST['posttime'], true);
        //var_dump($dados);
        foreach ($dados as $key => $valor) {
            //echo($key);
            $insert = new InsertDados($key, $valor['1. open'], $valor['2. high'], $valor['3. low'], $valor['4. close'], $valor['5. volume']);
        }
    }
    if(isset($_GET['readValue'])){
        $select = new selectDados($_GET['readValue'], $_GET['ini'], $_GET['fim']);
    }

    //var_dump($horario);
?>