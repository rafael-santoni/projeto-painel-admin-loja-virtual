<?php

namespace App\Controllers\Admin;

use App\Classes\ErrorsValidate;
use App\Classes\FlashMessage;
use App\Classes\Logar;
use App\Classes\MassFilter;
use App\Classes\Redirect;
use App\Classes\Validate;
use App\Controllers\BaseController;

class AdminLoginController extends BaseController {

    public function store()
    {

        $rules = [
            'email' => 'required|email',
            'password' => "required"
        ];

        $validate = new Validate($rules);
        $validate->validate();

        if(!ErrorsValidate::erroValidacao()) {

            $filter = new MassFilter;
            $filter->filterInputs('email', 'password');

            $logado = Logar::logarUser($filter->get('email'), $filter->get('password'));

            if(!$logado) {
                return Redirect::redirect('/painel');
            }

            FlashMessage::add('erro_login', 'Campos email e/ou senha inválidos, tente novamente.');
            Redirect::redirect('/admin');

        }

        FlashMessage::add('erro_login', 'Erro! Verifique os campos e tente novamente.');
        Redirect::redirect('/admin');

    }

}
