<?php

require_once './app/controllers/api.controller.php';
require_once './app/models/list.model.php';


class ListApiController extends ApiController{

    private $model;

    public function __construct(){
        parent::__construct();
        $this->model = new ListModel();
    }

    //lista completa o parcial de item segun parametro
    public function getList($params = []){//GET 
        if (empty($params)) {
            
            if(isset($_GET['sort'])&&isset($_GET['order'])){//recibir parametros
                $sort=$_GET['sort'];//bajo a variable
                $order=$_GET['order'];
                switch($sort){//controlo los casos posibles
                    case 'precio':
                        $sort='precio';
                        break;
                    case 'idCodigoProducto':
                        $sort='idCodigoProducto';
                        break;
                    default:
                        $sort='';
                        break;
                }
                if(!$order=='DESC'){
                  $order='ASC';
                }else{
                    $order='DESC';
                }
                $adicional='ORDER BY '.$sort.' '.$order;
            }else{
                $adicional='';
            }
            $list = $this->model->getList($adicional);
            $this->view->response($list, 200);
        } else if (isset($params[':Id']) && is_numeric($params[':Id'])) {//valido parametros
            $id = $params[':Id'];
            $itemList = $this->model->getListById($id);
            if ($itemList)
                $this->view->response($itemList, 200);
            else {
                $this->view->response("No existe Item Id N°:$id", 404);
            }
        } else {
            $this->view->response('Error Not Found', 404);
        }
    }

    //elimina item segun parametro
    public function deleteItem($params = []){//DELETE
        if (!empty($params) && is_numeric($params[':Id'])) {//valido parametros
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
    public function insertItem(){//PUT
        $item = $this->getData(); //obtengo objeto
        
        if (empty($item->idCodigoProducto) || empty($item->nombreProducto) || empty($item->precio) || empty($item->marca)
            || empty($item->imagenProducto) || empty($item->IdCategoria)) {//valido datos de campos recibidos
            $this->view->response('Faltan completar campos', 404);
            return;
        }

        $idCodigoProducto = $item->idCodigoProducto;
        $nombreProducto = $item->nombreProducto;
        $precio = $item->precio;
        $marca = $item->marca;
        $imagenProducto = $item->imagenProducto;
        $idCategoria = $item->IdCategoria;
        try{
            $id = $this->model->insertItem($idCodigoProducto, $nombreProducto, $precio, $marca, $imagenProducto, $idCategoria);
            $newItem=$this->model->getListById($id);
            if ($newItem) {
                $this->view->response($newItem, 201);
            } else {
                $this->view->response("El item no pudo ser ingresado", 404);
            }
        }catch(PDOException $e){//si el id de la categoria no existe o es invalido capturo error, entre otros.
            $this->view->response("Error al intentar ingresar el registro-$e",404);
        }
    }

    public function updateItem($params = []){

        if (!empty($params) && is_numeric($params[':Id'])) {
            $id = $params[':Id'];

            $itemId = $this->model->getListById($id);
            if ($itemId) {

                $item = $this->getData();
                if (
                    empty($item->idProducto) || empty($item->idCodigoProducto) || empty($item->nombreProducto) || empty($item->precio) || empty($item->marca)
                    || empty($item->imagenProducto) || empty($item->IdCategoria)
                ) {
                    $this->view->response('faltan completar campos', 404);
                    return;
                }

                $idProducto = $item->idProducto;
                $idCodigoProducto = $item->idCodigoProducto;
                $nombreProducto = $item->nombreProducto;
                $precio = $item->precio;
                $marca = $item->marca;
                $imagenProducto = $item->imagenProducto;
                $idCategoria = $item->IdCategoria;
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
        } else {
            $this->view->response('Error Not Found', 404);
        }
    }
}
