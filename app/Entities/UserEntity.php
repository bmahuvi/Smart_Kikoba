<?php

namespace App\Entities;

use App\Libraries\HashLibrary;
use CodeIgniter\Entity\Entity;

class UserEntity extends Entity
{
    protected $columns = [
        'id',
        'role',
        'status',
        'phone',
        'created_at',
        'email',
        'first_name',
        'last_name',
        'gender',
        'region',
        'district',
        'street'
    ];
    protected $attributes = [
        'phone' => null,
        'password' => null,
        'email' => null,
        'first_name' => null,
        'last_name' => null,
        'gender' => null,
        'region' => null,
        'street' => null,
        'district' => null,
    ];
    protected $datamap = [
        'firstName' => 'first_name',
        'lastName' => 'last_name',
        'createdAt' => 'created_at',
    ];
    protected $dates   = ['created_at', 'updated_at', 'deleted_at'];
    protected $casts   = ['id' => 'int'];

    public function setPassword($password)
    {
        $this->attributes['password'] = HashLibrary::hash($password);

        return $this;
    }
    public function getUser($id)
    {
        $model = model('UserModel');
        return $model->select($this->columns)
            ->where('id', $id)
            ->first();
    }
    public function login($phone)
    {
        $model = model('UserModel');
        return $model->select(['phone', 'password', 'id', 'email'])
            ->where('phone', $phone)
            ->first();
    }
}
