<?php

namespace App\Validation;

use Config\Validation;

class GroupValidation extends Validation
{
    public $validateGroupOnCreation = [
        'group_name' => [
            'label' => 'group name',
            'rules' => 'required|is_unique[tbl_group.group_name]'
        ],
        'region' => [
            'rules' => 'required',
        ],
        'district' => [
            'rules' => 'required',
        ],
        'desc' => [
            'label' => 'description',
            'rules' => 'required',
        ],
        'created_by' => [
            'rules' => 'required|is_not_unique[tbl_user.id]',
            'errors' => [
                'required' => 'Please specify field created_by',
                'is_not_unique' => 'Invalid value for field group_id',
            ]
        ],
    ];
}
