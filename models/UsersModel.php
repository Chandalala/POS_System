<?php
/**
 * Created by PhpStorm.
 * User: Chandalala
 * Date: 6/3/2020
 * Time: 23:50
 */

require_once 'connection.php';

class UsersModel{

    public static function MdlShowUsers($table, $column_item, $column_value){

        $data = '';
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

    public static function mdlAddNewUser($table, array $data){

        $sql = "INSERT INTO $table(name, surname, username, password, profile, picture) VALUES (:name, :surname, :username, :password, :profile, :picture)";

        $statement = (new Connection)->connect()->prepare($sql);
        $statement->bindParam(':name', $data['name']);
        $statement->bindParam(':surname', $data['surname']);
        $statement->bindParam(':username', $data['username']);
        $statement->bindParam(':password', $data['password']);
        $statement->bindParam(':profile', $data['profile']);
        $statement->bindParam(':picture', $data['picture']);


        if ($statement->execute()){
            return 'ok';
        }

        return 'error';

    }

    public static function editUser($table, array $data){


        $sql = "UPDATE $table SET name=:name, surname=:surname, password=:password, profile=:profile, picture=:picture WHERE username=:username";

        $statement = (new Connection)->connect()->prepare($sql);
        $statement->bindParam(':name', $data['name']);
        $statement->bindParam(':surname', $data['surname']);
        $statement->bindParam(':password', $data['password']);
        $statement->bindParam(':profile', $data['profile']);
        $statement->bindParam(':picture', $data['picture']);
        $statement->bindParam(':username', $data['username']);


        if ($statement->execute()){
            return 'ok';
        }


        return 'error';

    }

    public static function updateUser($table, $column, $column_value, $id, $user_id){


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