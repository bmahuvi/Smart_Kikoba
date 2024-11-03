<?php

namespace App\Controllers;

use App\Entities\UserEntity;
use App\Libraries\HashLibrary;
use App\Models\UserModel;
use App\Validation\UserValidation;
use CodeIgniter\Config\Services;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;

class UserController extends ResourceController
{
    protected $model;
    protected UserEntity $entity;
    protected UserValidation $validation;

    public function __construct()
    {
        $this->model = new UserModel();
        $this->entity = new UserEntity();
        $this->validation = new UserValidation();
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
        $group = $this->entity->getUser($id);
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
        $validator->setRuleGroup("validateUserOnCreation");
        if ($validator->withRequest($this->request)->run()) {
            $this->entity->fill($validator->getValidated());

            $insert = $this->model->insert($this->entity);
            if ($insert) {
                $user = $this->entity->getUser($insert);
                return $this->respondCreated(['status' => 'Success', 'message' => 'User was created successfully', 'user' => $user]);
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
    public function login()
    {
        $validator = Services::validation($this->validation);
        $validator->setRuleGroup('validateUserOnLogin');
        if ($validator->withRequest($this->request)->run()) {
            $valid_data = $validator->getValidated();
            $user = $this->entity->login($valid_data['phone']);

            if (HashLibrary::verify($valid_data['password'], $user->password)) {
                $user = $this->entity->getUser($user->id);

                return $this->respond(['status' => 'Success', 'message' => 'Login was successfull', 'user' => $user]);
            }

            return $this->fail('Invalid phone number or password');
        }
        return $this->failValidationErrors($validator->getErrors());
    }
}
