<?php

namespace App\Classes;

use App\Models\Site\CarrinhoModel;
use App\Repositories\Site\CarrinhoRepository;

class CarrinhoBanco {

    private $carrinhoModel;

    public function __construct(){
        $this->carrinhoModel = new CarrinhoModel;
    }

    public function add($id){

        $this->carrinhoModel->add([
            1 => $id,
            2 => 1,
            3 => IdRandom(),
            4 => date('Y-m-d H:i:s'),
            5 => date('Y-m-d H:i:s', strtotime('+1hour')),
            6 => 2
        ]);

    }

    public function update($id){
        $this->carrinhoModel->update($id, Carrinho::produtoCarrinho($id), IdRandom());
    }

    public function remove($sessao){

        $produtosCarrinho = $this->carrinhoModel->find('sessao', $sessao, 'all');
        foreach ($produtosCarrinho as $produto) {
            $this->carrinhoModel->remove($produto->produto, $produto->sessao);
        }

    }

    public function updateStatus($sessao){

        $carrinhoRepository = new CarrinhoRepository;
        return $carrinhoRepository->updateStatus($sessao);

    }

    public function removeProduct($id, $sessao){
        $this->carrinhoModel->remove($id, $sessao);
    }

}
