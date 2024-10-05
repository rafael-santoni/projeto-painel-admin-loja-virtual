<?php

namespace App\Repositories;

class RepositoryBuilder {

    protected function createSql($paginate=null){

        if(isset($this->sql)) {
            $sql = $this->sql;
        }

        if(isset($this->select)) {
            $sql = "SELECT {$this->select} FROM {$this->model->table}";
        }

        if(isset($this->busca)) {
            $sql .= " WHERE {$this->busca[0]} like :{$this->busca[0]}";
        }

        if($paginate) {
            $sql .= " {$this->sqlPaginate()}";
        }

        $this->model->typeDatabase->prepare($sql);

        if(isset($this->busca)) {
            $busca = filter_var($_GET['s'], FILTER_SANITIZE_STRING);

            $this->model->typeDatabase->bindValue(":{$this->busca[0]}", '%'.$busca.'%');
        }

    }

}
