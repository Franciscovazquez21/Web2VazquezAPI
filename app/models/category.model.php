<?php
require_once './app/models/model.php';
//modelo de categorias
class CategoryModel extends Model{
    
    //consulta todas las categorias
    public function getCategory(){
        $query = $this->db->prepare('SELECT * FROM `categoria`');
        $query->execute();
        return $query->fetchAll(PDO::FETCH_OBJ);       
    }
    
    //consulta categoria segun id
    public function getCategoryId($id){
        $query = $this->db->prepare('SELECT * FROM `categoria` WHERE idCategoria=?');
        $query->execute([$id]);
        return $query->fetchAll(PDO::FETCH_OBJ);       
    }
    
    //inserta nueva categoria
    public function insertCategory($categoria, $material, $origen, $motor, $imagenCategoria){
        $query = $this->db->prepare('INSERT INTO categoria (categoria, material, origen, motor, imagenCategoria) VALUES(?,?,?,?,?)');
        $query->execute([$categoria, $material, $origen, $motor, $imagenCategoria]);
        return $this->db->lastInsertId();
    }

    //elimina categoria
    public function deleteCategory($id){
        $query = $this->db->prepare('DELETE FROM categoria WHERE idCategoria = ?');
        $query->execute([$id]);
        return $query->rowCount();
    }

    //modifica categoria
    public function updateCategory($idCategoria, $material, $origen, $motor, $imagenCategoria){
        $query = $this->db->prepare('UPDATE categoria SET material=?,origen=?,motor=?,imagenCategoria=? WHERE idCategoria=?');
        $query->execute([$material, $origen, $motor, $imagenCategoria, $idCategoria]);
        return $query->rowCount();
    }

    //consulta para mostrar las categorias disponibles cuando se quiere modificar un producto o categoria
    public function getIdCategory(){ 
        $query = $this->db->prepare('SELECT categoria.idCategoria,categoria.categoria FROM categoria;');
        $query->execute();
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

}
