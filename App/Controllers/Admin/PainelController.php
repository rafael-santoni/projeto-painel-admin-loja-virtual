<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Site\UserModel;
use App\Models\Site\UsersOnlineModel;
use App\Repositories\Admin\PedidosProdutosRepository;
use App\Repositories\Admin\PedidosRepository;

class PainelController extends BaseController {

    public function index(){

        $pedidosRepository = new PedidosRepository;
        $totalVendas = $pedidosRepository->totalVendas();
        $totalVendasMes = $pedidosRepository->totalVendasMes();

        $userModel = new UserModel;
        $usersEncontrados = $userModel->fetchAll();

        $usersOnlineModel = new UsersOnlineModel;
        $totalUsersOnline = $usersOnlineModel->fetchAll();

        $pedidosProdutosRepository = new PedidosProdutosRepository;
        $produtosEncontrados = $pedidosProdutosRepository->listaVendas(6);

        $dados = [
            'titulo' => 'Loja Virtual - RS-Dev | Painel Administrativo',
            'totalVendas' => $totalVendas,
            'totalVendasMes' => $totalVendasMes,
            'clientes' => count($usersEncontrados),
            'totalUsuariosOnline' => count($totalUsersOnline),
            'listaVendas' => $produtosEncontrados,
        ];

        $template = $this->twig->load('admin_home.html');
        echo $template->render($dados);
        
    }

}
