<?php

namespace App\Classes\Forms\Admin;

use App\Models\Admin\ProdutoModel;

class Produtos extends Form {

    private $rules = [
        'produto_nome' => 'required',
        'produto_slug' => 'required:'.ProdutoModel::class,
        'produto_valor' => 'required',
        'produto_categoria' => 'required',
        'produto_marca' => 'required',
        'produto_garantia' => 'required',
        'produto_descricao' => 'required',
    ];

    public function store(){

        // $validate = $this->load(Validate::class, $this->rulesStore);
        // $validate->validate()->repeatedRegisters(new RepeatedRegistersAdmin);

        // if(!$this->get('error')->erroValidacao()) {
        if(!$this->validateWithRepeat()) {
            
            $filter = $this->get('filters')->filterInputs(
                                                'produto_nome', 'produto_slug',
                                                'produto_valor', 'produto_categoria',
                                                'produto_marca', 'produto_garantia', 'produto_descricao'
                                            );

            $produtoModel = $this->load(ProdutoModel::class);
            if($produtoModel->create($filter->all())) {

                $this->get('flash')->add('mensagem_produto', 'Produto cadastrado com sucesso!', 'success');
                $this->get('persist')->removeInputs();

                return $this->get('redirect')->redirect('/adminProdutos/create');

            }

            $this->get('flash')->add('mensagem_produto', 'Erro ao cadastrar o produto!');

            return $this->get('redirect')->redirect('/adminProdutos/create');

        }

        return $this->get('redirect')->redirect('/adminProdutos/create');

    }

}
