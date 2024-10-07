<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class AdminCategoriasController extends BaseController {

    public function index(){

        $categoriasRepository = $this->load(CategoriasRepository::class);

        if(isset($_GET['s'])) {

        } else {
            $categoriasEncontradas = $categoriasRepository->select('*')->paginate(15)->get();
        }

        $dados =[
            'title' => 'Loja Virtual - RS-Dev | Painel Administrativo | Lista de Categorias'
        ];

        $this->view($dados, 'admin_listar_categorias');

    }

}
