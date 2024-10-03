<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Repositories\Admin\PedidosRepository;

class AdminVendasMesController extends BaseController {

    public function index(){

        $pedidosRepository = new PedidosRepository;
        $listaVendas = $pedidosRepository->listaVendasMes();

        $dados = [
            'title' => 'Loja Virtual - RS-Dev | Painel Administrativo | Vendas do Mês',
            'pedidos' => $listaVendas
        ];

        $template = $this->twig->load('admin_listar_vendas_mes.html');
        echo $template->render($dados);

    }

}
