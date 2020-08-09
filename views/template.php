<?php
/**
 * Created by PhpStorm.
 * User: Chandalala
 * Date: 12/1/2020
 * Time: 16:31
 */
session_start();
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>POS System</title>

  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="icon" href="views/dist/img/">

    <!--===================================================================
        CSS plugins
    ===================================================================-->


    <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="views/bower_components/bootstrap/dist/css/bootstrap.min.css">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="views/bower_components/font-awesome/css/font-awesome.min.css">

  <!-- Ionicons -->
  <link rel="stylesheet" href="views/bower_components/Ionicons/css/ionicons.min.css">

  <!-- Theme style -->
  <link rel="stylesheet" href="views/dist/css/AdminLTE.min.css">

  <!-- DataTables -->
  <link rel="stylesheet" href="views/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">

  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="views/dist/css/skins/_all-skins.css">

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

    <!--===================================================================
    JavaScript plugins
    ===================================================================-->


    <!-- jQuery 3 -->
    <script src="views/bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap 3.3.7 -->
    <script src="views/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>


    <!-- FastClick -->
    <script src="views/bower_components/fastclick/lib/fastclick.js"></script>

    <!-- AdminLTE App -->
    <script src="views/dist/js/adminlte.min.js"></script>

    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="views/plugins/iCheck/all.css">


</head>

<!--===================================================================
Document body
===================================================================-->

<body class="hold-transition skin-blue sidebar-collapse sidebar-mini">
<!-- Site wrapper -->

    <?php

    /*Check if user is logged in or not*/
    if (isset($_SESSION['beginSession']) && $_SESSION['beginSession'] == 'ok') {

        echo '<div class="wrapper">';

        include 'modules/Header.php';

        include 'modules/SidebarMenu.php';
        if (isset($_GET['root'])) {
            if ($_GET['root'] == "Dashboard" ||
                $_GET['root'] == "Users" ||
                $_GET['root'] == "Categories" ||
                $_GET['root'] == "Products" ||
                $_GET['root'] == "Clients" ||
                $_GET['root'] == "Sales" ||
                $_GET['root'] == "CreateSales" ||
                $_GET['root'] == "SalesReport" ||
                $_GET['root'] == "Logout") {

                include "modules/" . $_GET["root"] . ".php";
            } else {
                include 'modules/404.php';
            }
        } else {
            include 'modules/Dashboard.php';

        }

        include 'modules/Footer.php';

        echo '</div>';
    }
    else{
        include 'modules/Login.php';
    }
    ?>

<script src="views/js/Main.js"></script>
<script src="views/js/Users.js"></script>
<script src="views/js/Categories.js"></script>
<script src="views/js/Products.js"></script>

<!-- DataTables -->
<script src="views/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="views/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- iCheck 1.0.1 -->
<script src="views/plugins/iCheck/icheck.min.js"></script>

</body>
</html>


