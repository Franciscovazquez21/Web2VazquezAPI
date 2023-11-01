<?php

require_once './libs/router.php';
require_once './app/controllers/list.api.controller.php';



$router= new Router();


// define la tabla de ruteo
$router->addRoute('list','GET','ListApiController','getList');
$router->addRoute('list', 'POST', 'ListApiController', 'insertItem');
$router->addRoute('list/:Id', 'PUT', 'ListApiController', 'updateItem');
$router->addRoute('list/:Id', 'GET', 'ListApiController', 'getList');
$router->addRoute('list/:Id', 'DELETE', 'ListApiController', 'deleteItem');
$router->addRoute('category', 'GET', 'ListApiController', 'getCategoryList');
$router->addRoute('category/:Id', 'POST', 'ListApiController', 'insertCategory');
$router->addRoute('category/:Id', 'PUT', 'ListApiController', 'updateCategory');
$router->addRoute('category/:Id', 'GET', 'ListApiController', 'getCategoryList');
$router->addRoute('category/:Id', 'DELETE', 'ListApiController', 'deleteCategory');



// rutea
$router->route($_GET["resource"], $_SERVER['REQUEST_METHOD']);





