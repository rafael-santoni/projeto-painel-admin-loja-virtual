<?php

namespace App\Repositories\Admin;

use App\Models\Admin\PedidosModel;

class PedidosRepository {

    private $pedidosModel;

    public function __construct() {
        $this->pedidosModel = new PedidosModel;
    }

    public function totalVendas() {

        $sql = "SELECT sum(total) as totalVendas FROM {$this->pedidosModel->table} WHERE pedido_status = 1";
        $this->pedidosModel->typeDatabase->prepare($sql);
        $this->pedidosModel->typeDatabase->execute();
        
        return $this->pedidosModel->typeDatabase->fetch();

    }

    public function totalVendasMes() {

        $sql = "SELECT sum(total) as totalVendas FROM {$this->pedidosModel->table} WHERE pedido_status = 1 AND MONTH(created_at) = MONTH(CURDATE()) AND YEAR(created_at) = YEAR(CURDATE())";
        $this->pedidosModel->typeDatabase->prepare($sql);
        $this->pedidosModel->typeDatabase->execute();
        
        return $this->pedidosModel->typeDatabase->fetch();
        
    }

    public function vendasMeses(){

        $sql = "SELECT * FROM {$this->pedidosModel->table} WHERE YEAR(created_at) = YEAR(CURDATE()) AND pedido_status = 1 ORDER BY created_at ASC";

        $this->pedidosModel->typeDatabase->prepare($sql);
        $this->pedidosModel->typeDatabase->execute();
        
        return $this->pedidosModel->typeDatabase->fetchAll();

    }

    public function listaVendas(){

        $sql = "SELECT pedidos.id as idPedido, pedido_frete, total, name, sobrenome, pedidos.created_at as createdAt 
                FROM {$this->pedidosModel->table} 
                INNER JOIN users ON users.id = pedido_user 
                WHERE pedido_status = 1";
        $this->pedidosModel->typeDatabase->prepare($sql);
        $this->pedidosModel->typeDatabase->execute();
        
        return $this->pedidosModel->typeDatabase->fetchAll();

    }

}
