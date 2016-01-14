<?php

namespace
{
    require_once('db/sql_access.php');
}


namespace db {

    class db_handler
    {
        private static $connection;
        private $preparation;


        public static function init () {
            $param = 'mysql:dbname=';
            $param .= \db\configuration::$daba;
            $param .= ";host=";
            $param .= \db\configuration::$host;

            $options = array(
                \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                \PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''
            );


            try {
                self::$connection = new \PDO ($param,
                    \db\configuration::$name,
                    \db\configuration::$pass,
                    $options);
            } catch (\PDOException $e) {
                echo 'Connexion échouée : ' . $e->getMessage();
            }
    }// init

        public function __construct()
        {

        }// db_wrap

        public static function close()
        {
            self::$connection=null;
        }// db_handler

        public function prepare($prepare)
        {
            $this->preparation = self::$connection->prepare($prepare);
        }// prepare : use with execute

        public function execute($spec)
        {
            $this->preparation->execute($spec);
        }// execute

        public function query ($query) {
            $answer = self::$connection->query($query);
            return $answer;
        }// query

        public function fetch($fetch_style, $cursor_orientation = \PDO::FETCH_ORI_NEXT,$cursor_offset = 0) {
            return $this->preparation->fetch($fetch_style,$cursor_orientation,$cursor_offset);
        }

        public function __destruct() {
        }// ~db_handler

        public function rowCount() {
            return $this->preparation->rowCount();
        }

        public function lastInsertId() {
            return self::$connection->lastinsertId();;
        }
    }
}
