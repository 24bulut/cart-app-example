<?php
namespace App\Controllers;

use App\Models\Customer;

class BasketController
{
    function __construct() {
    }

    public function index()
    {
        if (Customer::authorization()) {
            $basket = new \App\Models\Basket();
            $basket->customerId = Customer::authorization()['id'];
            $products = $basket->getProductsByCustomerId();
        }else {
            $products=array();
        }
        \view('basket',array(
            'products'=>$products
        ));
    }

    public function addItem()
    {
        $basket = new \App\Models\Basket();
        $basket->productId = $_POST['product_id'];
        $basket->quantity = $_POST['quantity'];
        if (!$basket->add()) {
            response(array(
                'result'=>false,
                'message'=>'Bir hata oluştu'
            ));
        }else {
            response(array(
                'result'=>true,
                'message'=>'Ürün sepete eklendi'
            ));
        }
    }
    
    public function removeItem()
    {
        $basket = new \App\Models\Basket();
        $basket->id = $_POST['product_id'];
        return $basket->removeById();
    }


    public function updateQuantity($id)
    {
        $basket = new \App\Models\Basket();
        $basket->id = $id;
        $basket->quantity = $_POST['quantity'];
        if ($_POST['quantity']<=0) {
            if ($basket->removeById()) {
                response(array(
                    'result'=>true,
                    'message'=>'Ürün sepetten silindi'
                ));
            }else {
                response(array(
                    'result'=>false,
                    'message'=>'Bir hata oluştu'
                ));
            }
        }else {
            
            if ($basket->updateQuantityById()) {
                response(array(
                    'result'=>true,
                    'message'=>'Ürün adedi güncellendi'
                ));
            }else {
                response(array(
                    'result'=>false,
                    'message'=>'Bir hata oluştu'
                ));
            }
        }
    }
}