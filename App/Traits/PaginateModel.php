<?php

namespace App\Traits;

trait PaginateModel {

    public function paginate($perPage){

        $this->perPage($perPage);

        $sql = "SELECT * FROM {$this->table} {$this->sqlPaginate()}";
        $this->typeDatabase->prepare($sql);
        $this->typeDatabase->execute($sql);

        return $this->typeDatabase->fetchAll();

    }

}
