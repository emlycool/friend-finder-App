<?php
session_start();
include_once("../engine/database.php");
  
if (!isset($_SESSION['admin_id'])) {
    header("location:login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Edmin</title>
        <link type="text/css" href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link type="text/css" href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
        <link type="text/css" href="css/theme.css" rel="stylesheet">
        <link type="text/css" href="images/icons/css/font-awesome.css" rel="stylesheet">
        <link type="text/css" href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600'
            rel='stylesheet'>
    </head>
    <body>
        <div class="navbar navbar-fixed-top">
            <div class="navbar-inner">
                <div class="container">
                    <a class="btn btn-navbar" data-toggle="collapse" data-target=".navbar-inverse-collapse">
                        <i class="icon-reorder shaded"></i></a><a class="brand" href="index.php">Edmin </a>
                    <div class="nav-collapse collapse navbar-inverse-collapse">
                        <ul class="nav nav-icons">
                            <li class="active"><a href="#"><i class="icon-envelope"></i></a></li>
                            <li><a href="#"><i class="icon-eye-open"></i></a></li>
                            <li><a href="#"><i class="icon-bar-chart"></i></a></li>
                        </ul>
                        <form class="navbar-search pull-left input-append" action="#">
                        <input type="text" class="span3">
                        <button class="btn" type="button">
                            <i class="icon-search"></i>
                        </button>
                        </form>
                        <ul class="nav pull-right">
                            <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown
                                <b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li><a href="#">Item No. 1</a></li>
                                    <li><a href="#">Don't Click</a></li>
                                    <li class="divider"></li>
                                    <li class="nav-header">Example Header</li>
                                    <li><a href="#">A Separated link</a></li>
                                </ul>
                            </li>
                            <li><a href="#">Support </a></li>
                            <li class="nav-user dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <img src="images/user.png" class="nav-avatar" />
                                <b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li><a href="#">Your Profile</a></li>
                                    <li><a href="#">Edit Profile</a></li>
                                    <li><a href="#">Account Settings</a></li>
                                    <li class="divider"></li>
                                    <li><a href="#">Logout</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <!-- /.nav-collapse -->
                </div>
            </div>
            <!-- /navbar-inner -->
        </div>
        <!-- /navbar -->
        <div class="wrapper">
            <div class="container">
                <div class="row">
                    <div class="span3">
                        <?php include_once'sidebar.php' ?>
                    </div>
                    <!--/.span3-->
                    <div class="span9">
                        <div class="content">
                            <div class="btn-controls">
                                <div class="btn-box-row row-fluid">
                                    <a href="blog.php?add_post" class="btn-box big span4"><i class=" icon-plus"></i><h6>Authorized admin only</h6>
                                        <b class="text-muted">
                                            Add post</b>
                                    </a><a href="#" class="btn-box big span4"><i class="icon-edit"></i><h6>Only post added by you can be edited</h6>
                                        <p class="text-muted">
                                            Edit Post</p>
                                    </a><a href="#" class="btn-box big span4"><i class="icon-remove"></i><h6>Only post added by you can be edited</h6>
                                        <p class="text-muted">
                                            Remove Post</p>
                                    </a><a href="blog.php?add_category" class="btn-box big span4"><i class=" icon-plus"></i><h6>Authorized admin only</h6>
                                        <b class="text-muted">
                                            Add Category</b>
                                    </a><a href="blog.php?add_category" class="btn-box big span4"><i class=" icon-edit"></i><h6>Authorized admin only</h6>
                                        <b class="text-muted">
                                            Change Category</b>
                                    </a>
                                </div>
                                
                            <!--/add post section-->
                            <?php
                            if(isset($_GET['message'])){
                            ?>
                            <div class="control-group" style="margin-top: 10px;">
                                <div class="controls row-fluid">
                                    <input class="span12 alert alert-sucess disabled" value="<?php echo $_GET['message'];?>">
                                </div>
                            </div>
                            <?php
                            }
                            if(isset($_GET['add_post'])){


                            ?>
                            <div class="module">
                                <div class="module-head">
                                    <h3>Add Post</h3>
                                </div>
                                <div class="module-body">
                                    <form action="../engine/insert.php" method="POST"  enctype="multipart/form-data">
                                        <div class="module-body">
                                            <div class="control-group">
                                                <div class="controls row-fluid">
                                                    <input class="span8" type="text"  name="blog_title" required placeholder="Input Title">
                                                </div>
                                            </div>
                                            <div class="module-body">
                                            <div class="control-group">
                                                <div class="controls row-fluid">
                                                    <select required name="category">
                                                        <option class="disabled">Select category</option>
                                                        <?php 
                                                        $category_sql = "SELECT DISTINCT category FROM blog_category";
                                                        $sql_exe = mysqli_query($mycon, $category_sql);
                                                        while ( $bring = mysqli_fetch_array($sql_exe)) {
                                                        ?>
                                                        <option value="<?php echo $bring['category']; ?>"><?php echo $bring['category']; ?></option>
                                                      <?php      
                                                        }

                                                      ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                            <div class="control-group">
                                                <div class="controls row-fluid">
                                                    <textarea class="span8" type="text" rows="5" name="blog_content" required placeholder="Input Content"></textarea>
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <div class="controls row-fluid">
                                                    <input class="span8 form-control" type="file" name="blog_img" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="module-foot">
                                            <div class="control-group">
                                                <div class="controls clearfix">
                                                    <input name="add_blog_post" type="submit" class="btn btn-primary pull-left" value="ADD POST">   
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                           <?php
                            }
                           ?>
        <!--/add post section-->
        <!-- add cartegory section -->
        
                            <?php
                            if(isset($_GET['add_category'])){


                            ?>
                            <div class="module">
                                <div class="module-head">
                                    <h3>Add Cartegory</h3>
                                </div>
                                <div class="module-body">
                                    <form action="../engine/insert.php" method="POST">
                                        <div class="module-body">
                                            <div class="control-group">
                                                <div class="controls row-fluid">
                                                    <input class="span8" type="text"  name="blog_category" required placeholder="Input New Cartegory">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="module-foot">
                                            <div class="control-group">
                                                <div class="controls clearfix">
                                                    <input name="add_blog_category" type="submit" class="btn btn-primary pull-left" value="ADD CATEGORY">   
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                           <?php
                            }
                           ?>
        <!--/.wrapper-->
       
        <script src="scripts/jquery-1.9.1.min.js" type="text/javascript"></script>
        <script src="scripts/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
        <script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="scripts/flot/jquery.flot.js" type="text/javascript"></script>
        <script src="scripts/flot/jquery.flot.resize.js" type="text/javascript"></script>
        <script src="scripts/datatables/jquery.dataTables.js" type="text/javascript"></script>
        <script src="scripts/common.js" type="text/javascript"></script>
      
    </body>
