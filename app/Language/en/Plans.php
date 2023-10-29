<?php

// Para a view show, o aluno poderá aplicar os conhecimentos.... fica o desafio
// Farei apenas para index e form

return [
    'title_index' => 'Listing the plans',
    'title_new' => 'Creating a new plan',
    'title_edit' => 'Editing a plan',
    'text_monthly' => 'Monthly',
    'text_quarterly' => 'Quarterly',
    'text_semester' => 'Semester',
    'text_yearly' => 'Yearly',
    'table_header_view' => 'Visualize',
    'table_header_code' => 'Code',
    'table_header_plan' => 'Plan',
    'table_header_details' => 'Details',
    'text_info_adverts' => 'Number of Ads the user can register. Leave blank for unlimited',
    'text_is_highlighted' => 'Highlighted for purchase',
    'text_no_highlighted' => 'Not highlighted for purchase',

    // Labels
    'label_name' => 'Name of the Plan',
    'label_code' => 'Plan Code',
    'label_recorrence' => 'Recurrence type',
    'label_adverts' => 'No. of allowed ads',
    'label_value' => 'Plan value',
    'label_description' => 'Plan description',
    'label_details' => 'Details',
    'label_is_highlighted' => 'Highlight plan on Home',
    'label_archived' => 'Archived',

    // Validation messages
    'name' => [
        'required'           => 'Enter the plan name.',
        'min_length'         => 'The name must be at least 3 characters long',
        'max_length'         => 'The Name must have a maximum of 97 characters.',
        'is_unique'          => 'This Plan already exists',
    ],
    'recorrence'        => [
        'in_list' => 'Please choose one of the options: Monthly, Quarterly, Semiannual or Annual',
    ],'value' => [
        'required'           => 'Enter the plan value.',
    ],
    'description' => [
        'required'      => 'The Plan needs a description.',
    ],
];
