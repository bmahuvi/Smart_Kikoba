<?php

namespace App\Controllers;

use App\Entities\MemberEntity;
use App\Models\MemberModel;
use App\Validation\MemberValidation;
use CodeIgniter\Config\Services;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;

class MemberController extends ResourceController
{
    protected $model;
    protected MemberEntity $entity;
    protected MemberValidation $validation;

    public function __construct()
    {
        $this->model = new MemberModel();
        $this->entity = new MemberEntity();
        $this->validation = new MemberValidation();
    }
    /**
     * Return an array of resource objects, themselves in array format.
     *
     * @return ResponseInterface
     */
    public function index()
    {
        $members = $this->entity->getMembers(1);
        if ($members) {
            return $this->respond($members);
        }
        return $this->fail('No data to display.');
    }

    /**
     * Return the properties of a resource object.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function show($id = null)
    {
        $member = $this->entity->getMember($id);
        if ($member) {
            return $this->respond($member);
        }
        return $this->failNotFound('No data found');
    }

    /**
     * Return a new resource object, with default properties.
     *
     * @return ResponseInterface
     */
    public function new()
    {
        //
    }

    /**
     * Create a new resource object, from "posted" parameters.
     *
     * @return ResponseInterface
     */
    public function create()
    {
        $validator = Services::validation($this->validation);
        $validator->setRuleGroup('validateMemberOnCreation');

        if ($validator->withRequest($this->request)->run()) {
            $valid_data = $validator->getValidated();
            $this->entity->fill($valid_data);

            $insert = $this->model->insert($this->entity);
            if ($insert) {
                $member = $this->entity->getMember($insert);
                return $this->respondCreated(['status' => 'Success', 'message' => 'Member was created successfully', 'member' => $member]);
            }
            return $this->fail('Something went wrong');
        }
        return $this->failValidationErrors($validator->getErrors());
    }



    /**
     * Add or update a model resource, from "posted" properties.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function update($id = null)
    {
        //
    }

    /**
     * Delete the designated resource object from the model.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function delete($id = null)
    {
        $user = $this->entity->getMember($id);
        if ($user) {
            $delete = $this->model->delete($user->id);
            if ($delete) {
                return $this->respondDeleted(['status' => 'Success', 'message' => 'Member was deleted successfully', 'id' => $id]);
            }
        }
        return $this->fail('Something went wrong.');
    }
    public function updateMember()
    {

        $validator = Services::validation($this->validation);
        $validator->setRuleGroup('validateMemberOnUpdate');
        if ($validator->withRequest($this->request)->run()) {

            $valid_data = $validator->getValidated();

            $this->entity = $this->entity->getMember($valid_data['id']);

            $new_data = [
                'first_name' => $valid_data['first_name'],
                'last_name' => $valid_data['last_name'],
                'region' => $valid_data['region'],
                'district' => $valid_data['district'],
                'street' => $valid_data['street'],
                'gender' => $valid_data['gender'],
                'phone' => $valid_data['phone'],
                'email' => $valid_data['email'],
            ];
            $this->entity->fill($new_data);
            if ($this->entity->hasChanged()) {
                $update = $this->model->save($this->entity);
                if ($update) {
                    $member = $this->entity->getMember($valid_data['id']);
                    return $this->respondUpdated(['status' => 'Success', 'message' => 'Member was updated successfully', 'member' => $member]);
                }
                return $this->fail('Something went wrong');
            }
            return $this->fail('There is no data to update.');
        }
        return $this->failValidationErrors($this->validator->getErrors());
    }
}
