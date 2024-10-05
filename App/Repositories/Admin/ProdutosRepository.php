<?php

namespace App\Repositories\Admin;

use App\Models\Admin\ProdutoModel;
use App\Repositories\Repository;

class ProdutosRepository extends Repository {

    protected $model;
    public $sql;

    public function __construct(){
        $this->model = new ProdutoModel;
    }

    public function listar(){

        $this->sql = "SELECT * FROM {$this->model->table}";
        return $this;

    }

    public function atualizarCapa($capa, $id){

        $sql = "UPDATE {$this->model->table} SET produto_foto = ? WHERE id = ?";
        $this->model->typeDatabase->prepare($sql);
        $this->model->typeDatabase->bindValue(1, $capa);
        $this->model->typeDatabase->bindValue(2, $id);

        return $this->model->typeDatabase->execute();
        
    }

    public function updateValorPromocao($id, $valor){

        $sql = "UPDATE {$this->model->table} SET produto_valor_promocao = ? WHERE id = ?";
        $this->model->typeDatabase->prepare($sql);
        $this->model->typeDatabase->bindValue(1, $valor);
        $this->model->typeDatabase->bindValue(2, $id);

        return $this->model->typeDatabase->execute();
        
    }

    public function updatePromocao($id, $status){

        $sql = "UPDATE {$this->model->table} SET produto_promocao = ? WHERE id = ?";
        $this->model->typeDatabase->prepare($sql);
        $this->model->typeDatabase->bindValue(1, $status);
        $this->model->typeDatabase->bindValue(2, $id);

        return $this->model->typeDatabase->execute();
        
    }

    public function updatePresente($id, $status){

        $sql = "UPDATE {$this->model->table} SET produto_presente = ? WHERE id = ?";
        $this->model->typeDatabase->prepare($sql);
        $this->model->typeDatabase->bindValue(1, $status);
        $this->model->typeDatabase->bindValue(2, $id);

        return $this->model->typeDatabase->execute();
        
    }

    public function updateDestaque($id, $status){

        $sql = "UPDATE {$this->model->table} SET produto_destaque = ? WHERE id = ?";
        $this->model->typeDatabase->prepare($sql);
        $this->model->typeDatabase->bindValue(1, $status);
        $this->model->typeDatabase->bindValue(2, $id);

        return $this->model->typeDatabase->execute();
        
    }

}
