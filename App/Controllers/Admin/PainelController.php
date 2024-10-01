<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class PainelController extends BaseController {

    public function index(){

        $dados = [
            'titulo' => 'Loja Virtual - RS-Dev | Painel Administrativo'
        ];

        $template = $this->twig->load('admin_home.html');
        echo $template->render($dados);
        
    }

}
