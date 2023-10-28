<?php

return [

    'title_index'               => 'Listado de las categorías',
    'title_new'                 => 'Crear categoría',
    'title_edit'                => 'Editar categoria',

    'label_name'                => 'Nombre',
    'label_choose_category'     => '--- Elige una categoría ---',
    'label_slug'                => 'Slug',
    'label_parent_name'         => 'Categoría principal',

    // Validations
    'name' => [
        'required'              => 'El nombre es obligatorio',
        'min_length'            => 'Introduzca al menos 3 caracteres de tamaño',
        'max_length'            => 'Introduzca un tamaño máximo de 90 caracteres',
        'is_unique'             => 'Esta categoría ya existe',
    ],
];
