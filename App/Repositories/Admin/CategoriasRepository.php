<?php

namespace App\Repositories\Admin;

use App\Models\Admin\CategoriaModel;
use App\Repositories\Repository;

class CategoriasRepository extends Repository {

    public function __construct() {
        $this->model = new CategoriaModel;
    }

}
