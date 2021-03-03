<?php

namespace App\Validators;

use App\Validators\Validator;

abstract class AbstractValidator {

    protected array $data;
    protected $validator;
        
    /**
     * __construct
     *
     * @param  array $data
     */
    public function __construct(array $data)
    {
        $this->data = $data;
        $this->validator = new Validator($data);
    }
    
    /**
     * validate
     *
     * @return bool
     */
    public function validate(): bool
    {
        return $this->validator->validate();
    }
    
    /**
     * errors
     *
     * @return array
     */
    public function errors(): array
    {
        return $this->validator->errors();
    }
}