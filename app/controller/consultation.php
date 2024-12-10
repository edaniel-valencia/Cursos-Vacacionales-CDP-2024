<?php
class ConsultationController
{
    private $model;
    public function __construct()
    {
        $this->model = new ConsultationModel(ConnectionDB::getInstance());
    }

  

    public function countRegisterConsultation()
    {
        $response = $this->model->countRegisterConsultation();
        if (!empty($response)) {
            foreach ($response as $row) {
                return $row['count(*)'];
            }
        }
    }
   
    public function getAllRegisterConsultation()
    {
        $response = $this->model->getAllRegisterConsultation();
        return $response;
    }
  
    public function searchRegisterConsultation($name)
    {
        $searchCourse = $this->model->searchRegisterConsultation($name);
        return $searchCourse;
    }
    
    public function MSSERegisterConsultation($module, $sport, $start, $end)
    {
        $searchCourse = $this->model->MSSERegisterConsultation($module, $sport, $start, $end);
        return $searchCourse;
    }
    
    public function MSRegisterConsultation($module, $sport)
    {
        $searchCourse = $this->model->MSRegisterConsultation($module, $sport);
        return $searchCourse;
    }
    
    
    public function MSRegisterConsultationByHour($module, $sport)
    {
        $searchCourse = $this->model->MSRegisterConsultationByHour($module, $sport);
        return $searchCourse;
    }
    
    public function MRegisterConsultation($module)
    {
        $searchCourse = $this->model->MRegisterConsultation($module);
        return $searchCourse;
    }
    
    public function MRegisterConsultationMatriz($module)
    {
        $searchCourse = $this->model->MRegisterConsultationMatriz($module);
        return $searchCourse;
    }
    
    public function MRegisterConsultationS($moduleSure)
    {
        $searchCourse = $this->model->MRegisterConsultationS($moduleSure);
        return $searchCourse;
    }
    
    public function SRegisterConsultation($sport)
    {
        $searchCourse = $this->model->SRegisterConsultation($sport);
        return $searchCourse;
    }
    
    


    ///////////////////////////////////////   QUOTA HOUR

     
    public function getAllHourStart()
    {
        $response = $this->model->getAllHourStart();
        return $response;
    }
     
    public function getAllHourEnd()
    {
        $response = $this->model->getAllHourEnd();
        return $response;
    }
   
     
    public function getAllSport()
    {
        $response = $this->model->getAllSport();
        return $response;
    }
   
   
     
    public function getAllSportHourQuota()
    {
        $response = $this->model->getAllSportHourQuota();
        return $response;
    }
   
   
     
    public function getAllSportHourQuotaId($QHid)
    {
        $response = $this->model->getAllSportHourQuotaId($QHid);
        return $response;
    }
   
   
     
    public function getAllModule()
    {
        $response = $this->model->getAllModule();
        return $response;
    }
   


    /////////////////////////////////// COURSE

    public function getAllCourseConsultant()
    {
        $response = $this->model->getAllCourseConsultant();
        return $response;
    }
   

    public function MSHQRegisterConsultation($module, $sport, $QHid)
    {
        $searchCourse = $this->model->MSHQRegisterConsultation($module, $sport, $QHid);
        return $searchCourse;
    }
    
}
