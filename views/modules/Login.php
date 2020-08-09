<div class="login-box">
    <div class="login-logo">
        <a href="#"><b>Sales</b>POS</a>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
        <p class="login-box-msg">Login</p>

        <form method="post">
            <div class="form-group has-feedback">
                <input type="text" class="form-control" placeholder="Username" name="userName" required>
                <span class="glyphicon glyphicon-user form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input type="password" class="form-control" placeholder="Password" name="userPassword" required>
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
                </div>
                <!-- /.col -->
            </div>

            <?php
                $login = new UsersController();
                $login->userLogin();

            ?>

        </form>

        <a href="#">I forgot my password</a><br>

    </div>
    <!-- /.login-box-body -->
</div>
<!-- /.login-box -->