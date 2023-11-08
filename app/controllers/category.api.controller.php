<?php

require_once './app/controllers/api.controller.php';
require_once './app/models/category.model.php';


class CategoryApiController extends ApiController{

    private $model;

    public function __construct(){
        parent::__construct();
        $this->model = new CategoryModel();
    }

    public function getCategoryList($params = []){
        
        if (empty($params)) {
            $categories = $this->model->getCategory();
            $this->view->response($categories, 200);
        } else if(isset($params[':Id'])&&is_numeric($params[':Id'])){
            $id = $params[":Id"];
            $category = $this->model->getCategoryId($id);

            if ($category) {
                $this->view->response($category, 200);
            } else {
                $this->view->response('no existe categoria', 404);
            }
        }else{
            $this->view->response('error not found',404);
        }
    }

    public function deleteCategory($params=[]){

        

        if (!empty($params)&&is_numeric($params[':Id'])) {
            $id= $params[':Id'];
            try {
                $category = $this->model->deleteCategory($id);
                if ($category) {
                    $this->view->response("categoria Id N°:$category eliminada.", 200);
                } else {
                    $this->view->response("la categoria no existe", 404);
                }
            } catch (PDOException $e) {
                $this->view->response("no se puede eliminar categoria, tiene items asociados,$e", 400);
            }
        }else{
            $this->view->response("Error not Found", 404);
            return;
        }
    }

    public function insertCategory(){

        $category = $this->getData();

        if (empty($category->categoria) || empty($category->material) || empty($category->origen) || empty($category->motor)
            || empty($category->imagenCategoria)) {
            $this->view->response('faltan completar campos', 404);
            return;
        }

        $categoria = $category->categoria;
        $material = $category->material;
        $origen = $category->origen;
        $motor = $category->motor;
        $imagenCategoria = $category->imagenCategoria;

        $id = $this->model->insertCategory($categoria, $material, $origen, $motor, $imagenCategoria);
        $newCategory=$this->model->getCategoryId($id);
        if ($newCategory) {
            $this->view->response($newCategory, 200);
        } else {
            $this->view->response("Error al crear la categoria", 404);
        }
    }


    public function updateCategory($params = []){

        if (!empty($params) && is_numeric($params[':Id'])){
        $id = $params[':Id'];

        $categoryId = $this->model->getCategoryId($id);

        if ($categoryId) {

            $category = $this->getData();

            if (
                empty($category->idCategoria) || empty($category->material) || empty($category->origen) || empty($category->motor)
                || empty($category->imagenCategoria)){
                $this->view->response('faltan completar campos', 404);
                return;
            }

            $idCategoria = $category->idCategoria;
            $material = $category->material;
            $origen = $category->origen;
            $motor = $category->motor;
            $imagenCategoria = $category->imagenCategoria;

            try {
                $categoriaModificada = $this->model->updateCategory($idCategoria, $material, $origen, $motor, $imagenCategoria);
                if ($categoriaModificada) {
                    $this->view->response('categoria modificada', 200);
                } else {
                    $this->view->response("No se pudo actualizar categoria", 404);
                }
            } catch (PDOException $error) {
                $this->view->response("Error en la consulta a la base de datos/$error", 404);
            }
        }
     } else {
            $this->view->response('id invalido', 404);
        }
    }

    
}
