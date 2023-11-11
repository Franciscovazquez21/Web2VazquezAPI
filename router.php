<?php

require_once './libs/router.php';
require_once './app/controllers/item.api.controller.php';
require_once './app/controllers/category.api.controller.php';



$router= new Router();

$router->addRoute('item',         'GET',    'ItemApiController',     'getItemList'    );
$router->addRoute('item/:Id',     'GET',    'ItemApiController',     'getItemById'    );
$router->addRoute('item',         'POST',   'ItemApiController',     'insertItem'     );
$router->addRoute('item/:Id',     'PUT',    'ItemApiController',     'updateItem'     );
$router->addRoute('item/:Id',     'GET',    'ItemApiController',     'getItemList'    );
$router->addRoute('item/:Id',     'DELETE', 'ItemApiController',     'deleteItem'     );
$router->addRoute('category',     'GET',    'CategoryApiController', 'getCategoryList');
$router->addRoute('category',     'POST',   'CategoryApiController', 'insertCategory' );
$router->addRoute('category/:Id', 'PUT',    'CategoryApiController', 'updateCategory' );
$router->addRoute('category/:Id', 'GET',    'CategoryApiController', 'getCategoryList');
$router->addRoute('category/:Id', 'DELETE', 'CategoryApiController', 'deleteCategory' );


$router->route($_GET["resource"], $_SERVER['REQUEST_METHOD']);





