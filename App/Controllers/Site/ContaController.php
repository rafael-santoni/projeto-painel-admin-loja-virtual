<?php

namespace App\Controllers\Site;

use App\Controllers\BaseController;
use App\Classes\Redirect;
use App\Classes\Logado;
use App\Models\Site\UserModel;

class ContaController extends BaseController {

    public function index(){

        $logado = new Logado;
        $redirect = new Redirect;

        if(!$logado->logado()) {
            $redirect->redirect('/');
        }
        $userModel = new UserModel;
        $dadosUser = $userModel->find('id', $_SESSION['id']);

        $dados = [
            'titulo' => 'Loja Virtual - RS-Dev | Conta do usuário',
            'user' => $dadosUser
        ];

        $template = $this->twig->load('site_conta.html');
        echo $template->render($dados);

    }

}
