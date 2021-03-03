<?php

namespace App\Validators;

use App\Table\CategoryTable;

class CategoryValidator extends AbstractValidator {
        
    /**
     * __construct
     *
     * @param  array $data
     * @param  PostTable $table
     * @param  int $id
     * @return void
     */
    public function __construct(array $data, CategoryTable $table, ?int $id = null)
    {
        parent::__construct($data);
        $this->validator->rule('required', ['name', 'slug']);
        $this->validator->rule('lengthBetween', ['name', 'slug'], 1, 200);
        $this->validator->rule('slug','slug');
        // return false if slug already used
        $this->validator->rule(function($field, $value) use ($table, $id) {
            return !$table->exists($field, $value, $id);
        }, ['slug','name'], 'Cette valeur est déjà utilisée');
    }
}