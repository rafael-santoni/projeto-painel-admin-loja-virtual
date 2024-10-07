<?php

namespace App\Classes\Forms\Admin;

use App\Models\Admin\UserModel;
use App\Classes\Forms\Admin\Form;

class Clientes extends Form {

    protected $rules = [
        'name' => 'required',
        'sobrenome' => 'required',
        'email' => 'required',
        'endereco' => 'required',
        'bairro' => 'required',
        'cidade' => 'required',
        'estado' => 'required',
        'cep' => 'required',
        'ddd' => 'required',
        'telefone' => 'required',
    ];

    public function update($id){

        if(!$this->validateWithoutRepeat($this->rules)){

            $filter = $this->get('filters')->filterInputs(
                                                'name','sobrenome','email',
                                                'endereco','bairro','cidade',
                                                'estado','cep','ddd','telefone'
                                            );

            $updated = $this->load(UserModel::class)->update($filter->all(), $id);

            if($updated) {

                $this->get('flash')->add('mensagem_update_cliente', 'Cliente atualizado com sucesso!', 'success');
                $this->get('persist')->removeInputs();

                return $this->get('redirect')->back();

            }

            $this->get('flash')->add('mensagem_update_cliente', 'Erro ao atualizar o cliente!');

            return $this->get('redirect')->back();

        }
        
    }

}
