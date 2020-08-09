<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Manage products
        </h1>
        <ol class="breadcrumb">
            <li><a href="Dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Product management</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">

                <button class="btn btn-primary" data-toggle="modal" data-target="#addProduct_modal">Add product</button>
            </div>

            <div class="box-body">

                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="product_datatable" class="table table-bordered table-hover table-responsive">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Code</th>
                                    <th>Image</th>
                                    <th>Description</th>
                                    <th>Category</th>
                                    <th>Stock</th>
                                    <th>Sale price</th>
                                    <th>Purchase price</th>
                                    <th>Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php

                                    $item = null;
                                    $item_value = null;
                                    $products = (new ProductsController)->readProducts($item, $item_value);

                                    foreach ($products as $key => $product){
                                        echo '
                                        
                                            <tr>
                                                <td>'.$product['id'].'</td>
                                                <td>'.$product['code'].'</td>';
                                                if($product['image'] !== null){

                                                    echo '        
                                                               <td><a href="#"><img src="'.$product['image'].'" width="40px"></a></td>                                                            
                                                            ';
                                                }
                                                else{
                                                    echo '
                                                               <td><a href="#"><img src="views\dist\img\avatar.png" width="40px"></a></td>
                                                            ';
                                                }
                                                echo '<td>'.$product['description'].'</td>';
                                                echo '<td>'.$product['category'].'</td>';
                                                if ($product['stock'] >= 100){
                                                    echo '<td><button class="btn btn-xs btn-success btnStock" productStock="'.$product['stock'].'" productId="'.$product['id'].'">'.$product['stock'].'</button></td>';
                                                }
                                                else{
                                                    echo '<td><button class="btn btn-xs btn-danger btnStock" productStock="'.$product['stock'].'" productId="'.$product['id'].'">'.$product['stock'].'</button></td>';
                                                }
                                                echo
                                                '<td>'.$product['sale_price'].'</td>
                                                <td>'.$product['purchase_price'].'</td>
                                                <td>'.$product['date_created'].'</td>
                                                <td>
                                                  <div class="btn-group">
                                                    <button class="btn btn-warning btnEditProduct" productId="'.$product['id'].'" data-toggle="modal" data-target="#editProduct_modal"><i class="fa fa-pencil"></i></button>
                                                    <button class="btn btn-danger btnDeleteProduct"><i class="fa fa-times"></i></button>
                                                   </div>
                                                </td>
                                            </tr>';
                                    }

                                ?>


                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Code</th>
                                    <th>Image</th>
                                    <th>Description</th>
                                    <th>Category</th>
                                    <th>Stock</th>
                                    <th>Sale price</th>
                                    <th>Purchase price</th>
                                    <th>Date</th>
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
<div class="modal modal fade" id="addProduct_modal">
    <div class="modal-dialog">
        <div class="modal-content">

            <form role="form" method="post" enctype="multipart/form-data">

                <div class="modal-header bg-aqua-gradient">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title">Add new product</h4>
                </div>
                <div class="modal-body">

                    <div class="box-body">

                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-barcode"></i></span>
                                <input type="text" class="form-control" id="inputSuccess" name="productCode" placeholder="Bar code" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-product-hunt"></i></span>
                                <input type="text" class="form-control" id="product_description" name="product_description" placeholder="Description" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-list"></i></span>
                                <select class="form-control" name="product_category">
                                    <option value="">Select category</option>
                                    <?php
                                        $products = (new ProductsController)->readProducts($item, $item_value);
                                        foreach ($products as $product){
                                            echo '<option value="'.$product['category'].'">'.$product['category'].'</option>';
                                        }

                                    ?>

                                </select>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-stop-circle"></i></span>
                                <input type="number" min="0" class="form-control" id="inputSuccess" name="quantity" placeholder="Quantity" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-xs-6">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-sellsy"></i></span>
                                    <input type="number" step="any" min="0" class="form-control" id="sale_price" name="sale_price" placeholder="Sale price" required>
                                </div>
                            </div>
                            <div class="col-xs-6">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-sellsy"></i></span>
                                    <input type="number" step="any" min="0" class="form-control" id="purchase_price" name="purchase_price" placeholder="Purchase price" required>
                                </div>
                            </div>
                            <div class="col-xs-6">
                                <div class="form-group">
                                    <label>
                                    <input type="checkbox" min="0" class="minimal percentage" checked>
                                        Use percentage
                                    </label>
                                </div>
                            </div>
                            <div class="col-xs-6">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-sellsy"></i></span>
                                    <input type="number" min="0" class="form-control input-lg newPercentage" value="40" required>
                                    <span class="input-group-addon"><i class="fa fa-percent"></i></span>
                                </div>
                            </div>

                        </div>

                        <div class="form-group">

                            <div class="panel">UPLOAD IMAGE</div>

                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-image"></i></span>
                                <input type="file" class="form-control newImage" name="newImage">
                            </div>

                            <p>10mb max image size</p>
                            <img src="views/dist/img/avatar.png" width="100px" class="img-thumbnail preview" alt="">
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger pull-left text text-black" data-dismiss="modal">Discard</button>
                    <button type="submit" class="btn btn-success text text-black">Save</button>
                </div>

                <?php
                    $productController = new ProductsController();
                    $productController->createProduct();
                ?>

            </form>

        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!--MODALS-->
<div class="modal modal fade" id="editProduct_modal">
    <div class="modal-dialog">
        <div class="modal-content">

            <form role="form" method="post" enctype="multipart/form-data">
                <div class="modal-header bg-aqua-gradient">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title">Edit product</h4>
                </div>
                <div class="modal-body">

                    <div class="box-body">
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-barcode"></i></span>
                                <input type="text" class="form-control" id="edit_productCode" name="edit_productCode" value="" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-product-hunt"></i></span>
                                <input type="text" class="form-control" id="edit_product_description" name="edit_product_description" value="" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-list"></i></span>
                                <select class="form-control" name="edit_productCategory">
                                    <option value="" id="edit_productCategory"></option>
                                    <?php
                                        $products = (new ProductsController)->readProducts($item, $item_value);
                                        foreach ($products as $product){
                                            echo '<option value="'.$product['category'].'">'.$product['category'].'</option>';
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-stop-circle"></i></span>
                                <input type="number" min="0" class="form-control" id="edit_product_quantity" name="edit_product_quantity" value="" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-sellsy"></i></span>
                                <input type="number" step="any" min="0" class="form-control" id="edit_sale_price" name="edit_sale_price" value="" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-sellsy"></i></span>
                                <input type="number" step="any" min="0" class="form-control" id="edit_purchase_price" name="edit_purchase_price" value="" required>
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
                            <input type="hidden" name="edit_currentImage" id="edit_currentImage">
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger pull-left text text-black" data-dismiss="modal">Discard</button>
                    <button type="submit" class="btn btn-success text text-black">Save changes</button>
                </div>

                <?php
                $productController = new ProductsController();
                $productController->editProduct();

                ?>
            </form>

        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->