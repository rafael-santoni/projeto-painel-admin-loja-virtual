<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Repositories\Admin\PedidosRepository;

class PainelController extends BaseController {

    public function index(){

        $pedidosRepository = new PedidosRepository;
        $totalVendas = $pedidosRepository->totalVendas();
        $totalVendasMes = $pedidosRepository->totalVendasMes();

        $dados = [
            'titulo' => 'Loja Virtual - RS-Dev | Painel Administrativo',
            'totalVendas' => $totalVendas,
            'totalVendasMes' => $totalVendasMes
        ];

        $template = $this->twig->load('admin_home.html');
        echo $template->render($dados);
        
    }

}
