<?php
require_once './app/views/api.view.php';
require_once './helper.php';


abstract class ApiController{

    protected $view;
    protected $helper;//por ahora obsoleto
    private $data;


    public function __construct(){
        $this->view = new ApiView();
        $this->helper = new Helper();
        $this->data = file_get_contents("php://input");
    }

    function getData(){
        return json_decode($this->data);
    }
}
