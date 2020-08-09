<?php
/**
 * Created by PhpStorm.
 * User: Chandalala
 * Date: 8/3/2020
 * Time: 18:31
 */

require_once '../controllers/CategoriesController.php';
require_once '../models/CategoriesModel.php';


class CategoryAjax{

    public $categoryId;

    public function getCategory(){

        $item = 'id';
        $item_value = $this->categoryId;
        $response = CategoriesController::readCategories($item, $item_value);

        echo json_encode($response);


    }



    public $category;

    public function checkIfCategoryExists(){

        $item = 'username';
        $item_value = $this->category;
        $response = CategoriesController::readCategories($item, $item_value);

        echo json_encode($response);


    }



}


//Edit category

if (isset($_POST['categoryId'])){

    $edit = new CategoryAjax();
    $edit->categoryId = $_POST['categoryId'];
    $edit->getCategory();

}





//Check if category is already used

if (isset($_POST['category'])){

    $categoryAjax = new CategoryAjax();
    $categoryAjax->username = $_POST['category'];
    $categoryAjax->checkIfCategoryExists();

}
