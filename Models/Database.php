<?php


namespace App\Models;


class Database 
{
    protected static $instance;
    private  $host;
    private  $username;
    private  $password;
    private  $db;

    private function connect() {
        $this->host = 'localhost';
        $this->username = 'root';
        $this->password = '';
        $this->db = 'basket_example';
        try {
            $db = new \PDO('mysql:host='. $this->host .';dbname='.$this->db , $this->username, $this->password);
            $db->exec("set names utf8");
            return $db;
        } catch (\PDOException $e) {
            throw new \Exception("Veri tabanı hatası!: " . $e->getMessage());
            die();
        }
    }

    public  static function getInstance(){
        if (!isset(self::$instance)) {
            self::$instance = new static();
            return self::$instance->connect();
        }else{
            return self::$instance->connect();
        }
    }
}
