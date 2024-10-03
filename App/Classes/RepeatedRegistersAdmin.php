<?php

namespace App\Classes;

use App\Interfaces\InterfaceRepeatedRegisters;
use App\Classes\RepeatedRegistersValidate;

class RepeatedRegistersAdmin extends RepeatedRegistersValidate implements InterfaceRepeatedRegisters {

    CONST SITE_NAMESPACE = "App\\Models\\Admin\\";

    public function model($data){

        $model = self::SITE_NAMESPACE.ucfirst($data[1]).'Model';
        return new $model;

    }

}
