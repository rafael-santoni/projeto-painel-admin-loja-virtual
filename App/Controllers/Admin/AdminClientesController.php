<?php

namespace App\Controllers\Admin;

use App\Classes\Forms\Admin\Clientes;
use App\Controllers\BaseController;
use App\Repositories\Admin\ClientesRepository;

class AdminClientesController extends BaseController {

    public function index(){

        $clientesRepository = new ClientesRepository;
        if(isset($_GET['s'])) {
            dump('caiu no $_GET'); exit;
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

    public function edit($args){

        $id = filter_var($args[0], FILTER_SANITIZE_NUMBER_INT);

        // $clienteEncontrado = $this->load(UsersRepository::class)->select('name')->get();
        // $clienteEncontrado = $this->load(UsersRepository::class)->select('id,name,sobrenome,email,endereco,bairro,cidade,estado,cep,ddd,telefone')->first();
        $clienteEncontrado = $this->load(ClientesRepository::class)->model->find('id', $id);

        $dados = [
            'title' => 'Loja Virtual - RS-Dev | Painel Administrativo | Editar Cliente',
            'cliente' => $clienteEncontrado
        ];

        $this->view($dados, 'admin_form_editar_cliente');

    }

    public function update($args){

        // if($_SERVER['REQUEST_METHOD'] == 'POST') {

            $id = filter_var($args[0], FILTER_SANITIZE_NUMBER_INT);

            $clientes = new Clientes;
            $clientes->update($id);

        // }

    }

    public function destroy($args){

        $id = filter_var($args[0], FILTER_SANITIZE_NUMBER_INT);

        $clientes = new ClientesRepository;
        $clientes->model->delete('id', $id);

        return $this->get('redirect')->back();

    }

}
