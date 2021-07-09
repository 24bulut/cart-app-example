<?php


namespace App\Models;


use App\Interfaces\IModel;

class Product implements IModel
{

    public $id;
    public $name;
    public $stock;
    public $price;
    
    function __construct() {
    }

    public function getById(){
        $db =  \App\Models\Database::getInstance();
        $query = $db->prepare("SELECT * FROM product WHERE id=?");
        $query->execute(array($this->id)); 
        return $query->fetch(\PDO::FETCH_ASSOC);
    }
    public function getAll(){
        $db =  \App\Models\Database::getInstance();
        $query = $db->prepare("SELECT * FROM product WHERE stock>0");
        $query->execute(); 
        return $query->fetchAll(\PDO::FETCH_ASSOC);
    }
    public function add(){
        return 0;
    }
    public function removeById(){
        return 0;
    }
    public function updateById(){
        return 0;
    }
}
