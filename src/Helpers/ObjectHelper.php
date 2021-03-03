<?php

namespace App\Helpers;

class ObjectHelper {

    public static function hydrate($object, array $data, array $fields): void
    {
        foreach($fields as $field) {
            // to create a method in format => getSomething
            $method = 'set' . str_replace(' ', '', ucwords(str_replace('_', ' ', $field)));
            $object->$method($data[$field]);
        }
    }
}