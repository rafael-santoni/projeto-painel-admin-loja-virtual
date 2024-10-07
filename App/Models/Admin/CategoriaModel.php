<?php

namespace App\Models\Admin;

use App\Models\Model;

class CategoriaModel extends Model {

    public $table = 'categorias';

    public function create(array $attributes){

        $sql = "INSERT INTO {$this->table} 
                (categoria_nome, categoria_slug)
                VALUES (:categoria_nome,:categoria_slug)";
        
        $this->typeDatabase->prepare($sql);

        foreach ($attributes as $field => $value) {
            $this->typeDatabase->bindValue(":{$field}", $value);
        }

        return $this->typeDatabase->execute();
        
    }

}
