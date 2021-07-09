<?php
namespace App\Controllers;

use App\Models\Basket;
use App\Models\Product;

class IndexController
{
    function __construct() {
        
    }

    function index() {

        $product = new Product();
        $products = $product->getAll();

        view('index',array('products'=>$products));
    }
}
