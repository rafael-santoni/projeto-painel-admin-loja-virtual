<?php

namespace App\Classes;

class IdRandom {

    public static function generateId(){

        if(!isset($_SESSION['idSession'])) {
            $_SESSION['idSession'] = base64_encode(time().mt_rand(1,9999999999).md5(uniqid(rand(), true)));
        }

        return $_SESSION['idSession'];

    }

    public static function clear(){
        unset($_SESSION['idSession']);
    }

}
