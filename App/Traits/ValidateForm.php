<?php

namespace App\Traits;

use App\Classes\RepeatedRegisters;
use App\Classes\Validate;

trait ValidateForm {

    private function validateFields(){
        return $this->load(Validate::class, $this->rules)->validate();
    }

    protected function validateWithRepeat(){

        $this->validateFields();
        $this->load(RepeatedRegisters::class, $this->rules)->validate();

        return $this->get('error')->hasError();
        
    }
    
    protected function validateWithoutRepeat(){

        $this->validateFields();

        return $this->get('error')->hasError();
        
    }

}
