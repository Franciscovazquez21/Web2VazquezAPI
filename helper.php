<?php

class Helper{
    
    //funciones retornan boolean si llegan seteadas las query params. 
    //$resource es el $_GET recibido desde el controller para verificar cada query params(FILTRO-PAGINADO)

    public function isFilter($resource,$columns){//filtro
        if(isset($resource['filter'])){
            $filter=$resource['filter'];
            $columnNames = array_map(function($column) {
                return $column->Field;
            }, $columns);
            return (in_array($filter,$columnNames));
        }
        return false;
    }

    public function isValue($resource){//valor filtro
        if(isset($resource['value'])){
            return true;
        }
        return false;
    }

    public function isOperation($resource){//operador logico
        if(isset($resource['operation'])){
            $operation=$resource['operation'];
            return ($operation=='<'||$operation=='>'||$operation=='=');
        }
        return false;
    }

    public function isSort($resource,$columns){//campo para ordenado
        
        if(isset($resource['sort'])){
            $sort=$resource['sort'];
            $columnNames = array_map(function($column) {
                return $column->Field;
            }, $columns);
            return (in_array($sort,$columnNames));
        }
        return false;
    }

    public function isOrder($resource){//tipo de orden
        if(isset($resource['order'])){
            $order=$resource['order'];
            return ($order==='DESC');
        }
        return false;
    }

    public function isLimit($resource){//paginado
        return isset($resource['limit']) && is_numeric($resource['limit']);
    }

    public function isOffset($resource){//paginado
        return isset($resource['offset']);      
    }
    
}