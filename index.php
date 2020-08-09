<?php

require_once 'controllers/MainController.php';
require_once 'controllers/UsersController.php';
require_once 'controllers/CategoriesController.php';
require_once 'controllers/ProductsController.php';
require_once 'controllers/ClientsController.php';
require_once 'controllers/SalesController.php';

require_once 'models/UsersModel.php';
require_once 'models/CategoriesModel.php';
require_once 'models/ProductsModel.php';
require_once 'models/CategoriesModel.php';
require_once 'models/SalesModel.php';


$mainController = new MainController();

$mainController->main();