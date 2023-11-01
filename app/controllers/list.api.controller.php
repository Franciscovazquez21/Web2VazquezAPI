<?php

require_once './app/controllers/api.controller.php';
require_once './app/models/list.model.php';
require_once './app/models/category.model.php';

//controler de Productos
class ListApiController extends ApiController{
    
    private $model;

    public function __construct(){
        parent::__construct();
        $this->model = new ListModel();
        //$this->modelCategory = new CategoryModel();

    }

    //lista completa
    public function getList($params = []){
    
        if (empty($params)) {
            $list = $this->model->getList();
            $this->view->response($list,200);
        } else if(!empty($params)){
            $id=$params[':Id'];
            $itemList=$this->model->getListById($id);
            if($itemList)
                $this->view->response($itemList,200);
            else{
                $this->view->response('no se encontro item',404);
            }
         }else{
            $this->view->response('error not found',404);
         }
        }

    public function deleteItem($params=[]){
        if(!empty($params)){
            $id=$params[':Id'];           
            $item=$this->model->deleteItem($id);
                if($item){
                    $this->view->response("registro Id N°:$id eliminado.",200);
                }
                else{
                    $this->view->response("el registro no existe",404);
                }
        }else{
            $this->view->response("error",404);
        }
    }

    public function insertItem(){
        
        $item=$this->getData();//desarma el json y genera un objeto

        $idCodigoProducto=$item->idCodigoProducto;
        $nombreProducto=$item->nombreProducto;
        $precio=$item->precio;
        $marca=$item->marca;
        $imagenProducto=$item->imagenProducto;
        $idCategoria=$item->IdCategoria;
        
        $id=$this->model->insertItem($idCodigoProducto,$nombreProducto,$precio,$marca,$imagenProducto,$idCategoria);
        if($id){
            $this->view->response("Item ingresado con exito id N°: $id",201);
        }else{
            $this->view->response("el item no pudo ser ingresado",404);
        }
    
    }

    public function updateItem($params=[]){

        $id=$params[':Id'];

        $itemId=$this->model->getListById($id);
        if($itemId){
        
        $item=$this->getData();

        $idProducto=$item->idProducto;
        $idCodigoProducto=$item->idCodigoProducto;
        $nombreProducto=$item->nombreProducto;
        $precio=$item->precio;
        $marca=$item->marca;
        $imagenProducto=$item->imagenProducto;
        $idCategoria=$item->IdCategoria;

        $itemUpdated=$this->model->updateItem($idProducto,$idCodigoProducto,$nombreProducto,$precio,$marca,$imagenProducto,$idCategoria);
        if($itemUpdated){
            $this->view->response("item modificado con exito",200);
        }else{
            $this->view->response("no se pudo modificar item",404);
        }    
        }else{
            $this->view->response("no existe Item con Id:$id",404);
        }

    }


}
