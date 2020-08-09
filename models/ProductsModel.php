<?php
/**
 * Created by PhpStorm.
 * User: Chandalala
 * Date: 6/3/2020
 * Time: 23:50
 */

require_once 'connection.php';

class ProductsModel{

    public static function showProducts($table, $column_item, $column_value){

        $data = '';
        if ($column_item !== null && $column_value != null){

            $sql="SELECT * FROM $table WHERE $column_item = :$column_item";
            $statement = (new Connection)->connect()->prepare($sql);
            $statement->bindParam(':'.$column_item, $column_value);
            $statement->execute();

            $data=$statement->fetch();

        }
        else{
            $table2='categories';

            $sql="SELECT * FROM $table JOIN $table2 ON $table.category_id=$table2.id";
            $statement = (new Connection)->connect()->query($sql);

            $data=$statement->fetchAll();
        }



        return $data;

    }

    public static function addProduct($table, array $data){


        $sql = "INSERT INTO $table(code, description, category, stock, sale_price, purchase_price, image) VALUES (:code, :description, :category, :stock, :sale_price, :purchase_price, :image)";

        $statement = (new Connection)->connect()->prepare($sql);
        $statement->bindParam(':code', $data['code']);
        $statement->bindParam(':description', $data['description']);
        $statement->bindParam(':category', $data['category']);
        $statement->bindParam(':stock', $data['stock']);
        $statement->bindParam(':sale_price', $data['sale_price']);
        $statement->bindParam(':purchase_price', $data['purchase_price']);
        $statement->bindParam(':image', $data['image']);


        if ($statement->execute()){
            return 'ok';
        }

        return $statement->errorCode();

    }

    public static function editProduct($table, array $data){


        $sql = "UPDATE $table SET code=:code, description=:description, category=:category, stock=:stock, sale_price=:sale_price, purchase_price=:purchase_price, image=:image WHERE code=:code";

        $statement = (new Connection)->connect()->prepare($sql);
        $statement->bindParam(':code', $data['code']);
        $statement->bindParam(':description', $data['description']);
        $statement->bindParam(':category', $data['category']);
        $statement->bindParam(':stock', $data['quantity']);
        $statement->bindParam(':sale_price', $data['sale_price']);
        $statement->bindParam(':purchase_price', $data['purchase_price']);
        $statement->bindParam(':image', $data['image']);


        if ($statement->execute()){
            return 'ok';
        }

        return $statement->errorCode();

    }

    public static function updateProduct($table, $column, $column_value, $id, $user_id){


        $sql = "UPDATE $table SET $column=:$column WHERE $id=:$id";

        $statement = (new Connection)->connect()->prepare($sql);
        $statement->bindParam(':'.$column, $column_value);
        $statement->bindParam(':'.$id, $user_id);

        if ($statement->execute()){
            return 'ok';
        }


        return 'error';

    }



}