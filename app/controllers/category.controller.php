<?php

require_once './app/controllers/api.controller.php';
require_once './app/models/category.model.php';
require_once './app/models/category.model.php';



class CategoryController extends ApiController{

    private $model;
    private $modelList;

    public function __construct()
    {
        //se instancian los dos modelos para no delegar mal, y que cada modelo acceda a su tabla correspondiente.
        $this->model = new CategoryModel();
        $this->modelList = new ListModel();
        
    }

    //lista completa
    public function getCategory($params=[]){
        
        if(empty($params)){
            $categories = $this->model->getCategory();
            $this->view->response($categories,200);
        } else if(!empty($params)){
            $id=$params[":Id"];
            $category=$this->model->getCategoryId($id);

            if($category){
                $this->view->response($category,200);
            }else{
                $this->view->response('no existe categoria',404);
            }
        }
    }

    //eliminar categoria
    public function deleteCategory($params=[]){
        
        if(empty($params)){
            $this->view->response("Error not Found",404);
            return;
        }

        $id=$params['Id'];

        try {
                $category = $this->model->deleteCategory($id);
                if ($category) {
                    $this->view->response('categoria eliminada',200);
                } else {
                    $this->view->response("error al intentar eliminar",404);
                }
            } catch (PDOException) {
                $this->view->response("la Categoria que intenta eliminar, tiene asociado un conjunto de items.
                                            Para poder eliminar correctamente,
                                            debera eliminar los registros de los items asociados/
                                            ",404);
            }
         
    }

    
    //enviar datos de modificacion 
    public function updateCategory(){
        AuthHelper::verify();
        try {//verifico permisos, parametros validos y posible acceso sin previo acceso al form modificacion.
            if ($_POST && ValidationHelper::verifyForm($_POST)) {
                $idCategoria =htmlspecialchars($_POST['idCategoria']);
                $material =htmlspecialchars($_POST['material']);
                $origen =htmlspecialchars($_POST['origen']);
                $motor =htmlspecialchars($_POST['motor']);
                $imagenCategoria =htmlspecialchars($_POST['imagenCategoria']);

                $categoriaModificada = $this->model->updateItem($idCategoria, $material, $origen, $motor, $imagenCategoria);
                if ($categoriaModificada > 0) {
                    header('Location: ' . BASE_URL . "category");
                } else {
                    $this->alertView->renderError("No se pudo actualizar categoria");
                }
            } else {
                $this->alertView->renderError("Error-El formulario no pudo ser procesado, asegurate de que hayas completado todos los campos");
            }
        } catch (PDOException $error) {
            $this->alertView->renderError("Error en la consulta a la base de datos/$error");
        }
    }

    public function insertCategory(){

                $categoria =htmlspecialchars($_POST['categoria']);
                $material =htmlspecialchars($_POST['material']);
                $origen =htmlspecialchars($_POST['origen']);
                $motor =htmlspecialchars($_POST['motor']);
                $imagenCategoria =htmlspecialchars($_POST['imagenCategoria']);

                $id = $this->model->insertCategory($categoria, $material, $origen, $motor, $imagenCategoria);
                if ($id) {
                    $this->view->response('categoria creada',200);
                } else {
                    $this->view->response("Error al crear la categoria",404);
                }    
        
    }
}
