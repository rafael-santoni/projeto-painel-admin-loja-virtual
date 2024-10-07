<?php

namespace App\Classes\Forms\Admin;

use App\Classes\Forms\Admin\Form;
use App\Models\Admin\CategoriaModel;

class Categorias extends Form {

    protected $rules = [
        'categoria_nome' => 'required',
        'categoria_slug' => 'required:'.CategoriaModel::class
    ];

    public function store(){

        if(!$this->validateWithRepeat($this->rules)) {

            $filter = $this->get('filters')->filterInputs('categoria_nome','categoria_slug');

            $cadastrado = $this->load(CategoriaModel::class)->create($filter->all());

            if($cadastrado) {
                $this->get('flash')->add('mensagem_cadastrar_categoria', 'Categoria cadastrada com sucesso!', 'success');
                $this->get('persist')->removeInputs();

                return $this->get('redirect')->back();
            }

            $this->get('flash')->add('mensagem_cadastrar_categoria', 'Erro ao cadastrar a categoria!');

            return $this->get('redirect')->back();

        }

    }

}
