<?php

namespace App\Controllers\Admin;

use App\Classes\ErrorsValidate;
use App\Classes\FlashMessage;
use App\Classes\MassFilter;
use App\Classes\PersistInput;
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

                $produtoModel = new ProdutoModel;
                if($produtoModel->create($filter->all())) {

                    FlashMessage::add('mensagem_produto', 'Produto cadastrado com sucesso!', 'success');
                    PersistInput::removeInputs();
                    
                    return Redirect::redirect('/adminProdutos/create');

                }

                FlashMessage::add('mensagem_produto', 'Erro ao cadastrar o produto!');
                    
                return Redirect::redirect('/adminProdutos/create');


            } else {
                return Redirect::redirect('/adminProdutos/create');
            }

        }

    }

    public function edit($args){

        $id = filter_var($args[0], FILTER_SANITIZE_NUMBER_INT);

        $categoriaModel = new CategoriaModel;
        $categoriasEncontradas = $categoriaModel->fetchAll();

        $marcaModel = new MarcaModel;
        $marcasEncontradas = $marcaModel->fetchAll();

        $produtoModel = new ProdutoModel;
        $produtoEncontrado = $produtoModel->find('id', $id);
        
        $dados = [
            'titulo' => 'Loja Virtual - RS-Dev | Painel Administrativo | Editar Produto',
            'categorias' => $categoriasEncontradas,
            'marcas' => $marcasEncontradas,
            'produto' => $produtoEncontrado
        ];

        $template = $this->twig->load('admin_form_editar_produto.html');
        echo $template->render($dados);

    }

    public function update($args){

        $id = filter_var($args[0], FILTER_SANITIZE_NUMBER_INT);

        $rules = [
            'produto_nome' => 'required',
            'produto_slug' => 'required',
            'produto_valor' => 'required',
            'produto_categoria' => 'required',
            'produto_marca' => 'required',
            'produto_garantia' => 'required',
            'produto_descricao' => 'required',
        ];

        $validate = new Validate($rules);
        $validate->validate();

        if(!ErrorsValidate::erroValidacao()) {

            $filter =new MassFilter;
            $filter->filterInputs(
                'produto_nome', 'produto_slug',
                'produto_valor', 'produto_categoria',
                'produto_marca', 'produto_garantia', 'produto_descricao'
            );

            $produtoModel = new ProdutoModel;
            $updated = $produtoModel->update($filter->all(), $id);

            if($updated) {

                FlashMessage::add('mensagem_produto', 'Atualizado com sucesso', 'success');
                return Redirect::back();

            }

            FlashMessage::add('mensagem_produto', 'Erro ao atualizar');
            return Redirect::back();

        }

        Redirect::back();


    }

    public function destroy($args){

        $id = filter_var($args[0], FILTER_SANITIZE_NUMBER_INT);

        $produtoModel = new ProdutoModel;
        $produtoEncontrado = $produtoModel->find('id', $id);

        @unlink($produtoEncontrado->produto_foto);
        $deletado = $produtoModel->delete('id', $id);

        if($deletado) {
            Redirect::redirect('/adminProdutos');
        }

    }

}
