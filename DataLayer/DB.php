<?php

class DB {

    private $servername = "localhost";
    private $username = "root";
    private $password = "";
    private $dbname = "store_system";
    private $connection;

    function __construct() {
        $this->connection = new mysqli(
                $this->servername, $this->username, $this->password, $this->dbname
        );

        if ($this->connection->connect_error) {
            die("Bağlantı hatası: " . $this->connection->connect_error);
        }

        $this->connection->set_charset("utf8");
    }

    function __destruct() {
        $this->connection->close();
    }

    public function getDataTable($query) {
        $result = $this->connection->query($query);
        return $result;
    }

    public function executeQuery($query) {
        if ($this->connection->query($query) == TRUE) {
            $last_id = $this->connection->insert_id;
            return $last_id;
        } else {
            return -1;
        }
    }

}

?>