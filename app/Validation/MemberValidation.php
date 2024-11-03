<?php

namespace App\Validation;

use Config\Validation;

class MemberValidation extends Validation
{
    public $validateMemberOnCreation = [
        'first_name' => [
            'label' => 'last name',
            'rules' => 'required',
        ],
        'last_name' => [
            'label' => 'first name',
            'rules' => 'required',
        ],
        'gender' => [
            'rules' => 'required|in_list[Male,Female]',
        ],
        'region' => [
            'rules' => 'required',
        ],
        'district' => [
            'rules' => 'required',
        ],
        'street' => [
            'rules' => 'permit_empty',
        ],
        'created_by' => [
            'rules' => 'required|is_not_unique[tbl_user.id]',
            'errors' => [
                'required' => 'Please specify field created_by',
                'is_not_unique' => 'Invalid value for field created_by',
            ]
        ],
        'group_id' => [
            'rules' => 'required|is_not_unique[tbl_group.id]',
            'errors' => [
                'required' => 'Please specify field group_id',
                'is_not_unique' => 'Invalid value for field group_id',
            ]
        ],
        'phone' => [
            'label' => 'phone number',
            'rules' => 'required|exact_length[10]|is_unique[tbl_member.phone]',
            'error' => [
                'is_unique' => 'The {field} is already available',
            ],
        ],
        'email' => [
            'label' => 'Email address',
            'rules' => 'permit_empty|valid_email|is_unique[tbl_member.email]',
            'errors' => [
                'is_unique' => '{field} is already available',
            ]
        ],
    ];
    public $validateMemberOnUpdate = [
        'id' => [
            'rules' => 'required'
        ],
        'first_name' => [
            'label' => 'last name',
            'rules' => 'required',
        ],
        'last_name' => [
            'label' => 'first name',
            'rules' => 'required',
        ],
        'gender' => [
            'rules' => 'required|in_list[Male,Female]',
        ],
        'region' => [
            'rules' => 'required',
        ],
        'district' => [
            'rules' => 'required',
        ],
        'street' => [
            'rules' => 'permit_empty',
        ],
        'phone' => [
            'label' => 'phone number',
            'rules' => 'required|exact_length[10]|is_unique[tbl_member.phone,id,{id}]',
            'error' => [
                'is_unique' => 'The {field} is already available',
            ],
        ],
        'email' => [
            'label' => 'Email address',
            'rules' => 'permit_empty|valid_email|is_unique[tbl_member.email,id,{id}]',
            'errors' => [
                'is_unique' => '{field} is already available',
            ]
        ],
    ];
}
