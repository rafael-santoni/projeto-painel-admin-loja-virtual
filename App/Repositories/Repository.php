<?php

namespace App\Repositories;

use App\Classes\Bind;
use App\Traits\Paginate;
use App\Traits\PaginateRepository;
use App\Repositories\RepositoryBuilder;

abstract class Repository extends RepositoryBuilder {
    
    use Paginate, PaginateRepository;

    protected $select;
    protected $busca;

    public function select($select){

        $this->select = $select;
        return $this;

    }

    public function busca($busca){

        $this->busca = $busca;
        return $this;
        
    }

    public function get(){

        // return $this->executeSql();
        $this->createAndExecute();

        return $this->model->typeDatabase->fetchAll();

    }

    // private function executeSql($fetchAll){

    //     $this->createSql();

    //     Bind::bind('bind', $this->model->typeDatabase->getBind());

    //     if($this->paginate) {
    //         $this->createSql('paginate');
    //     }

    //     $this->model->typeDatabase->execute();

    //     if(is_null($fetchAll)) {
    //         return $this->model->typeDatabase->fetchAll();
    //     }

    //     return $this->model->typeDatabase->fetch();

    // }

    public function first(){

        $this->createAndExecute();

        return $this->model->typeDatabase->fetch();

    }

    private function createAndExecute(){

        $this->createSql();

        Bind::bind('bind', $this->model->typeDatabase->getBind());

        if($this->paginate) {
            $this->createSql('paginate');
        }

        $this->model->typeDatabase->execute();

    }

}
