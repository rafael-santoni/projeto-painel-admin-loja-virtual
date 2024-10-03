<?php

namespace App\Repositories\Admin;

use App\Models\Admin\PedidosProdutosModel;

class PedidosProdutosRepository {

    private $pedidosProdutosModel;

    public function __construct(){
        $this->pedidosProdutosModel = new PedidosProdutosModel;
    }

    public function listaVendas($limite=null){

        $limit = !is_null($limite) ? 'limit '.$limite : '';

        $sql = "SELECT produto_nome, name, valor, produto_valor, quantidade, pedidos_produtos.id as idPedido, produtos.id as idProduto 
                FROM {$this->pedidosProdutosModel->table} 
                INNER JOIN produtos ON produtos.id = pedidos_produtos.produto 
                INNER JOIN users ON users.id = pedidos_produtos.user 
                ORDER BY idPedido DESC {$limit}";

        $this->pedidosProdutosModel->typeDatabase->prepare($sql);
        $this->pedidosProdutosModel->typeDatabase->execute();
        
        return $this->pedidosProdutosModel->typeDatabase->fetchAll();

    }

}
