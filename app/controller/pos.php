<?php
class PosController
{
    private $model;
    public function __construct()
    {
        $this->model = new PosModel(ConnectionDB::getInstance());
    }


    public function countMyCourseByIdPOS($userId)
    {
        $response = $this->model->countMyCourseByIdPOS($userId);
        if (!empty($response)) {
            foreach ($response as $row) {
                return $row['count(*)'];
            }
        }
    }

    public function getAllMyCourseByIdPOS($userId)
    {
        $response = $this->model->getAllMyCourseByIdPOS($userId);
        return $response;
    }

    public function searchMyCourseByIdPOS($name, $userId)
    {
        $searchCourse = $this->model->searchMyCourseByIdPOS($name, $userId);
        return $searchCourse;
    }
   

    
    public function dateStartEndMyRegisterByIdPOS($Dstart, $Dend, $userId)
    {
        $searchCourse = $this->model->dateStartEndMyRegisterByIdPOS($Dstart, $Dend, $userId);
        return $searchCourse;
    }
    
    
    public function moduloMyRegisterByIdPOS($Modulo, $userId)
    {
        $searchCourse = $this->model->moduloMyRegisterByIdPOS($Modulo,  $userId);
        return $searchCourse;
    }
    
    
    public function dateStartEndMyRegisterPOS($Dstart, $Dend, $userId)
    {
        $searchCourse = $this->model->dateStartEndMyRegisterPOS($Dstart, $Dend, $userId);
        return $searchCourse;
    }
   
    public function dateStartEndAccoutantPOS($Dstart, $Dend, $Modulo)
    {
        $searchCourse = $this->model->dateStartEndAccoutantPOS($Dstart, $Dend, $Modulo);
        return $searchCourse;
    }
   
    public function moduleMyRegisterPOS($Mname)
    {
        $searchCourse = $this->model->moduleMyRegisterPOS($Mname);
        return $searchCourse;
    }

    public function userPOS($userId)
    {
        $searchCourse = $this->model->userPOS($userId);
        return $searchCourse;
    }

    







    
    //////////////////////////////////////////////////


    public function countRegisterPOS()
    {
        $response = $this->model->countRegisterPOS();
        if (!empty($response)) {
            foreach ($response as $row) {
                return $row['count(*)'];
            }
        }
    }

   
    public function getAllRegisterPOS()
    {
        $response = $this->model->getAllRegisterPOS();
        return $response;
    }
   
    public function searchRegisterPOS($name)
    {
        $searchCourse = $this->model->searchRegisterPOS($name);
        return $searchCourse;
    }
   

    
    public function dateStartEndRegisterPOS($Dstart, $Dend)
    {
        $searchCourse = $this->model->dateStartEndRegisterPOS($Dstart, $Dend);
        return $searchCourse;
    }
    
    
    public function moduloRegisterPOS($Modulo)
    {
        $searchCourse = $this->model->moduloRegisterPOS($Modulo);
        return $searchCourse;
    }
    
    
   
}
