<?php
class StatusController
{
    private $model;
    public function __construct()
    {
        $this->model = new StatusModel(ConnectionDB::getInstance());
    }

    public function getStatus()
    {
        $response = $this->model->getStatus();
        return $response;
    }
    public function getStatusPay()
    {
        $response = $this->model->getStatusPay();
        return $response;
    }
   
}
