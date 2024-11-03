<?php

namespace App\Validation;

use Config\Validation;

class UserValidation extends Validation
{
    public $validateUserOnLogin = [
        'phone' => [
            'label' => 'phone number',
            'rules' => 'required|exact_length[10]|is_not_unique[tbl_user.phone]',
            'errors' => [
                'is_not_unique' => 'Invalid {field} or password',
            ]
        ],
        'password' => [
            'rules' => 'required',
        ],
    ];
    public $validateUserOnCreation = [
        'email' => [
            'label' => 'Email address',
            'rules' => 'permit_empty|valid_email|is_unique[tbl_user.email]',
            'errors' => [

                'is_unique' => '{field} is already available',
            ]
        ],
        'phone' => [
            'label' => 'Phone number',
            'rules' => 'required|exact_length[10]|is_unique[tbl_user.phone]',
            'errors' => [
                'is_unique' => '{field} is already available',
            ]
        ],
        'password' => [
            'rules' => 'required',
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
    ];
}
