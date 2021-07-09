<?php

namespace App\Interfaces;

interface IBasket extends IModel{
    public function updateQuantityById();
    public function getProductByCustomerId();
    public function getProductsByCustomerId();
}