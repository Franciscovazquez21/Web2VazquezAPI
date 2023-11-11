<?php

class Helper{

    //retorna true si el objeto que se recorre tiene campo vacio.
    public function isEmptyObject($object=[]){
        foreach($object as $data){
            if(empty($data))
            return true;
        }
        return false;
    }

    public function issetObject($object=[]){
        foreach($object as $data){
            if(!isset($data))
            return true;
        }
        return false;
    }

    public function isFilter($resource,$columns){
        if(isset($resource['filter'])){
            $filter=$resource['filter'];
            $columnNames = array_map(function($column) {
                return $column->Field;
            }, $columns);
            return (in_array($filter,$columnNames));
        }
        return false;
    }

    public function isOperation($resource){
        if(isset($resource['operation'])){
            $operation=$resource['operation'];
            return ($operation=='<'||$operation=='>'||$operation=='=');
        }
        return false;
    }
    public function isValue($resource){
        if(isset($resource['value'])){
            return true;
        }
        return false;
    }

    public function isSort($resource,$columns){
        
        if(isset($resource['sort'])){
            $sort=$resource['sort'];
            $columnNames = array_map(function($column) {
                return $column->Field;
            }, $columns);
            return (in_array($sort,$columnNames));
        }
        return false;
    }

    public function isOrder($resource){
        if(isset($resource['order'])){
            $order=$resource['order'];
            return ($order==='DESC');
        }
        return false;
    }
    
}