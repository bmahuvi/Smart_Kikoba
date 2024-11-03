<?php

namespace App\Controllers;

use App\Entities\GroupEntity;
use App\Models\GroupModel;
use App\Validation\GroupValidation;
use CodeIgniter\Config\Services;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;

class GroupController extends ResourceController
{
    protected $model;
    protected GroupEntity $entity;
    protected GroupValidation $validation;

    public function __construct()
    {
        $this->model = new GroupModel();
        $this->entity = new GroupEntity();
        $this->validation = new GroupValidation();
    }
    /**
     * Return an array of resource objects, themselves in array format.
     *
     * @return ResponseInterface
     */
    public function index()
    {
        //
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
        $group = $this->entity->getGroup($id);
        if ($group) {
            return $this->respond($group);
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
        $validator->setRuleGroup('validateGroupOnCreation');

        if ($validator->withRequest($this->request)->run()) {
            $this->entity->fill($validator->getValidated());
            $insert = $this->model->insert($this->entity);
            if ($insert) {
                $group = $this->entity->getGroup($insert);
                return $this->respondCreated(['status' => 'Success', 'message' => 'Group was created successfully', 'group' => $group]);
            }
            return $this->fail('Something went wrong');
        }
        return $this->failValidationErrors($validator->getErrors());
    }

    /**
     * Return the editable properties of a resource object.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function edit($id = null)
    {
        //
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
        //
    }
}
