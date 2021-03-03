<?php

namespace App\Validators;

use App\Table\PostTable;

class PostValidator extends AbstractValidator {
        
    /**
     * __construct
     *
     * @param  array $data
     * @param  PostTable $table
     * @param  int $postID
     * @return void
     */
    public function __construct(array $data, PostTable $table, ?int $postID = null)
    {
        parent::__construct($data);
        $this->validator->rule('required', ['name', 'slug', 'category', 'image']);
        $this->validator->rule('lengthBetween', ['name', 'slug'], 3, 200);
        $this->validator->rule('slug','slug');
        // return false if slug already used
        $this->validator->rule(function($field, $value) use ($table, $postID) {
            return !$table->exists($field, $value, $postID);
        }, ['slug','name'], 'Cette valeur est déjà utilisée');
    }
}