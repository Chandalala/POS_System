<?php
/**
 * Created by PhpStorm.
 * User: Chandalala
 * Date: 6/3/2020
 * Time: 23:51
 */

require_once 'connection.php';


class CategoriesModel{

    public static function addCategory($table, array $data){

        $sql = "INSERT INTO $table(category) VALUES (:category)";

        $statement = (new Connection)->connect()->prepare($sql);
        $statement->bindParam(':category', $data['category']);

        if ($statement->execute()){
            return 'ok';
        }

        return 'error';
    }

    public static function readCategories($table, $column_item, $column_value){

        if ($column_item !== null && $column_value != null){

            $sql="SELECT * FROM $table WHERE $column_item = :$column_item";
            $statement = (new Connection)->connect()->prepare($sql);
            $statement->bindParam(':'.$column_item, $column_value);
            $statement->execute();

            $data=$statement->fetch();

        }
        else{
            $sql="SELECT * FROM $table";
            $statement = (new Connection)->connect()->query($sql);

            $data=$statement->fetchAll();
        }



        return $data;

    }

    public static function editCategory($table, array $data){

        $sql = "UPDATE $table SET category=:category";

        $statement = (new Connection)->connect()->prepare($sql);
        $statement->bindParam(':category', $data['category']);

        if ($statement->execute()){
            return 'ok';
        }


        return 'error';

    }
}