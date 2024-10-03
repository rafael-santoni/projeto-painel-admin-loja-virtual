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

}
