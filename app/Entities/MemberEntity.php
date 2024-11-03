<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class MemberEntity extends Entity
{
    protected array $columns = [
        'id',
        'first_name',
        'last_name',
        'gender',
        'is_active',
        'status',
        'created_by',
        'region',
        'district',
        'email',
        'phone',
        'street',
        'group_id',
        'created_at',
        'updated_at'
    ];


    protected $attributes = [
        'first_name' => null,
        'last_name' => null,
        'region' => null,
        'street' => null,
        'district' => null,
        'created_by' => null,
        'group_id' => null,
        'gender' => null,
        'phone' => null,
        'email' => null,
    ];
    protected $datamap = [
        'firstName' => 'first_name',
        'lastName' => 'last_name',
        'groupId' => 'group_id',
        'createdBy' => 'created_by',
        'createdAt' => 'created_at',
        'updatedAt' => 'updated_at',
    ];
    protected $dates   = ['created_at', 'updated_at', 'deleted_at'];
    protected $casts   = ['id' => 'int', 'is_active' => 'boolean'];

    public function getMember($id)
    {
        $model = model('MemberModel');

        return $model->select($this->columns)->where('id', $id)->first();
    }


    public function getMembers($group_id)
    {
        $model = model('MemberModel');

        return $model->select($this->columns)
            ->where('group_id', $group_id)
            ->findAll();
    }
}
