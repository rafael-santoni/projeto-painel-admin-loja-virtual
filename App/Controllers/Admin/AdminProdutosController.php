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
use App\Repositories\Admin\ProdutosRepository;

class AdminProdutosController extends BaseController {

    public function index(){

        $produtosRepository = new ProdutosRepository;
        
        if(isset($_GET['s'])) {
            $produtosEncontrados = $produtosRepository->listar()->busca(['produto_nome'])->paginate(2)->get();
        } else {
            // $produtosEncontrados = $produtosRepository->select('*')->paginate(2)->get();
            $produtosEncontrados = $produtosRepository->listar()->paginate(2)->get();
        }

        $dados = [
            'titulo' => 'Loja Virtual - RS-Dev | Painel Administrativo | Lista de Produtos',
            'produtos' => $produtosEncontrados,
            'links' => $produtosRepository->links()
        ];

        // $template = $this->twig->load('admin_listar_produtos.html');
        // echo $template->render($dados);
        $this->view($dados, 'admin_listar_produtos');

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

        // $template = $this->twig->load('admin_form_cadastrar_produto.html');
        // echo $template->render($dados);
        $this->view($dados, 'admin_form_cadastrar_produto');

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

            // $validate = new Validate($rules);
            $validate = $this->load(Validate::class, $rules);
            $validate->validate()->repeatedRegisters(new RepeatedRegistersAdmin);

            // if(!ErrorsValidate::erroValidacao()) {
            if(!$this->get('error')->erroValidacao()) {

                /* $filter =new MassFilter;
                $filter->filterInputs(
                    'produto_nome', 'produto_slug',
                    'produto_valor', 'produto_categoria',
                    'produto_marca', 'produto_garantia', 'produto_descricao'
                ); */
                
                $filter = $this->get('filters')->filterInputs(
                                                    'produto_nome', 'produto_slug',
                                                    'produto_valor', 'produto_categoria',
                                                    'produto_marca', 'produto_garantia', 'produto_descricao'
                                                );

                // $produtoModel = new ProdutoModel;
                $produtoModel = $this->load(ProdutoModel::class);
                if($produtoModel->create($filter->all())) {

                    /* FlashMessage::add('mensagem_produto', 'Produto cadastrado com sucesso!', 'success');
                    PersistInput::removeInputs();
                    
                    return Redirect::redirect('/adminProdutos/create'); */

                    $this->get('flash')->add('mensagem_produto', 'Produto cadastrado com sucesso!', 'success');
                    $this->get('persist')->removeInputs();

                    return $this->get('redirect')->redirect('/adminProdutos/create');

                }

                /* FlashMessage::add('mensagem_produto', 'Erro ao cadastrar o produto!');
                    
                return Redirect::redirect('/adminProdutos/create'); */

                $this->get('flash')->add('mensagem_produto', 'Erro ao cadastrar o produto!');

                return $this->get('redirect')->redirect('/adminProdutos/create');

            }

            // return Redirect::redirect('/adminProdutos/create');
            return $this->get('redirect')->redirect('/adminProdutos/create');

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

        // $template = $this->twig->load('admin_form_editar_produto.html');
        // echo $template->render($dados);
        $this->view($dados, 'admin_form_editar_produto');

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
