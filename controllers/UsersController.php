<?php
/**
 * Created by PhpStorm.
 * User: Chandalala
 * Date: 12/1/2020
 * Time: 23:20
 */

class UsersController{


    public function __construct(){

    }

    public function userLogin(){
        if (isset($_POST['userName'])){
            /*to prevent sql injection*/
            if (preg_match('/^[a-zA-Z0-9]+$/', $_POST['userName']) &&
                preg_match('/^[a-zA-Z0-9]+$/', $_POST['userPassword'])){


                $username = $_POST['userName'];
                $password = $_POST['userPassword'];
                $table = 'users';
                $column_item = 'username';
                $column_value = $username;

                $encrypted_password = crypt($password, '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');


                $response = UsersModel::MdlShowUsers($table, $column_item, $column_value);

                if($response['username'] === $username && $response['password'] === $encrypted_password){

                    if ($response['status'] == 1){
                        $_SESSION['beginSession'] = 'ok';
                        $_SESSION['id'] = $response['id'];
                        $_SESSION['name'] = $response['name'];
                        $_SESSION['surname'] = $response['surname'];
                        $_SESSION['username'] = $response['username'];
                        $_SESSION['image'] = $response['picture'];
                        $_SESSION['profile'] = $response['profile'];

                        date_default_timezone_set('Africa/Harare');
                        $date=date('Y-m-d');
                        $hour=date('H:i:s');

                        $column='last_login';
                        $last_login=$date.' '.$hour;


                        $response = UsersModel::updateUser($table, $column, $last_login, $column_item, $column_value);


                        echo '<script>
                            window.location = "Dashboard";
                        </script>';
                    }
                    else{
                        echo '<script>
                            alert("You are not authorised to use this system")
                        </script>';
                    }



                }
                else{
                    echo '<br><p class="text text-danger">
                        Login failed
                    </p>';
                }


            }
        }
    }

    public function createUser(){

        if (isset($_POST['newName']) && isset($_POST['newSurname']) && isset($_POST['username'])
            && isset($_POST['password']) && isset($_POST['userProfile'])){

            $name = $_POST['newName'];
            $surname = $_POST['newSurname'];
            $username = $_POST['username'];
            $password = $_POST['password'];
            $profile = $_POST['userProfile'];

            if (preg_match('/^[a-zA-Z0-9]+$/', $name) &&
                preg_match('/^[a-zA-Z0-9]+$/', $surname) &&
                preg_match('/^[a-zA-Z0-9]+$/', $username) &&
                preg_match('/^[a-zA-Z0-9]+$/', $password) &&
                preg_match('/^[a-zA-Z0-9 ]+$/', $profile)){

                $root = "";

                if(isset($_FILES['newImage']['tmp_name'])){

                    //get image size width and height and store them as an array
                    list($image_width, $image_height) = getimagesize($_FILES['newImage']['tmp_name']);

                    $new_imageWidth = 500;
                    $new_imageHeight = 500;

                    // create the directory in which you want to save the image
                    define('PATH', 'views/dist/img/users/');

                    $directory = PATH.$username;

                    //first check if the given name is a directoy
                    if (!mkdir($directory, 0755) && !is_dir($directory)) {
                        throw new \RuntimeException(sprintf('Directory "%s" was not created', $directory));
                    }

                    if ($_FILES['newImage']['type'] === 'image/jpeg'){

                        $append_random_number =mt_rand(100,999);
                        $root = PATH.$username. '/' .$append_random_number. '.jpg';

                        $origin = imagecreatefromjpeg($_FILES['newImage']['tmp_name']);
                        $destination = imagecreatetruecolor($new_imageWidth, $new_imageHeight);

                        imagecopyresized($destination, $origin, 0, 0, 0,0,
                            $new_imageWidth, $new_imageHeight, $image_width, $image_height);

                        imagejpeg($destination, $root);

                    }

                    if ($_FILES['newImage']['type'] === 'image/png'){

                        $append_random_number =mt_rand(100,999);
                        $root = PATH.$username. '/' .$append_random_number. '.png';

                        $origin = imagecreatefrompng($_FILES['newImage']['tmp_name']);
                        $destination = imagecreatetruecolor($new_imageWidth, $new_imageHeight);

                        imagecopyresized($destination, $origin, 0, 0, 0,0,
                            $new_imageWidth, $new_imageHeight, $image_width, $image_height);

                        imagepng($destination, $root);

                    }


                }

                $table = 'users';

                $encrypted_password = crypt($password, '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

                $data = array('name'=>$name, 'surname'=>$surname, 'username'=>$username, 'password'=>$encrypted_password,
                    'profile'=>$profile, 'picture'=>$root);
                $response = UsersModel::mdlAddNewUser($table, $data);
                if ($response === 'ok'){

                    echo '<script>
                    //use sweetalert
                    alert("User added")
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

    public static function readUsers($item, $item_value){

        $table = 'users';

        $response = UsersModel::MdlShowUsers($table, $item, $item_value);

        return $response;


    }

    public function editUser(){

        if (isset($_POST['editUsername'])){

            $name = $_POST['editName'];
            $surname = $_POST['editSurname'];
            $username = $_POST['editUsername'];
            $password = $_POST['editPassword'];
            $profile = $_POST['editProfile'];
            $encrypted_password = '';

            if (preg_match('/^[a-zA-Z0-9]+$/', $name) &&
                preg_match('/^[a-zA-Z0-9]+$/', $surname) &&
                preg_match('/^[a-zA-Z0-9]+$/', $username) &&
                preg_match('/^[a-zA-Z0-9 ]+$/', $profile)){



                $root = $_POST['currentImage'];

                if(isset($_FILES['editImage']['tmp_name']) && !empty($_FILES['editImage']['tmp_name'])){

                    //get image size width and height and store them as an array
                    list($image_width, $image_height) = getimagesize($_FILES['editImage']['tmp_name']);

                    $new_imageWidth = 500;
                    $new_imageHeight = 500;

                    // create the directory in which you want to save the image
                    define('PATH', 'views/dist/img/users/');

                    $directory = PATH.$username;


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
                        $root = PATH.$username. '/' .$append_random_number. '.jpg';

                        $origin = imagecreatefromjpeg($_FILES['editImage']['tmp_name']);
                        $destination = imagecreatetruecolor($new_imageWidth, $new_imageHeight);

                        imagecopyresized($destination, $origin, 0, 0, 0,0,
                            $new_imageWidth, $new_imageHeight, $image_width, $image_height);

                        imagejpeg($destination, $root);

                    }

                    if ($_FILES['editImage']['type'] === 'image/png'){

                        $append_random_number =mt_rand(100,999);
                        $root = PATH.$username. '/' .$append_random_number. '.png';

                        $origin = imagecreatefrompng($_FILES['editImage']['tmp_name']);
                        $destination = imagecreatetruecolor($new_imageWidth, $new_imageHeight);

                        imagecopyresized($destination, $origin, 0, 0, 0,0,
                            $new_imageWidth, $new_imageHeight, $image_width, $image_height);

                        imagepng($destination, $root);

                    }


                }

                $table = 'users';

                if ($password !== ''){

                    if (preg_match('/^[a-zA-Z0-9]+$/', $password)){
                        $encrypted_password = crypt($password, '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

                    }
                    else{
                        echo '<script>

                            alert("Error");
                            
                        </script>';
                    }
                }
                else{
                    $encrypted_password = $_POST['currentPassword'];
                }


                $data = array('name'=>$name, 'surname'=>$surname, 'username'=>$username, 'password'=>$encrypted_password,
                    'profile'=>$profile, 'picture'=>$root);


                $response = UsersModel::editUser($table, $data);


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
