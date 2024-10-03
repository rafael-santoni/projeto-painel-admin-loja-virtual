<?php

namespace App\Repositories\Admin;

use App\Models\Admin\UserModel;

class UsersRepository {

    private $userModel;

    public function __construct(){
        $this->userModel = new UserModel;
    }

    public function listaUsers($limite=null){

        $limit = !is_null($limite) ? 'limit '.$limite : '';

        $sql = "SELECT * FROM {$this->userModel->table} ORDER BY id DESC {$limit}";
        $this->userModel->typeDatabase->prepare($sql);
        $this->userModel->typeDatabase->execute();
        
        return $this->userModel->typeDatabase->fetchAll();
        
    }

}
