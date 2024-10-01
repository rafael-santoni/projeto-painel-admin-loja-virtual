<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class AdminController extends BaseController {

    public function index()
    {
        $dados = [
            'titulo' => 'Loja Virtual - RS-Dev | Login do Administrador'
        ];

        $template = $this->twig->load("admin_login.html");
        echo $template->render($dados);
    }
    
}
