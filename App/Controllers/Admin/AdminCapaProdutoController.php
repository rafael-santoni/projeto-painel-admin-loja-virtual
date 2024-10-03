<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Admin\ProdutoModel;
use App\Repositories\Admin\ProdutosRepository;

class AdminCapaProdutoController extends BaseController {

    public function index($args){

        $id = filter_var($args[0], FILTER_SANITIZE_NUMBER_INT);

        $produtoModel = new ProdutoModel;
        $produtoEncontrado = $produtoModel->find('id', $id);

        $dados = [
            'titulo' => 'Loja Virtual - RS-Dev | Painel Administrativo | Alterar Capa do Produto',
            'produto' => $produtoEncontrado
        ];

        $template = $this->twig->load('admin_alterar_capa_produto.html');
        echo $template->render($dados);

    }

    public function store(){

        $id = filter_input(INPUT_POST, 'id_produto', FILTER_SANITIZE_NUMBER_INT);

        $foto = $_FILES['file']['name'];
        $temp = $_FILES['file']['tmp_name'];

        $produtoModel = new ProdutoModel;
        $produtoEncontrado = $produtoModel->find('id', $id);

        // $pasta = 'assets/images/produtos';
        $pasta = 'assets/images/produtos/';

        // @unlink($pasta.DIRECTORY_SEPARATOR.$produtoEncontrado->produto_foto);
        @unlink($produtoEncontrado->produto_foto);

        // $updated = move_uploaded_file($temp, $pasta.DIRECTORY_SEPARATOR.$foto);
        $updated = move_uploaded_file($temp, $pasta.$foto);

        $produtosRepository = new ProdutosRepository;
        // $produtosRepository->atualizarCapa($pasta.DIRECTORY_SEPARATOR.$foto, $id);
        $produtosRepository->atualizarCapa($pasta.$foto, $id);
// 

        if($updated) {
            echo 'updated';
        }

    }

}
