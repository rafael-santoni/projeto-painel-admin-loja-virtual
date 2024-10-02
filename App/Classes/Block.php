<?php

namespace App\Classes;

use App\Classes\Uri;
use App\Classes\Logado;

class Block {

    public function blockNotAdmin($object) {

        $reflection = new \ReflectionClass($object);
        $namespace = $reflection->getNamespaceName();

        $uri = (new Uri)->getUri();

        if($namespace == 'App\Controllers\Admin' && $uri != '/admin') {
            Logado::adminLogado();
        }
        
    }

}
