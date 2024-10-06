<?php

namespace App\Classes;

use App\Classes\Redirect;
use App\Classes\SendEmail;
use App\Classes\MassFilter;
use App\Classes\FlashMessage;
use App\Classes\PersistInput;
use App\Classes\ErrorsValidate;

abstract class Container {

    private $container = [];

    private $classes = [
        'redirect' => Redirect::class,
        'flash' => FlashMessage::class,
        'filters' => MassFilter::class,
        'email' => SendEmail::class,
        'persist' => PersistInput::class,
        'error' => ErrorsValidate::class
    ];

    public function __construct(){

        foreach ($this->classes as $index => $class) {

            if(!isset($this->container[$index])) {
                $this->container[$index] = new $class;
            }

        }

    }

    public function __get($index){

        if(!property_exists($this, $index)) {
            return $this->get($index);
        }

    }

    public function get($index){

        if(!isset($this->container[$index])){
            throw new \Exception("Esse serviço não existe no container {$index}");
        }

        return $this->container[$index];

    }

    public function load($class, $construct=null){

        if(!class_exists($class)) {
            throw new \Exception("Essa classe não existe {$class}");
        }

        return ($construct == null) ? new $class : new $class($construct);

    }

}
