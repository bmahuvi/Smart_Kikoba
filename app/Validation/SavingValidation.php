<?php

namespace App\Validation;

use Config\Validation;

class SavingValidation extends Validation
{
    public $validateSavingOnCreation = [
        'member_id' => [
            'rules' => 'required|is_not_unique[tbl_member.id]',
            'errors' => [
                'required' => 'Please specify field member_id',
                'is_not_unique' => 'Invalid value for field member_id',
            ]
        ],
        'amount' => [
            'rules' => 'required|greater_than[0]'
        ],
        'fine' => [
            'rules' => 'permit_empty|greater_than_equal_to[0]'
        ],
        'date_paid' => [
            'rules' => 'required|valid_date',
            'errors' => [
                'required' => 'Please specify field date_paid',
                'valid_date' => 'Invalid value for field date_paid',
            ]
        ],
        'created_by' => [
            'rules' => 'required|is_not_unique[tbl_user.id]',
            'errors' => [
                'required' => 'Please specify field created_by',
                'is_not_unique' => 'Invalid value for field created_by',
            ]
        ],
    ];
    public $validateSavingOnUpdate = [
        'id' => [
            'rules' => 'required'
        ],
        'amount' => [
            'rules' => 'required|greater_than[0]'
        ],
        'fine' => [
            'rules' => 'permit_empty|greater_than_equal_to[0]'
        ],
        'date_paid' => [
            'rules' => 'required|valid_date',
            'errors' => [
                'required' => 'Please specify field date_paid',
                'valid_date' => 'Invalid value for field date_paid',
            ]
        ],
    ];
}
