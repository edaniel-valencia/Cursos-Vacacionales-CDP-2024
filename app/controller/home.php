<?php
class HomeController
{
    private $model;
    public function __construct()
    {
        $this->model = new HomeModel(ConnectionDB::getInstance());
    }

    public function getCountAllUsers()
    {
        $response = $this->model->getCountAllUsers();
        return $response;
    }
    
    public function getCountByUsers($Uid)
    {
        $response = $this->model->getCountByUsers($Uid);
        return $response;
    }
   
    public function getCountInvoice()
    {
        $response = $this->model->getCountInvoice();
        return $response;
    }
   
    public function getCountAllInvoice()
    {
        $response = $this->model->getCountAllInvoice();
        return $response;
    }
  
    public function getCountAllInvoiceProfits()
    {
        $response = $this->model->getCountAllInvoiceProfits();
        return $response;
    }
  
   
    public function getGroupBySport() {
        return $this->model->getGroupBySport();
    }

    public function getGroupByModule() {
        return $this->model->getGroupByModule();
    }

    public function getGroupByDayAndSport() {
        $response = $this->model->getGroupByDayAndSport();
        return $response;
    }
    
    public function getInscriptionsByModuleAndType() {
        $response = $this->model->getInscriptionsByModuleAndType();
        return $response;
    }
    
    public function getInscriptionsBySportAndModuleAndTendence() {
        $response = $this->model->getInscriptionsBySportAndModuleAndTendence();
        return $response;
    }
    

}