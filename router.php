<?php

require_once './libs/router.php';
require_once './app/controllers/list.api.controller.php';
require_once './app/controllers/category.api.controller.php';



$router= new Router();

$router->addRoute('list',         'GET',    'ListApiController',     'getList'        );
$router->addRoute('list',         'POST',   'ListApiController',     'insertItem'     );
$router->addRoute('list/:Id',     'PUT',    'ListApiController',     'updateItem'     );
$router->addRoute('list/:Id',     'GET',    'ListApiController',     'getList'        );
$router->addRoute('list/:Id',     'DELETE', 'ListApiController',     'deleteItem'     );
$router->addRoute('category',     'GET',    'CategoryApiController', 'getCategoryList');
$router->addRoute('category',     'POST',   'CategoryApiController', 'insertCategory' );
$router->addRoute('category/:Id', 'PUT',    'CategoryApiController', 'updateCategory' );
$router->addRoute('category/:Id', 'GET',    'CategoryApiController', 'getCategoryList');
$router->addRoute('category/:Id', 'DELETE', 'CategoryApiController', 'deleteCategory' );


$router->route($_GET["resource"], $_SERVER['REQUEST_METHOD']);





