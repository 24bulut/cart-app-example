<?php
namespace App\Controllers;

use App\Models\Customer;

class AuthController
{
    function __construct() {
    }

    public function loginForm()
    {
        if (Customer::authorization()) {
            header('Location:'.url(''));
            exit;
        }
        \view('login');
    }
    public function login()
    {
        if (Customer::authorization()) {
            header('Location:'.url(''));
            exit;
        }
        $customer = new Customer();
        $customer->email = $_POST['email'];
        $customer->password = $_POST['password'];
        if (!$customer->authentication()) {
            view('login',array('messages' =>array(
                'Bilgileriniz hatalı !'
            )));
        }else {
            header('Location:'.url(''));
        };

    }
    public function register()
    {
        if (Customer::authorization()) {
            header('Location:'.url(''));
            exit;
        }
        $customer = new Customer();
        $customer->email = $_POST['email'];
        $customer->password = $_POST['password'];
        $customer->surname = $_POST['surname'];
        $customer->name = $_POST['name'];

        if (!$customer->register()) {
            view('register',array('messages' =>array(
                'Bilgileriniz hatalı !'
            )));
        }else {
            header('Location:'.url(''));
        };
    }

    public function registerForm()
    {
        if (Customer::authorization()) {
            header('Location:'.url(''));
            exit;
        }
        \view('register');
    }

    public function logout()
    {
        Customer::Logout();
        header('Location:'.url(''));
    }

}
