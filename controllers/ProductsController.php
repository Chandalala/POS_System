<?php
/**
 * Created by PhpStorm.
 * Product: Chandalala
 * Date: 12/1/2020
 * Time: 23:20
 */

class ProductsController{


    public function __construct(){

    }


    public function createProduct(){

        if (isset($_POST['productCode'], $_POST['product_description'], $_POST['quantity'], $_POST['sale_price'], $_POST['purchase_price'])){

            $product_code = $_POST['productCode'];
            $product_description = $_POST['product_description'];
            $product_category = $_POST['product_category'];
            $product_quantity = $_POST['quantity'];
            $sale_price = $_POST['sale_price'];
            $purchase_price = $_POST['purchase_price'];

            if (preg_match('/^[a-zA-Z0-9]+$/', $product_code) &&
                preg_match('/^[a-zA-Z0-9]+$/', $product_description) &&
                preg_match('/^[0-9]+$/', $product_quantity) &&
                preg_match('/^[0-9.]+$/', $sale_price) &&
                preg_match('/^[0-9.]+$/', $purchase_price)){

                $root = '';

                if(isset($_FILES['newImage']['tmp_name'])){

                    //get image size width and height and store them as an array
                    list($image_width, $image_height) = getimagesize($_FILES['newImage']['tmp_name']);

                    $new_imageWidth = 500;
                    $new_imageHeight = 500;

                    // create the directory in which you want to save the image
                    define('PATH', 'views/dist/img/products/');

                    $directory = PATH.$product_description;

                    //first check if the given name is a directoy
                    if (!mkdir($directory, 0755) && !is_dir($directory)) {
                        throw new \RuntimeException(sprintf('Directory "%s" was not created', $directory));
                    }

                    if ($_FILES['newImage']['type'] === 'image/jpeg'){

                        $append_random_number =mt_rand(100,999);
                        $root = PATH.$product_description. '/' .$append_random_number. '.jpg';

                        $origin = imagecreatefromjpeg($_FILES['newImage']['tmp_name']);
                        $destination = imagecreatetruecolor($new_imageWidth, $new_imageHeight);

                        imagecopyresized($destination, $origin, 0, 0, 0,0,
                            $new_imageWidth, $new_imageHeight, $image_width, $image_height);

                        imagejpeg($destination, $root);

                    }

                    if ($_FILES['newImage']['type'] === 'image/png'){

                        $append_random_number =mt_rand(100,999);
                        $root = PATH.$product_description. '/' .$append_random_number. '.png';

                        $origin = imagecreatefrompng($_FILES['newImage']['tmp_name']);
                        $destination = imagecreatetruecolor($new_imageWidth, $new_imageHeight);

                        imagecopyresized($destination, $origin, 0, 0, 0,0,
                            $new_imageWidth, $new_imageHeight, $image_width, $image_height);

                        imagepng($destination, $root);

                    }


                }

                $table = 'products';
                
                $data = array('code'=>$product_code, 'category'=>$product_category ,'description'=>$product_description, 'stock'=>$product_quantity, 'sale_price'=>$sale_price,
                    'purchase_price'=>$purchase_price, 'image'=>$root);

                $response = ProductsModel::addProduct($table, $data);
                if ($response === 'ok'){

                    echo '<script>
                        //use sweetalert
                        alert("Product added");
                    </script>';

                }
                else{
                    echo '<script>
                                alert("'
                        .$response.
                        '");

                       </script>';
                }

            }
            else{
                echo '<script>
                    //use sweetalert
                    alert("Invalid chars")
                </script>';
            }
        }
    }

    public function readProducts($item, $item_value){

        $table = 'products';

        return ProductsModel::showProducts($table, $item, $item_value);


    }

    public function editProduct(){
        
        if (isset($_POST['edit_productCode']) && isset($_POST['edit_product_description']) && isset($_POST['edit_product_quantity'])
            && isset($_POST['edit_sale_price']) && isset($_POST['edit_purchase_price'])){

            $product_code = $_POST['edit_productCode'];
            $product_description = $_POST['edit_product_description'];
            $product_category = $_POST['edit_productCategory'];
            $product_quantity = $_POST['edit_product_quantity'];
            $sale_price = $_POST['edit_sale_price'];
            $purchase_price = $_POST['edit_purchase_price'];

            if (preg_match('/^[a-zA-Z0-9]+$/', $product_code) &&
                preg_match('/^[a-zA-Z0-9]+$/', $product_description) &&
                preg_match('/^[0-9]+$/', $product_quantity) &&
                preg_match('/^[0-9.]+$/', $sale_price) &&
                preg_match('/^[0-9.]+$/', $purchase_price)){

                $root = $_POST['edit_currentImage'];

                if(isset($_FILES['editImage']['tmp_name']) && !empty($_FILES['editImage']['tmp_name'])){

                    //get image size width and height and store them as an array
                    list($image_width, $image_height) = getimagesize($_FILES['editImage']['tmp_name']);

                    $new_imageWidth = 500;
                    $new_imageHeight = 500;

                    // create the directory in which you want to save the image
                    define('PATH', 'views/dist/img/products/');

                    $directory = PATH.$product_description;


                    //Check if the image already exists or not
                    if (!empty($root)){
                        unlink($root);
                    }
                    else{
                        //first check if the given name is a directory
                        if (!mkdir($directory, 0755) && !is_dir($directory)) {
                            throw new \RuntimeException(sprintf('Directory "%s" was not created', $directory));
                        }
                    }


                    if ($_FILES['editImage']['type'] === 'image/jpeg'){

                        $append_random_number =mt_rand(100,999);
                        $root = PATH.$product_description. '/' .$append_random_number. '.jpg';

                        $origin = imagecreatefromjpeg($_FILES['editImage']['tmp_name']);
                        $destination = imagecreatetruecolor($new_imageWidth, $new_imageHeight);

                        imagecopyresized($destination, $origin, 0, 0, 0,0,
                            $new_imageWidth, $new_imageHeight, $image_width, $image_height);

                        imagejpeg($destination, $root);

                    }

                    if ($_FILES['editImage']['type'] === 'image/png'){

                        $append_random_number =mt_rand(100,999);
                        $root = PATH.$product_description. '/' .$append_random_number. '.png';

                        $origin = imagecreatefrompng($_FILES['editImage']['tmp_name']);
                        $destination = imagecreatetruecolor($new_imageWidth, $new_imageHeight);

                        imagecopyresized($destination, $origin, 0, 0, 0,0,
                            $new_imageWidth, $new_imageHeight, $image_width, $image_height);

                        imagepng($destination, $root);

                    }


                }

                $table = 'products';

                $data = array('code'=>$product_code, 'category'=>$product_category ,'description'=>$product_description, 'quantity'=>$product_quantity, 'sale_price'=>$sale_price,
                    'purchase_price'=>$purchase_price, 'image'=>$root);

                $response = ProductsModel::editProduct($table, $data);


                if ($response === 'ok'){
                    echo '<script>

                                alert("edited");

                       </script>';
                }
                else{
                    echo '<script>
                                alert("'
                        .$response.
                        '");

                       </script>';
                }




            }
            else{
                echo '<script>
                    alert("Invalid chars");
                </script>';
            }

        }

    }


}
