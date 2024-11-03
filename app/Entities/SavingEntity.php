<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class SavingEntity extends Entity
{
    protected $attributes = [
        'amount' => null,
        'fine' => 'null',
        'date_paid' => null,
        'created_by' => null,
        'member_id' => null,
    ];
    protected $datamap = [
        'datePaid' => 'date_paid',
        'memberId' => 'member_id',
        'createdBy' => 'created_by',
        'createdAt' => 'created_at',
        'updatedAt' => 'updated_at'
    ];
    protected $dates   = ['created_at', 'updated_at', 'deleted_at'];
    protected $casts   = [
        'amount' => 'int',
        'fine' => 'int',
        'member_id' => 'int',
        'id' => 'int'
    ];
    protected $columns = [
        'id',
        'member_id',
        'amount',
        'fine',
        'date_paid',
        'created_by',
        'created_at',
        'updated_at'
    ];
    public function getSaving($id)
    {
        $model = model('SavingModel');

        return $model->select($this->columns)
            ->where('id', $id)->first();
    }
    public function getSavings()
    {
        $model = model('SavingModel');

        return $model->select($this->columns)
            ->orderBy('created_at', 'desc')
            ->findAll();
    }
}
