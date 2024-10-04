<?php

namespace App\Controllers\Admin;

use App\Models\Admin\ProdutoModel;
use App\Controllers\BaseController;
use App\Repositories\Admin\ProdutosRepository;

class AdminProdutosPromocaoController extends BaseController {

    public function index(){

        $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
        $valor = filter_input(INPUT_POST, 'valor', FILTER_SANITIZE_STRING);

        $produtoModel = new ProdutoModel;
        $produtoEncontrado = $produtoModel->find('id', $id);

        $produtosRepository = new ProdutosRepository;

        if($produtoEncontrado->produto_promocao == 1) {
            // $produtosRepository->updatePromocao($id, 2);
        }
        
        if ($produtoEncontrado->produto_promocao == 2) {

            $produtosRepository->updatePromocao($id, 1);
            $produtosRepository->updateValorPromocao($id, $valor);
            
        }

        echo 'updated';

    }

}
