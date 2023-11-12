<?php

require_once './app/controllers/api.controller.php';
require_once './app/models/item.model.php';


class ItemApiController extends ApiController{

    private $model;

    public function __construct(){
        parent::__construct();
        $this->model = new ItemModel();
        $this->helper = new Helper();
    }

    //consulta lista de items/recibe queryParams verificados en helper.
    public function getItemList(){

        $columns = $this->model->getColumns();
        //verificaciones al helper
        $filter = $this->helper->isFilter($_GET, $columns);
        $value = $this->helper->isValue($_GET);
        $operation = $this->helper->isOperation($_GET);
        $sort = $this->helper->isSort($_GET, $columns);
        $order = $this->helper->isOrder($_GET);
        $limit = $this->helper->isLimit($_GET);
        $offset = $this->helper->isOffset($_GET);

        $options = [ //$options almacena las variables true y se envian a la consulta donde se arma la query segun seteos
            'filter' => $filter ? $_GET['filter'] : null,
            'value' => $value ? $_GET['value'] : null,
            'operation' => $operation ? $_GET['operation'] : null,
            'sort' => $sort ? $_GET['sort'] : null,
            'order' => $order ? $_GET['order'] : null,
            'limit' => $limit ? $_GET['limit'] : null,
            'offset' => $offset ? $_GET['offset'] : null
        ];
        try {
            $list = $this->model->getItemList($options);
            if ($list) {
                $this->view->response($list, 200);
            } else
                $this->view->response('Bad Request', 400);
        } catch (PDOException) {
            $this->view->response('Bad Request', 400);
        }
    }

    //consulta items por Id
    public function getItemById($params = []){

        if (!isset($params[':Id']) && !is_numeric($params[':Id'])) { //valido parametros y busco Item valido en la consulta
            $this->view->response('Error Not Found', 404);
            return;
        }
        $id = $params[':Id'];
        $itemList = $this->model->getItemById($id);
        if ($itemList) {
            $this->view->response($itemList, 200);
        } else {
            $this->view->response("No existe Item con Id N°:$id", 404);
        }
    }

    //elimina item segun parametro
    public function deleteItem($params = []){
        
        if (!empty($params) && is_numeric($params[':Id'])) { //valido parametros
            $id = $params[':Id'];
            $item = $this->model->deleteItem($id);
            if ($item) {
                $this->view->response("Registro Id N°:$id eliminado.", 200);
            } else {
                $this->view->response("El registro Id N°:$id no existe", 404);
            }
        } else {
            $this->view->response("Error not found", 404);
        }
    }

    //agrega item segun JSON recibido 
    public function insertItem()
    {
        $item = $this->getData(); //obtengo objeto

        if (empty($item->idCodigoProducto) || empty($item->nombreProducto) || empty($item->precio) || empty($item->marca)
            || empty($item->imagenProducto) || empty($item->IdCategoria)) { //valido datos de campos recibidos
            $this->view->response('Faltan completar campos', 404);
            return;
        }
        //asignacion vaores recibidos
        $idCodigoProducto = $item->idCodigoProducto;
        $nombreProducto = $item->nombreProducto;
        $precio = $item->precio;
        $marca = $item->marca;
        $imagenProducto = $item->imagenProducto;
        $idCategoria = $item->IdCategoria;
        
        try {
            $id = $this->model->insertItem($idCodigoProducto, $nombreProducto, $precio, $marca, $imagenProducto, $idCategoria);
            $newItem = $this->model->getItemById($id);
            if ($newItem) {
                $this->view->response($newItem, 201);
            } else {
                $this->view->response("El item no pudo ser ingresado", 404);
            }
        } catch (PDOException $e) { //si el id de la categoria no existe o es invalido capturo error.
            $this->view->response("Error al intentar ingresar el registro-$e", 404);
        }
    }

    //modificar item
    public function updateItem($params = []){

        if (empty($params) && !is_numeric($params[':Id'])) {//control por parametros validos
            $this->view->response('Error Not Found', 404);
            return;
        }
        
        $id = $params[':Id'];
        $itemId = $this->model->getItemById($id);
        if ($itemId) {
            $item = $this->getData();
            //control por datos incompletos
            if (empty($item->idProducto) || empty($item->idCodigoProducto) || empty($item->nombreProducto) || empty($item->precio) || empty($item->marca)
                || empty($item->imagenProducto) || empty($item->IdCategoria)) {
                $this->view->response('faltan completar campos', 404);
                return;
            }
            //asignacion valores recibidos
            $idProducto = $item->idProducto;
            $idCodigoProducto = $item->idCodigoProducto;
            $nombreProducto = $item->nombreProducto;
            $precio = $item->precio;
            $marca = $item->marca;
            $imagenProducto = $item->imagenProducto;
            $idCategoria = $item->IdCategoria;
            //control de excepciones
            try {
                $itemUpdated = $this->model->updateItem($idProducto, $idCodigoProducto, $nombreProducto, $precio, $marca, $imagenProducto, $idCategoria);
                if ($itemUpdated) {
                    $this->view->response("item modificado con exito", 200);
                } else {
                    $this->view->response("no se pudo modificar item", 404);
                }
            } catch (PDOException $e) {
                $this->view->response("error al intentar modificar el item$e", 404);
            }
        }
    }
}
