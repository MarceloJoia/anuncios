<?php

return [

    'title_index'               => 'Listing the Categories',
    'title_new'                 => 'Create category',
    'title_edit'                => 'Edit category',

    'label_name'                => 'Name',
    'label_choose_category'     => '--- Choose a category ---',
    'label_slug'                => 'Slug',
    'label_parent_name'         => 'Parent Category',

    // Validations
    'name' => [
        'required'              => 'Name is mandatory',
        'min_length'            => 'Enter at least 3 characters in size',
        'max_length'            => 'Enter a maximum of 90 characters in length',
        'is_unique'             => 'This category already exists',
    ],
];
