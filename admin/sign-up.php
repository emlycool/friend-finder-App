<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link type="text/css" href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link type="text/css" href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
    <link type="text/css" href="css/theme.css" rel="stylesheet">
    <link type="text/css" href="images/icons/css/font-awesome.css" rel="stylesheet">
    <link type="text/css" href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600' rel='stylesheet'>
</head>
<body>

    <div class="navbar navbar-fixed-top">
        <div class="navbar-inner">
            <div class="container">
                <a class="btn btn-navbar" data-toggle="collapse" data-target=".navbar-inverse-collapse">
                    <i class="icon-reorder shaded"></i>
                </a>

                <a class="brand" href="index.html">
                    Admin
                </a>

                <div class="nav-collapse collapse navbar-inverse-collapse">
                
                    <ul class="nav pull-right">

                        <li><a href="sign-up.php">
                            Sign Up
                        </a></li>

                        

                        <li><a href="#">
                            Forgot your password?
                        </a></li>
                    </ul>
                </div><!-- /.nav-collapse -->
            </div>
        </div><!-- /navbar-inner -->
    </div><!-- /navbar -->



    <div class="wrapper">
        <div class="container">
            <div class="row">
                <div class="module module-login span4 offset4">
                    <form class="form-vertical" action="../engine/insert.php" method="POST">
                        <div class="module-head">
                            <h3>Sign Up</h3>
                        <?php
                            
                            if (isset($_GET['err_msg'])) {
                        ?>

                        <div class="control-group" style="margin-top: 10px;">
                            <div class="controls row-fluid">
                                <input class="span12 alert alert-danger disabled" value="<?php echo $_GET['err_msg'];?>">
                            </div>
                        </div>
                        <?php
                        }
                        ?>
                        </div>
                        <div class="module-body">
                            <div class="control-group">
                                <div class="controls row-fluid">
                                    <input class="span12" type="text" name="admin_fullname" required placeholder="Input Fullname">
                                </div>
                            </div>
                            <div class="control-group">
                                <div class="controls row-fluid">
                                    <input class="span12" type="email" name="admin_email" required placeholder="Input Email">
                                </div>
                            </div>
                            <div class="control-group">
                                <div class="controls row-fluid">
                                    <input class="span12" type="password" name="admin_password" required placeholder="Password">
                                </div>
                            </div>
                        </div>
                        <div class="module-foot">
                            <div class="control-group">
                                <div class="controls clearfix">
                                    <input name="create_admin" type="submit" class="btn btn-primary pull-right" value="Sign up">   
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div><!--/.wrapper-->

    <div class="footer">
        <div class="container">
             

            <b class="copyright">&copy; 2014 Edmin - EGrappler.com </b> All rights reserved.
        </div>
    </div>
    <script src="scripts/jquery-1.9.1.min.js" type="text/javascript"></script>
    <script src="scripts/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
    <script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
</body>