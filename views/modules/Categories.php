<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Categories
        </h1>
        <ol class="breadcrumb">
            <li><a href="Dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Categories</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">

                <button class="btn btn-primary" data-toggle="modal" data-target="#AddCategory_modal">Add category</button>
            </div>

            <div class="box-body">

                <!-- /.box-header -->
                <div class="box-body">
                    <table id="user_datatable" class="table table-bordered table-hover table-responsive">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Category</th>
                            <th>Actions</th>

                        </tr>
                        </thead>
                        <tbody>

                            <?php
    
                                $item = null;
                                $item_value = null;
                                $categories = CategoriesController::readCategories($item, $item_value);

                                foreach ($categories as $key => $category){
                                    echo '
                                                
                                                    <tr>
                                                        <td>'.$category['id'].'</td>
                                                        <td>'.$category['category'].'</td>
                                                        <td>
                                                           <div class="btn-group">
                                                              <button class="btn btn-warning btnEditCategory" categoryId="'.$category['id'].'" data-toggle="modal" data-target="#editCategory_modal"><i class="fa fa-pencil"></i></button>
                                                              <button class="btn btn-danger btnDeleteCategory"><i class="fa fa-times"></i></button>
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
                            <th>Categories</th>
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
<div class="modal modal fade" id="AddCategory_modal">
    <div class="modal-dialog">
        <div class="modal-content">

            <form role="form" method="post">
                <div class="modal-header bg-aqua-gradient">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title">Add category</h4>
                </div>
                <div class="modal-body">

                    <div class="box-body">

                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-th"></i></span>
                                <input type="text" class="form-control" id="inputSuccess" name="newCategory" placeholder="Category" required>
                            </div>
                        </div>



                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger pull-left text text-black" data-dismiss="modal">Discard</button>
                        <button type="submit" class="btn btn-success text text-black">Save</button>
                    </div>

                <?php
                $addCategory = new CategoriesController();
                $addCategory->addCategory();

                ?>
            </form>

        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!--MODALS-->
<div class="modal modal fade" id="editCategory_modal">
    <div class="modal-dialog">
        <div class="modal-content">

            <form role="form" method="post" >
                <div class="modal-header bg-aqua-gradient">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title">Edit category</h4>
                </div>

                <div class="modal-body">

                    <div class="box-body">

                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                <input type="text" class="form-control" id="editCategory" name="editCategory" value="" required>
                            </div>
                        </div>

                    </div>

                    <div class="modal-footer">
                    <button type="button" class="btn btn-danger pull-left text text-black" data-dismiss="modal">Discard</button>
                    <button type="submit" class="btn btn-success text text-black">Save changes</button>
                </div>

                </div>

                <?php
                $editCategory = new CategoriesController();
                $editCategory->editCategory();

                ?>
            </form>

        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->