<?php

namespace App\Controllers\Admin;

use App\Classes\ErrorsValidate;
use App\Classes\MassFilter;
use App\Classes\Redirect;
use App\Classes\RepeatedRegistersAdmin;
use App\Classes\Validate;
use App\Controllers\BaseController;
use App\Models\Admin\ProdutoModel;
use App\Models\Admin\CategoriaModel;
use App\Models\Admin\MarcaModel;

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

        $categoriaModel = new CategoriaModel;
        $categoriasEncontradas = $categoriaModel->fetchAll();

        $marcaModel = new MarcaModel;
        $marcasEncontradas = $marcaModel->fetchAll();

        $dados = [
            'titulo' => 'Loja Virtual - RS-Dev | Painel Administrativo | Cadastrar Produto',
            'categorias' => $categoriasEncontradas,
            'marcas' => $marcasEncontradas
        ];

        $template = $this->twig->load('admin_form_cadastrar_produto.html');
        echo $template->render($dados);

    }

    public function store(){

        if($_SERVER['REQUEST_METHOD'] == 'POST') {

            $rules = [
                'produto_nome' => 'required',
                'produto_slug' => 'required:produto',
                'produto_valor' => 'required',
                'produto_categoria' => 'required',
                'produto_marca' => 'required',
                'produto_garantia' => 'required',
                'produto_descricao' => 'required',
            ];

            $validate = new Validate($rules);
            $validate->validate()->repeatedRegisters(new RepeatedRegistersAdmin);

            if(!ErrorsValidate::erroValidacao()) {

                $filter =new MassFilter;
                $filter->filterInputs(
                    'produto_nome', 'produto_slug',
                    'produto_valor', 'produto_categoria',
                    'produto_marca', 'produto_garantia', 'produto_descricao'
                );

            } else {
                return Redirect::redirect('/adminProdutos/create');
            }

        }

    }

}
