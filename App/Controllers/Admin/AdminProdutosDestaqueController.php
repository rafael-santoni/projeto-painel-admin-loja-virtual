<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Admin\ProdutoModel;
use App\Repositories\Admin\ProdutosRepository;

class AdminProdutosDestaqueController extends BaseController {

    public function index(){

        $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);

        $produtoModel = new ProdutoModel;
        $produtoEncontrado = $produtoModel->find('id', $id);

        $produtosRepository = new ProdutosRepository;

        $status = ($produtoEncontrado->produto_destaque == 1) ? 2 : 1;

        $updated = $produtosRepository->updateDestaque($id, $status);

        if($updated) {
            echo 'updated';
        }

    }

}
