<?php

namespace App\Models;

use App\Entities\GroupEntity;
use CodeIgniter\Model;

class GroupModel extends Model
{
    protected $table            = 'tbl_group';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = GroupEntity::class;
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'group_name',
        'district',
        'region',
        'is_active',
        'created_by',
        'desc'
    ];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = ['createMember'];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    protected function createMember($data)
    {
        $user_id = $data['data']['created_by'];
        $group_id = $data['id'];
        $user_model = model('UserModel');
        $user = $user_model->asArray()
            ->select(['first_name', 'last_name', 'region', 'district', 'street', 'gender', 'id as created_by', 'phone', 'email'])
            ->where('id', $user_id)
            ->first();

        if ($user) {
            $user['group_id'] = $group_id;
            log_message('info', 'User to Member ==> ' . json_encode($user));
            $member_model = model('MemberModel');
            $member_model->save($user);
        }
        return $data;
    }
}
