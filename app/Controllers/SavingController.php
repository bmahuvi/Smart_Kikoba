<?php

namespace App\Controllers;

use App\Entities\SavingEntity;
use App\Models\SavingModel;
use App\Validation\SavingValidation;
use CodeIgniter\Config\Services;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;

class SavingController extends ResourceController
{
    protected $model;
    protected SavingEntity $entity;
    protected SavingValidation $validation;

    public function __construct()
    {
        $this->model = new SavingModel();
        $this->entity = new SavingEntity();
        $this->validation = new SavingValidation();
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
        //
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
        $validator->setRuleGroup('validateSavingOnCreation');

        if ($validator->withRequest($this->request)->run()) {
            $valid_data = $validator->getValidated();
            $this->entity->fill($valid_data);

            $insert = $this->model->insert($this->entity);
            if ($insert) {
                $saving = $this->entity->getSaving($insert);
                return $this->respondCreated(['status' => 'Success', 'message' => 'Saving was created successfully', 'saving' => $saving]);
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
        $validator = Services::validation($this->validation);
        $validator->setRuleGroup('validateSavingOnUpdate');

        if ($validator->withRequest($this->request)->run()) {
            $valid_data = $validator->getValidated();
            $this->entity = $this->entity->getSaving($valid_data['id']);
            $new_data = [
                'amount' => $valid_data['amount'],
                'fine' => $valid_data['fine'],
                'date_paid' => $valid_data['date_paid'],
            ];
            $this->entity->fill($new_data);
            if ($this->entity->hasChanged()) {
                $update = $this->model->save($this->entity);
                if ($update) {
                    $saving = $this->entity->getSaving($valid_data['id']);
                    return $this->respondUpdated(['status' => 'Success', 'message' => 'Saving was updated successfully', 'saving' => $saving]);
                }
                return $this->fail('Something went wrong');
            }
            return $this->fail('There is no data to update.');
        }
        return $this->failValidationErrors($validator->getErrors());
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
