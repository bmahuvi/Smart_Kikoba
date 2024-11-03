<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class GroupEntity extends Entity
{
    protected $columns = [
        'id',
        'group_name',
        'region',
        'district',
        'is_active',
        'desc',
        'created_by',
        'created_at'
    ];
    protected $attributes = [
        'group_name' => null,
        'region' => null,
        'district' => null,
        'desc' => null,
        'created_by' => null,
    ];
    protected $datamap = [
        'groupName' => 'group_name',
        'isActive' => 'is_active',
        'createdBy' => 'created_by',
        'description' => 'desc',
        'createdAt' => 'created_at',
    ];
    protected $dates   = ['created_at', 'updated_at', 'deleted_at'];
    protected $casts   = ['is_active' => 'boolean', 'created_by' => 'int', 'id' => 'int'];

    public function getGroup($id)
    {
        $model = model('GroupModel');
        return $model->select($this->columns)
            ->where('id', $id)
            ->first();
    }
}
