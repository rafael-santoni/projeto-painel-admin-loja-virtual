<?php

namespace App\Repositories\Admin;

use App\Models\Admin\UserModel;
use App\Repositories\Repository;

class UsersRepository extends Repository {

    private $userModel;

    public function __construct(){
        $this->model = new UserModel;
    }

    public function listaUsers($limite=null){

        $limit = !is_null($limite) ? 'limit '.$limite : '';

        $sql = "SELECT * FROM {$this->model->table} ORDER BY id DESC {$limit}";
        $this->model->typeDatabase->prepare($sql);
        $this->model->typeDatabase->execute();
        
        return $this->model->typeDatabase->fetchAll();
        
    }

}
