<?php

namespace App\Traits;

use App\Classes\Bind;
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

    private function totalRecords(){

        $bind = Bind::get('bind');
        $bind->execute();

        return $bind->rowCount();

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

    private function previous(){

        $links = '';

        if($this->currentPage() != 1) {
            
            $previous = ($this->currentPage() - 1);

            $links .= '<li><a href="'.$this->link().'1"> [1] </a></li>';
            $links .= '<li><a href="'.$this->link().$previous.'" aria-label="Previous"> <span aria-hidden="true">&laquo;</span></a></li>';

        }

        return $links;

    }

    private function next(){

        $links = '';

        if($this->currentPage() != $this->totalPages()) {
            
            $next = ($this->currentPage() + 1);

            $links .= '<li><a href="'.$this->link().$next.'" aria-label="Next"> <span aria-hidden="true">&raquo;</span></a></li>';
            $links .= '<li><a href="'.$this->link().$this->totalPages().'"> ['.$this->totalPages().'] </a></li>';

        }

        return $links;

    }

    private function showLinks($i){

        $class = ($i == $this->currentPage()) ? 'actual' : '';

        if($i > 0 && $i <= $this->totalPages()) {
            return '<li><a href="'.$this->link().$i.'" class="'.$class.'">'.$i.'</a></li>';
        }

    }

    public function links(){

        $totalPages = $this->totalPages();

        if($totalPages > 0) {

            $links = '<ul class="pagination">';
            $links .= $this->previous();

            for ($i = $this->currentPage() - $this->maxLinks; $i <= $this->currentPage() + $this->maxLinks; $i++) { 
                $links .= $this->showLinks($i);
            }

            $links .= $this->next();
            $links .= '</ul>';

            return $links;

        }

    }

    public function infoPaginate(){

    }

}
