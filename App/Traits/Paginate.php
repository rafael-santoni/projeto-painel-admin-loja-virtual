<?php

namespace App\Traits;

use App\Classes\Uri;

trait Paginate {

    private $perPage;
    private $totalRecords;
    private $maxLinks = 4;

    private function currentPage(){

        $page = filter_input(INPUT_GET,'page', FILTER_SANITIZE_NUMBER_INT);

        if(isset($page)) {
            return $page;
        }

        return 1;

    }

    private function offSet(){
        return ($this->currentPage() * $this->perPage) - $this->perPage;
    }

    public function perPage($perPage){
        $this->perPage = $perPage;
    }

    private function totalPages(){
        return ceil($this->totalRecords() / $this->perPage);
    }

    public function sqlPaginate(){
        return " LIMIT {$this->perPage} OFFSET {$this->offSet()}";
    }

    private function link(){

        $link = "?page=";

        return (new Uri)->getUri().$link;

    }

}
