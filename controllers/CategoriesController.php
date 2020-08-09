<?php
/**
 * Created by PhpStorm.
 * User: Chandalala
 * Date: 12/1/2020
 * Time: 23:20
 */

class CategoriesController{

    public static function readCategories($item, $item_value){
        $table = 'categories';

        return CategoriesModel::readCategories($table, $item, $item_value);
    }

    public function addCategory(){
        if (isset($_POST['newCategory'])){

            $category = $_POST['newCategory'];

            if (preg_match('/^[a-zA-Z0-9 ]+$/', $category)){

                $table = 'categories';

                $data = array('category'=>$category);

                $response = CategoriesModel::addCategory($table, $data);
                if ($response === 'ok'){

                    echo '<script>
                    //use sweetalert
                    alert("Category added")
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

    public function editCategory(){

        if (isset($_POST['editCategory'])){

            $category = $_POST['editCategory'];

            if (preg_match('/^[a-zA-Z0-9 ]+$/', $category)){

                $table = 'categories';

                $data = array('category'=>$category);

                $response = CategoriesModel::editCategory($table, $data);

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

