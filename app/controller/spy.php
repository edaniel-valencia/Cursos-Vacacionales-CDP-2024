<?php
class SpyController
{
    private $model;
    public function __construct()
    {
        $this->model = new SpyModel(ConnectionDB::getInstance());
    }


    public function countMyCourseByIdSpy($userId)
    {
        $response = $this->model->countMyCourseByIdSpy($userId);
        if (!empty($response)) {
            foreach ($response as $row) {
                return $row['count(*)'];
            }
        }
    }

   
}
