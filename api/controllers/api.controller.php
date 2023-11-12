<?php
require_once 'api/views/api.view.php';

class ApiController
{
    private $apiView;
    private $data;
    public function __construct()
    {
        $this->apiView = new ApiView();
        $this->data = file_get_contents("php://input");
    }

    public function getData()
    {
        return json_decode($this->data);
    }
}