<?php

namespace App\Models\Admin;

use App\Models\Model;

class ProdutoModel extends Model{

    public $table = 'produtos';

    public function create(array $attributes){

        $sql = "INSERT INTO {$this->table} 
                (produto_nome, produto_slug, produto_valor, produto_categoria, produto_marca, produto_garantia, produto_descricao) 
                VALUES (?,?,?,?,?,?,?)";

        $this->typeDatabase->prepare($sql);

        $i = 1;
        foreach ($attributes as $attribute) {
            $this->typeDatabase->bindValue($i, $attribute);
            $i++;
        }
        
        return $this->typeDatabase->execute();

    }

}
