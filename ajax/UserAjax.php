<?php
/**
 * Created by PhpStorm.
 * User: Chandalala
 * Date: 8/3/2020
 * Time: 18:31
 */

require_once '../controllers/UsersController.php';
require_once '../models/UsersModel.php';


class UserAjax{

    public $userId;

    public function getUser(){

        $item = 'id';
        $item_value = $this->userId;
        $response = UsersController::readUsers($item, $item_value);

        echo json_encode($response);


    }

    public $user_id;
    public $userStatus;

    public function ajax_activateUser(){

        $table ='users';
        $column_status='status';
        $user_status = $this->userStatus;
        $id='id';
        $user_id=$this->user_id;

        $response = UsersModel::updateUser($table, $column_status, $user_status, $id, $user_id);


        echo json_encode($response);


    }

    public $username;

    public function checkIfUsernameExists(){

        $item = 'username';
        $item_value = $this->username;
        $response = UsersController::readUsers($item, $item_value);

        echo json_encode($response);


    }



}


//Edit user

if (isset($_POST['userId'])){

    $edit = new UserAjax();
    $edit->userId = $_POST['userId'];
    $edit->getUser();

}

//Activate user

if (isset($_POST['userStatus'])){

    $userAjax = new UserAjax();
    $userAjax->userStatus = $_POST['userStatus'];
    $userAjax->user_id = $_POST['userId'];
    $userAjax->ajax_activateUser();

}



//Check if username is already used

if (isset($_POST['username'])){

    $userAjax = new UserAjax();
    $userAjax->username = $_POST['username'];
    $userAjax->checkIfUsernameExists();

}
