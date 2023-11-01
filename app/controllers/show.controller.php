<?php
require_once './app/views/list.view.php';

//controlador de manejo de errores que utiliza el router, por default y parametros no definidos $params[1]
class ShowController{

    private $view;

    public function __construct(){
        $this->view = new AlertView();
    }

    public function showError($error){
        $this->view->renderError($error);
    }
}
