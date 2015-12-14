<?php

namespace
{
    require_once('db/sql_access.php');
}


namespace db {

    class db_handler
    {
        private $connection;

        public function __construct()
        {
            $this->connection = new \mysqli (\db\configuration::$host,
                \db\configuration::$name,
                \db\configuration::$pass,
                \db\configuration::$daba);


            if ($this->connection->connect_errno) {
                echo "Echec lors de la connexion à MySQL : ($this->connection->connect_errno )  $this->connection->connect_error";
            }
            $this->connection->set_charset('utf8');
        }

        public function query ($query) {
            //$this->connection->query($this->connection->real_escape_string($query));
            $this->connection->query($query);
        }

        public function __destruct() {
            $this->connection->close();
        }
    }
}