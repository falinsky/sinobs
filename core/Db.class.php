<?php

class Db
{
    private static $_instance = null;
    private $_dsn;
    private $_user;
    private $_pass;
    private $_connection;

    private function __construct(){
        try {
            $this->_dsn = "mysql:host=".DB_HOST.";dbname=".DB_NAME;
            $this->_user = DB_USER;
            $this->_pass = DB_PASS;
            $this->_connection = new PDO($this->_dsn,$this->_user,$this->_pass);
            $this->_connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch(PDOException $e){
            die("Something is wrong: ".$e->getMessage());
        }
    }

    private function __clone(){}

    private function __wakeup(){}

    public static function getInstance(){
        if(is_null(self::$_instance)){
            self::$_instance = new Db();
        }
        return self::$_instance;
    }

    public function __call($method,$arguments){
        return call_user_func_array(array($this->_connection,$method),$arguments);
    }

}
