<?php
/**
 * Created by PhpStorm.
 * Product: Chandalala
 * Date: 8/3/2020
 * Time: 18:31
 */

require_once '../controllers/ProductsController.php';
require_once '../models/ProductsModel.php';


class ProductAjax{

    public $productId;

    public function getProduct(){

        $item = 'id';
        $item_value = $this->productId;
        $response = (new ProductsController)->readProducts($item, $item_value);

        echo json_encode($response);


    }

    public $product_id;
    public $productStatus;

    public function ajax_activateProduct(){

        $table ='products';
        $column_status='status';
        $product_status = $this->productStatus;
        $id='id';
        $product_id=$this->product_id;

        $response = ProductsModel::updateProduct($table, $column_status, $product_status, $id, $product_id);


        echo json_encode($response);


    }

    public $product_description;

    public function checkIfProductDescriptionExists(){

        $item = 'product_description';
        $item_value = $this->product_description;
        $response = ProductsController::readProducts($item, $item_value);

        echo json_encode($response);


    }



}


//Edit product

if (isset($_POST['productId'])){

    $edit = new ProductAjax();
    $edit->productId = $_POST['productId'];
    $edit->getProduct();

}

//Activate product

if (isset($_POST['productStatus'])){

    $productAjax = new ProductAjax();
    $productAjax->productStatus = $_POST['productStatus'];
    $productAjax->product_id = $_POST['productId'];
    $productAjax->ajax_activateProduct();

}

//Check if product_description is already used

if (isset($_POST['product_description'])){

    $productAjax = new ProductAjax();
    $productAjax->product_description = $_POST['product_description'];
    $productAjax->checkIfProductDescriptionExists();

}
