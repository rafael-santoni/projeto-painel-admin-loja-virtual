<?php

namespace App\Controllers\Admin;

use App\Models\Admin\PedidosModel;
use App\Models\Admin\PedidosProdutosModel;
use App\Models\Admin\ProdutoModel;
use App\Controllers\BaseController;

class AdminPedidosProdutosController extends BaseController {

    public function index(){

        $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);

        $pedidosModel = new PedidosModel;
        $pedidoEncontrado = $pedidosModel->find('id', $id)->sessao;

        $pedidosProdutosModel = new PedidosProdutosModel;
        $produtosEncontrados = $pedidosProdutosModel->find('sessao', $pedidoEncontrado,'all');

        $produtoModel = new ProdutoModel;

        $produtos['produtos'] = [];
        $produtos['quantidade'] = [];

        foreach ($produtosEncontrados as $produto) {

            $produtosEncontradosPedido = $produtoModel->find('id', $produto->produto);
            array_push($produtos['produtos'], $produtosEncontradosPedido);

            $produtos['quantidade'][$produtosEncontradosPedido->id] = $produto->quantidade;

        }

        echo json_encode($produtos);
        
    }

}
