<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Repositories\Admin\PedidosRepository;

class AdminVendasTotalController extends BaseController {

    public function index(){

        $pedidosRepository = new PedidosRepository;
        $listaVendas = $pedidosRepository->listaVendas();

        $dados = [
            'title' => 'Loja Virtual - RS-Dev | Painel Administrativo | Lista de Vendas',
            'pedidos' => $listaVendas,
        ];

        $template = $this->twig->load('admin_listar_vendas_total.html');
        echo $template->render($dados);

    }

}
