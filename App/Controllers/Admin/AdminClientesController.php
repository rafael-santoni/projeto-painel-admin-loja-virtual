<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Repositories\Admin\ClientesRepository;

class AdminClientesController extends BaseController {

    public function index(){

        $clientesRepository = new ClientesRepository;
        if(isset($_GET['s'])) {
            $clientesEncontrados = $clientesRepository->select('*')->busca(['name'])->paginate(15)->get();
        } else {
            $clientesEncontrados = $clientesRepository->select('*')->paginate(15)->get();
        }

        $dados = [
            'title' => 'Loja Virtual - RS-Dev | Painel Administrativo | Lista de Clientes',
            'clientes' => $clientesEncontrados,
            'links' => $clientesRepository->links()
        ];

        $this->view($dados, 'admin_listar_clientes');

    }

}
