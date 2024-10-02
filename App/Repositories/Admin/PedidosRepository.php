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

}
