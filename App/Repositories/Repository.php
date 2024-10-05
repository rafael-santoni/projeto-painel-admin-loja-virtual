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
        return $this->executeSql();
    }

    private function executeSql(){

        $this->createSql('');

        Bind::bind('bind', $this->model->typeDatabase->getBind());

        if($this->paginate) {
            $this->createSql('paginate');
        }

        $this->model->typeDatabase->execute();

        return $this->model->typeDatabase->fetchAll();

    }


}
