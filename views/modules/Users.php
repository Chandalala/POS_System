<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Manage users
        </h1>
        <ol class="breadcrumb">
            <li><a href="Dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">User management</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">

                <button class="btn btn-primary" data-toggle="modal" data-target="#AddUser_modal">Add user</button>
            </div>

            <div class="box-body">

                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="user_datatable" class="table table-bordered table-hover table-responsive">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Surname</th>
                                    <th>User</th>
                                    <th>Image</th>
                                    <th>Profile</th>
                                    <th>Status</th>
                                    <th>Last login</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php

                                    $item = null;
                                    $item_value = null;
                                    $users =UsersController::readUsers($item, $item_value);

                                    foreach ($users as $key => $user){
                                        echo '
                                        
                                            <tr>
                                                <td>'.$user['id'].'</td>
                                                <td>'.$user['name'].'</td>
                                                <td>'.$user['surname'].'</td>
                                                <td>'.$user['username'].'</td>';
                                                
                                                if($user['picture'] !== null){

                                                    echo '

                                                       <td><a href="#"><img src="'.$user['picture'].'" width="40px"></a></td>
                                                    
                                                    ';
                                                }
                                                else{
                                                    echo '

                                                       <td><a href="#"><img src="views\dist\img\avatar.png" width="40px"></a></td>
                                                    
                                                    ';
                                                };

                                                echo '<td>'.$user['profile'].'</td>';

                                                if ($user['status'] != 0){
                                                    echo '<td><button class="btn btn-success btn-xs btnActivate" userid="'.$user['id'].'" userStatus="0">Activated</button></td>';
                                                }
                                                else{
                                                    echo '<td><button class="btn btn-danger btn-xs btnActivate" userid="'.$user['id'].'" userStatus="1">De-Activated</button></td>';
                                                }


                                                    echo '<td>'.$user['last_login'].'</td>
                                                    <td>
                                                        <div class="btn-group">
                                                            <button class="btn btn-warning btnEditUser" userId="'.$user['id'].'" data-toggle="modal" data-target="#editUser_modal"><i class="fa fa-pencil"></i></button>
                                                            <button class="btn btn-danger btnDeleteUser"><i class="fa fa-times"></i></button>
                                                        </div>
                                                    </td>
                                                    </tr>
                                        
                                                ';
                                    }


                                ?>


                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Surname</th>
                                    <th>User</th>
                                    <th>Image</th>
                                    <th>Profile</th>
                                    <th>Status</th>
                                    <th>Last login</th>
                                    <th>Actions</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <!-- /.box-body -->

            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->


<!--MODALS-->
<div class="modal modal fade" id="AddUser_modal">
    <div class="modal-dialog">
        <div class="modal-content">

            <form role="form" method="post" enctype="multipart/form-data">
                <div class="modal-header bg-aqua-gradient">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title">Add new user</h4>
                </div>
                <div class="modal-body">

                    <div class="box-body">

                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                <input type="text" class="form-control" id="inputSuccess" name="newName" placeholder="Name" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                <input type="text" class="form-control" id="inputSuccess" name="newSurname" placeholder="Surname" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                <input type="text" class="form-control" id="username" name="username" placeholder="Username" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                <input type="text" class="form-control" id="inputSuccess" name="password" placeholder="Password" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-users"></i></span>
                                <select class="form-control" name="userProfile">
                                    <option value="">Select profile</option>
                                    <option value="Super Administrator">Super Administrator</option>
                                    <option value="Administrator">Administrator</option>
                                    <option value="Seller">Seller</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">

                            <div class="panel">UPLOAD IMAGE</div>

                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-image"></i></span>
                                <input type="file" class="form-control newImage" name="newImage">
                            </div>

                            <p>10mb max image size</p>
                            <img src="views/dist/img/avatar.png" width="100px" class="img-thumbnail preview">
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger pull-left text text-black" data-dismiss="modal">Discard</button>
                    <button type="submit" class="btn btn-success text text-black">Save</button>
                </div>

                <?php
                    $editUser = new UsersController();
                    $editUser->createUser();

                ?>
            </form>

        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!--MODALS-->
<div class="modal modal fade" id="editUser_modal">
    <div class="modal-dialog">
        <div class="modal-content">

            <form role="form" method="post" enctype="multipart/form-data">
                <div class="modal-header bg-aqua-gradient">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title">Edit user</h4>
                </div>
                <div class="modal-body">

                    <div class="box-body">

                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                <input type="text" class="form-control" id="editName" name="editName" value="" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                <input type="text" class="form-control" id="editSurname" name="editSurname" value="" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                <input readonly type="text" class="form-control" id="editUsername" name="editUsername" value="" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                <input type="password" class="form-control" id="editPassword" name="editPassword" placeholder="New password" >
                                <input type="hidden" id="currentPassword" name="currentPassword">

                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-users"></i></span>
                                <select class="form-control" name="editProfile">
                                    <option value="" id="editProfile"></option>
                                    <option value="Super Administrator">Super Administrator</option>
                                    <option value="Administrator">Administrator</option>
                                    <option value="Seller">Seller</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">

                            <div class="panel">UPLOAD IMAGE</div>

                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-image"></i></span>
                                <input type="file" class="form-control newImage" name="editImage">
                            </div>

                            <p>10mb max image size</p>
                            <img src="views/dist/img/avatar.png" id="editImage" width="100px" class="img-thumbnail preview">
                            <input type="hidden" name="currentImage" id="currentImage">
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger pull-left text text-black" data-dismiss="modal">Discard</button>
                    <button type="submit" class="btn btn-success text text-black">Save changes</button>
                </div>

                <?php
                $editUser = new UsersController();
                $editUser->editUser();

                ?>
            </form>

        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->