<?php

namespace App\Models\Admin;

use App\Models\Model;

class UserModel extends Model {

    public $table = 'users';

    public function update(array $attributes, $id){

        $sql = "UPDATE {$this->table} 
                SET name = :name, 
                sobrenome = :sobrenome, 
                email = :email, 
                endereco = :endereco, 
                bairro = :bairro, 
                cidade = :cidade, 
                estado = :estado, 
                cep = :cep, 
                ddd = :ddd, 
                telefone = :telefone
                WHERE id = :id";

        $this->typeDatabase->prepare($sql);

        foreach ($attributes as $key => $attribute) {
            $this->typeDatabase->bindValue(":{$key}", $attribute);
        }
        
        $this->typeDatabase->bindValue(':id', $id);
        $this->typeDatabase->execute();

        return $this->typeDatabase->rowCount();

    }

}
