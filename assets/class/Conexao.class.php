<?php

/**
 * Classe de Conexão com o Banco de dados MySql.
 */
class Conexao {

    private $conn; // Validar a conexão
    private $host; // O caminho para a conexão;
    private $user; // Nome do login de acesso;
    private $password; //Senha de acesso;
    private $baseName; // Nome do banco de dados;
    private $port; // Porta de acesso ao servidor MySql
    private $debug; // Atributo controlador de erros

    public function __construct() {
        $this->conn = false;
        $this->host = 'localhost';
        $this->user = 'root';
        $this->password = '';
        $this->baseName = 'tendencias';
        $this->port = '3306';
        $this->debug = true;

        $this->connect();
        
    }

    public function __destruct() {
        $this->disconnect();
    }

    private function disconnect() {
        if ($this->conn) {
            $this->conn = null;
        }
    }

    private function connect() {
        if (!$this->conn) {
            try {
                $this->conn = new PDO('mysql:host=' . $this->host . '; dbname=' . $this->baseName, $this->user, $this->password, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
            } catch (Exception $e) {
                die('ERRO:' . $e->getMessage());
                die('ERRO:' . $e->getLine());
            }

            if (!$this->conn) {
                $this->debug = true;
            } else {
                $this->debug = false;
            }
        }

        return $this->conn;
    }

    protected function getOne($query) {
        $resultado = $this->conn->prepare($query);
        $ret = $resultado->execute();

        if (!$ret) {
            echo 'PDO::errorInfo(): <br />';
            echo 'erro SQL:' . $query;
            die();
        }
        $resultado->setFetchMode(PDO::FETCH_ASSOC);
        $retorno = $resultado->fetch();

        return $retorno;
    }

    public function getAll($query) {
        $resultado = $this->conn->prepare($query);
        $ret = $resultado->execute();
        if (!$ret) {
            echo 'PDO::errorInfo():';
            echo '<br />';
            echo 'Erro SQL:' . $query . '<br />';
        }
        $resultado->setFetchMode(PDO::FETCH_ASSOC);
        $retorno = $resultado->fetchAll();

        return $retorno;
    }

    protected function execute($query) {
        if (!$resposta = $this->conn->exec($query)) {
            return false;
            echo 'PDO::errorInfo(): <br />';
            echo 'erro SQL:' . $query;
            die();
        } else {
            return true;
        }
    }

}

?>