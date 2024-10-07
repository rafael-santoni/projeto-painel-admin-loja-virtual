<?php

namespace App\Controllers\Admin;

use App\Classes\Forms\Admin\Categorias;
use App\Controllers\BaseController;
use App\Repositories\Admin\CategoriasRepository;

class AdminCategoriasController extends BaseController {

    public function index(){

        $categoriasRepository = $this->load(CategoriasRepository::class);

        if(isset($_GET['s'])) {
            $categoriasEncontradas = $categoriasRepository->select('*')->busca(['categoria_nome'])->paginate(15)->get();
        } else {
            $categoriasEncontradas = $categoriasRepository->select('*')->paginate(15)->get();
        }

        $dados =[
            'title' => 'Loja Virtual - RS-Dev | Painel Administrativo | Lista de Categorias',
            'categorias' => $categoriasEncontradas,
            'links' => $categoriasRepository->links()
        ];

        $this->view($dados, 'admin_listar_categorias');

    }

    public function create(){

        $dados = [
            'title' => 'Loja Virtual - RS-Dev | Painel Administrativo | Cadastrar Categoria'
        ];

        $this->view($dados, 'admin_form_cadastrar_categoria');

    }

    public function store(){

        $categorias = new Categorias;
        $categorias->store();

    }

}
