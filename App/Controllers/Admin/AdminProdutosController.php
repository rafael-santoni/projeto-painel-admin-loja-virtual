<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Admin\ProdutoModel;

class AdminProdutosController extends BaseController {

    public function index(){

        $produtosModel = new ProdutoModel;
        $produtosEncontrados = $produtosModel->fetchAll();

        $dados = [
            'titulo' => 'Loja Virtual - RS-Dev | Painel Administrativo | Lista de Produtos',
            'produtos' => $produtosEncontrados
        ];

        $template = $this->twig->load('admin_listar_produtos.html');
        echo $template->render($dados);

    }

    public function create(){

        $dados = [
            'titulo' => 'Loja Virtual - RS-Dev | Painel Administrativo | Cadastrar Produto',
        ];

        $template = $this->twig->load('admin_form_cadastrar_produto.html');
        echo $template->render($dados);

    }

}
