<?php

namespace App\Interfaces;

interface IModel{
    public function getById();
    public function getAll();
    public function add();
    public function removeById();
    public function updateById();
}