<?php

namespace App\Repositories\Admin;

use App\Models\Admin\ProdutoModel;

class ProdutosRepository {

    private $produtoModel;

    public function __construct(){
        $this->produtoModel = new ProdutoModel;
    }

    public function atualizarCapa($capa, $id){

        $sql = "UPDATE {$this->produtoModel->table} SET produto_foto = ? WHERE id = ?";
        $this->produtoModel->typeDatabase->prepare($sql);
        $this->produtoModel->typeDatabase->bindValue(1, $capa);
        $this->produtoModel->typeDatabase->bindValue(2, $id);

        return $this->produtoModel->typeDatabase->execute();
        
    }

    public function updateValorPromocao($id, $valor){

        $sql = "UPDATE {$this->produtoModel->table} SET produto_valor_promocao = ? WHERE id = ?";
        $this->produtoModel->typeDatabase->prepare($sql);
        $this->produtoModel->typeDatabase->bindValue(1, $valor);
        $this->produtoModel->typeDatabase->bindValue(2, $id);

        return $this->produtoModel->typeDatabase->execute();
        
    }

    public function updatePromocao($id, $status){

        $sql = "UPDATE {$this->produtoModel->table} SET produto_promocao = ? WHERE id = ?";
        $this->produtoModel->typeDatabase->prepare($sql);
        $this->produtoModel->typeDatabase->bindValue(1, $status);
        $this->produtoModel->typeDatabase->bindValue(2, $id);

        return $this->produtoModel->typeDatabase->execute();
        
    }

    public function updatePresente($id, $status){

        $sql = "UPDATE {$this->produtoModel->table} SET produto_presente = ? WHERE id = ?";
        $this->produtoModel->typeDatabase->prepare($sql);
        $this->produtoModel->typeDatabase->bindValue(1, $status);
        $this->produtoModel->typeDatabase->bindValue(2, $id);

        return $this->produtoModel->typeDatabase->execute();
        
    }

    public function updateDestaque($id, $status){

        $sql = "UPDATE {$this->produtoModel->table} SET produto_destaque = ? WHERE id = ?";
        $this->produtoModel->typeDatabase->prepare($sql);
        $this->produtoModel->typeDatabase->bindValue(1, $status);
        $this->produtoModel->typeDatabase->bindValue(2, $id);

        return $this->produtoModel->typeDatabase->execute();
        
    }

}
