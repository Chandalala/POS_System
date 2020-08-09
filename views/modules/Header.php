<header class="main-header">

    <!--LOGO-->
    <a href="Dashboard" class="logo">

        <!--Mini logo-->
        <span class="logo-mini"><b>A</b>LT</span>

        <!--Normal logo-->
        <span class="logo-lg"><b>Admin</b>LTE</span>

    </a>

    <!--    Navigation bar-->
    <nav class="navbar navbar-static-top" role="navigation">

        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </a>

        <!-- User profile -->
        <div class="navbar-custom-menu">

            <ul class="nav navbar-nav">
                <!-- User Account: style can be found in dropdown.less -->
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">

                        <?php
                            if ($_SESSION['image'] !== '' ){
                                echo '<img src="'.$_SESSION["image"].'" class="user-image" alt="User Image">';
                            }
                            else{
                                echo '<img src="views/dist/img/user2-160x160.jpg" class="user-image" alt="User Image">';
                            }
                            
                        ?>

                        <span class="hidden-xs"><?php echo $_SESSION['name']. ' ' .$_SESSION['surname']; ?></span>
                    </a>
                    <!--Dropdown toggle-->
                    <ul class="dropdown-menu">

                        <li class="user-body">
                            <div class="pull-right">
                                <a href="Logout" class="btn btn-default btn-flat">Sign out</a>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>

        </div>




    </nav>

</header>