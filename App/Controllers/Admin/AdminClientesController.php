<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class AdminClientesController extends BaseController {

    public function index(){

        $dados = [
            'title' => 'Loja Virtual - RS-Dev | Painel Administrativo | Lista de Clientes'
        ];

        $this->view($dados, 'admin_listar_clientes');

    }

}
