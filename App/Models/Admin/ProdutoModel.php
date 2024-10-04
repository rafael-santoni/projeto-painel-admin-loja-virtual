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

    public function update(array $attributes, $id){

        $sql = "UPDATE {$this->table} 
                SET produto_nome = :produto_nome, 
                produto_slug = :produto_slug, 
                produto_valor = :produto_valor, 
                produto_categoria = :produto_categoria, 
                produto_marca = :produto_marca, 
                produto_garantia = :produto_garantia, 
                produto_descricao = :produto_descricao 
                WHERE id = :id";

        $this->typeDatabase->prepare($sql);

        foreach ($attributes as $key => $attribute) {
            $this->typeDatabase->bindValue(":{$key}", $attribute);
        }

        $this->typeDatabase->bindValue(":id", $id);
        
        return $this->typeDatabase->execute();

    }

}
