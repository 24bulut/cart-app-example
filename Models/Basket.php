<?php

namespace App\Models;

use App\Interfaces\IBasket;

class Basket implements IBasket
{
    public $id;
    public $productId;
    public $customerId;
    public $quantity;

    function __construct() {
    }

    public function getById(){
        $db =  \App\Models\Database::getInstance();
        $query = $db->prepare("SELECT * FROM basket WHERE id=?");
        $query->execute(array($this->id)); 
        return $query->fetch(\PDO::FETCH_ASSOC);
    }
    public function getAll(){
        $db =  \App\Models\Database::getInstance();
        $query = $db->prepare("SELECT * FROM basket");
        $query->execute(); 
        return $query->fetchAll(\PDO::FETCH_ASSOC);
    }

  
    public function add(){
        if (!Customer::authorization() && $this->customerId==NULL) {
            if (isset($_COOKIE['basket'])) {
                $basket = json_decode($_COOKIE['basket'],true);
                $basket[$this->productId]=$this->quantity;
                setcookie("basket",json_encode($basket));
            }else {
                setcookie("basket",json_encode(array(
                    $this->productId=>$this->quantity
                )));
            }
            return true;
        }

        $this->customerId= $this->customerId == NULL ? Customer::authorization()['id'] :$this->customerId ;
        
        $db =  \App\Models\Database::getInstance();
        $query = $db->prepare("SELECT * FROM product WHERE id=? AND stock>=?");
        $query->execute(array($this->productId,$this->quantity)); 
        $product =  $query->fetch(\PDO::FETCH_ASSOC);

        if (is_array($product) && count($product)>0) {
            $productByCustomerId = $this->getProductByCustomerId();
            if (is_array($productByCustomerId) && count($productByCustomerId)>0) {
                $this->id = $productByCustomerId['id'];
                return $this->updateQuantityById();
            }else{
                $db =  \App\Models\Database::getInstance();
                $query = $db->prepare("INSERT INTO basket SET product_id=?,customer_id=?,quantity=? ");
                return $query->execute(array(
                    $this->productId,
                    $this->customerId,
                    $this->quantity
                ));
            }
        }else {
            return false;
        }
    }
    public function removeById(){
        $db =  \App\Models\Database::getInstance();
        $query = $db->prepare("DELETE FROM basket WHERE id=? ");
        return $query->execute(array(
            $this->id
        ));
    }
    public function updateById(){
        return 0;
    }

    public function updateQuantityById(){
        $db =  \App\Models\Database::getInstance();
        $query = $db->prepare("UPDATE basket SET quantity=? WHERE id=?");
        return $query->execute(array(
            $this->quantity,
            $this->id
        ));
    }
    public function getProductByCustomerId(){
        $db =  \App\Models\Database::getInstance();
        $query = $db->prepare("SELECT * FROM basket WHERE product_id=? AND customer_id=?");
        $query->execute(array(
            $this->productId,
            $this->customerId
        ));
        return $query->fetch(\PDO::FETCH_ASSOC);
    }

    public function getProductsByCustomerId(){
        
        $db =  \App\Models\Database::getInstance();
        $query = $db->prepare("SELECT *, basket.id as basket_id FROM basket INNER JOIN product ON product.id=basket.product_id WHERE customer_id=?");
        $query->execute(array(
            $this->customerId
        ));
        return $query->fetchAll(\PDO::FETCH_ASSOC);
    }
}
