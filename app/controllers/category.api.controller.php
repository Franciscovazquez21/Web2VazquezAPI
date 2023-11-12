<?php

require_once './app/controllers/api.controller.php';
require_once './app/models/category.model.php';


class CategoryApiController extends ApiController{

    private $model;

    public function __construct(){
        parent::__construct();
        $this->model = new CategoryModel();
    }

    //consulta lista de categorias/recibe queryParams verificados en helper.
    public function getCategoryList(){

        $columns = $this->model->getColumns();
        //verificaciones al helper
        $filter = $this->helper->isFilter($_GET, $columns); //llama a verify...(true/false)'repuestos.*';//por defecto filtra todos los campos
        $value = $this->helper->isValue($_GET);
        $operation = $this->helper->isOperation($_GET);
        $sort = $this->helper->isSort($_GET, $columns);
        $order = $this->helper->isOrder($_GET);
        $limit = $this->helper->isLimit($_GET);
        $offset = $this->helper->isOffset($_GET);

        $options = [//$options almacena las variables true y se envian a la consulta donde se arma la query segun seteos
            'filter' => $filter ? $_GET['filter'] : null,
            'value' => $value ? $_GET['value'] : null,
            'operation' => $operation ? $_GET['operation'] : null,
            'sort' => $sort ? $_GET['sort'] : null,
            'order' => $order ? $_GET['order'] : null,
            'limit' => $limit ? $_GET['limit'] : null,
            'offset' => $offset ? $_GET['offset'] : null
        ];
        try {
            $categories = $this->model->getCategory($options);
            if ($categories) {
                $this->view->response($categories, 200);
            } else
                $this->view->response('Bad Request', 400);
        } catch (PDOException) {
            $this->view->response('Bad Request', 400);
        }
    }
    
    //consulta categorias por Id
    public function getCategoryId($params = []){

        if (!isset($params[':Id']) && !is_numeric($params[':Id'])) { //valido parametros y busco categoria valida en la consulta
            $this->view->response('Error Not Found', 404);
            return;
        }
        $id = $params[":Id"];
        $category = $this->model->getCategoryId($id);
        if ($category) {
            $this->view->response($category, 200);
        } else {
            $this->view->response('no existe categoria', 404);
        }
    }

    public function deleteCategory($params = []){

        if (!empty($params) && is_numeric($params[':Id'])) {
            $id = $params[':Id'];
            try {
                $category = $this->model->deleteCategory($id);
                if ($category) {
                    $this->view->response("categoria Id N°:$category eliminada.", 200);
                } else {
                    $this->view->response("la categoria no existe", 404);
                }
            } catch (PDOException) {
                $this->view->response("no se puede eliminar categoria, tiene items asociados", 400);
            }
        } else {
            $this->view->response("Error Not Found", 404);
            return;
        }
    }

    //agregar categoria
    public function insertCategory(){

        $category = $this->getData();

        if (empty($category->categoria) || empty($category->material) || empty($category->origen) || empty($category->motor)
            || empty($category->imagenCategoria)) {
            $this->view->response('faltan completar campos', 404);
            return;
        }
        //asignacion vaores recibidos
        $categoria = $category->categoria;
        $material = $category->material;
        $origen = $category->origen;
        $motor = $category->motor;
        $imagenCategoria = $category->imagenCategoria;

        $id = $this->model->insertCategory($categoria, $material, $origen, $motor, $imagenCategoria);
        $newCategory = $this->model->getCategoryId($id);
        if ($newCategory) {
            $this->view->response($newCategory, 200);
        } else {
            $this->view->response("Error al crear la categoria", 404);
        }
    }

    //modificar categoria
    public function updateCategory($params = []){

        if (empty($params) && !is_numeric($params[':Id'])) {
            $this->view->response('Error Not Found', 404);
            return;
        }

        $id = $params[':Id'];
        $categoryId = $this->model->getCategoryId($id);
        if ($categoryId) {
            $category = $this->getData();
            //control por datos incompletos
            if (empty($category->idCategoria) || empty($category->material) || empty($category->origen) || empty($category->motor)
                || empty($category->imagenCategoria)) {
                $this->view->response('faltan completar campos', 404);
                return;
            }
            //asignacion valores recibidos
            $idCategoria = $category->idCategoria;
            $material = $category->material;
            $origen = $category->origen;
            $motor = $category->motor;
            $imagenCategoria = $category->imagenCategoria;
            //control de excepciones
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
    }
}
