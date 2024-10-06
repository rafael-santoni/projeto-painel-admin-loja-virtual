<?php

namespace App\Repositories\Admin;

use App\Models\Admin\UserModel;
use App\Repositories\Repository;

class ClientesRepository extends Repository {

    public $sql;

    public function __construct(){
        $this->model = new UserModel;
    }

    public function listar(){

        $this->sql = "SELECT * FROM {$this->model->table}";

        return $this;

    }

}
