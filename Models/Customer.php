<?php


namespace App\Models;

use App\Interfaces\ICustomer;
use Firebase\JWT\JWT;

class Customer implements ICustomer
{
    public $id;
    public $name;
    public $surname;
    public $email;
    public $password;
    static $secretKey = "*abdurrahimbulut*";



    function __construct() {
    }

    public function getById()
    {        
        $db =  \App\Models\Database::getInstance();
        $query = $db->prepare("SELECT * FROM customer WHERE id=?");
        $query->execute(array($this->id)); 
        return $query->fetch(\PDO::FETCH_ASSOC);
    }

    public function getAll()
    {
        $db =  \App\Models\Database::getInstance();
        $query = $db->prepare("SELECT * FROM customer ");
        $query->execute(array()); 
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

    
    public function authentication()
    {
        $db =  \App\Models\Database::getInstance();
        $query = $db->prepare("SELECT * FROM customer WHERE email= ? AND password=? ");
        $query->execute(array($this->email,md5($this->password)));
        $customer = $query->fetch(\PDO::FETCH_ASSOC);
        if (is_array($customer) && count($customer)>0) {
            $payload = array(
                "id" => $customer['id'],
                "name" => $customer['name'],
                "surname" => $customer['surname'],
                "email" => $customer['email'],
            );
            $jwt = JWT::encode($payload, self::$secretKey);
            if (setcookie("jwt_token", $jwt, time()+3600*3) && strlen($jwt)>0) {
                
                if (isset($_COOKIE['basket'])) {
                    //eğer giriş yapmadan önce sepete ürün eklemişse veri tabanına ekle
                    $basket = json_decode($_COOKIE['basket'], true);
                    $basketObj = new Basket();
                    foreach ($basket as $productId => $quantity) {
                        $basketObj->customerId = $customer['id'];
                        $basketObj->productId = $productId;
                        $basketObj->quantity = $quantity;
                        $basketObj->add();
                    }
                    setcookie("basket", '');
                }
                return true;
            }else {
                return false;
            }
        }else {
            setcookie("jwt_token", '');
            return false;
        }
    }

    public static function authorization()
    {
        if ( isset($_COOKIE['jwt_token']) && strlen($_COOKIE['jwt_token'])>0) {
            try {
                return json_decode(json_encode(JWT::decode($_COOKIE['jwt_token'], self::$secretKey, array('HS256'))),true);
            } catch (\Throwable $th) {
                return false;
            }
        }else{
            return false;
        }
    }

    public static function logout()
    {
        if (setcookie("jwt_token", '')) {
            return true;
        }else{
            return false;
        };
    }
    public  function register()
    {    
        $db =  \App\Models\Database::getInstance();
        $query = $db->prepare("INSERT INTO customer SET email=?,name=?,surname=?,password=? ");
        $register =  $query->execute(array(
            $this->email,
            $this->name,
            $this->surname,
            md5($this->password)
        ));
        if ($register) {
            return $this->authentication();
        }else {
            return false;
        }

    }

}
