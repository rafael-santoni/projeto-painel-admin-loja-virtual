<?php

namespace App\Traits;

use App\Classes\RepeatedRegisters;
use App\Classes\Validate;

trait ValidateForm {

    private function validateFields($rules){
        return $this->load(Validate::class, $rules)->validate();
    }

    protected function validateWithRepeat($rules){

        $this->validateFields($rules);
        $this->load(RepeatedRegisters::class, $rules)->validate();

        return $this->get('error')->hasError();
        
    }
    
    protected function validateWithoutRepeat($rules){

        $this->validateFields($rules);

        return $this->get('error')->hasError();
        
    }

}
