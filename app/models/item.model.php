<?php
require_once './app/models/model.php';

//modelo de productos
class ItemModel extends Model{
    
    //devuelve las columnas correspondientes a la tabla repuestos
    public function getColumns(){
        $query = $this->db->prepare('DESCRIBE repuestos');
        $query->execute();
        return $query->fetchAll(PDO::FETCH_OBJ);
    }
    //consulta todos los productos
    public function getItemList($options){ 
        $result=$this->buildQuery($options);
        $query = $this->db->prepare("SELECT repuestos.*, categoria.categoria FROM repuestos JOIN categoria ON repuestos.idCategoria = categoria.idCategoria $result");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    //consulta producto segun id
    public function getItemById($id){ //consulta por el item segun parametro incluida la categoria
        $query = $this->db->prepare('SELECT * FROM `repuestos` JOIN categoria ON repuestos.idCategoria=categoria.idCategoria WHERE idProducto = ?');
        $query->execute([$id]);
        return $query->fetch(PDO::FETCH_OBJ);//se acomodo el fetch, estaba trayendo todo con fetchAll
    }

    //eliminar producto
    public function deleteItem($id){
        $query = $this->db->prepare('DELETE FROM repuestos WHERE idProducto = ?');
        $query->execute([$id]);
        return $query->rowCount();
    }

    //ingresa producto
    public function insertItem($idCodigoProducto, $nombreProducto, $precio, $marca, $imagenProducto, $idCategoria){
        $query = $this->db->prepare('INSERT INTO repuestos (idCodigoProducto, nombreProducto, precio, marca, imagenProducto, idCategoria) VALUES(?,?,?,?,?,?)');
        $query->execute([$idCodigoProducto, $nombreProducto, $precio, $marca, $imagenProducto, $idCategoria]);
        return $this->db->lastInsertId();
    }

    //modifica producto
    public function updateItem($idProducto, $idCodigoProducto, $nombreProducto, $precio, $marca, $imagenProducto, $idCategoria){
        $query = $this->db->prepare('UPDATE repuestos SET idCodigoProducto=?,nombreProducto=?,precio=?,marca=?,imagenProducto=?,idCategoria=? WHERE idProducto=?');
        $query->execute([$idCodigoProducto, $nombreProducto, $precio, $marca, $imagenProducto, $idCategoria, $idProducto]);
        return $query->rowCount();
    }

    /*//consulta por producto incluyendo la categoria a la que corresponde
    public function getItemsCategoryById($id){
        $query = $this->db->prepare('SELECT repuestos.*, categoria.categoria FROM repuestos JOIN categoria ON repuestos.idCategoria = categoria.idCategoria WHERE repuestos.idCategoria=?');
        $query->execute([$id]);
        return $query->fetch(PDO::FETCH_OBJ);
        
    }*/

}
