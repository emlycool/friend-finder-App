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
                                <article class="list-group-item">
                                    <div class="alert alert-primary">
                                        <a aria-expanded="true" href="#" data-target="#collapse1" data-toggle="collapse">
                                            <i class="icon-action fa fa-chevron-down"></i>
                                            <h6 class="title">PRODUCTS </h6>
                                        </a>
                                    </div>
                                    <div class="filter-content collapse show" id="collapse1">           
                                        <div class="btn-box-row row-fluid">
                                            <a href="ecommerce.php?add_product" class="btn-box big span4"><i class=" icon-plus"></i><h6>Authorized admin only</h6>
                                                <b class="text-muted">
                                                    Add Product</b>
                                            </a>
                                            <a href="#" class="btn-box big span4"><i class="icon-edit"></i><h6>Only Product added by you can be edited</h6>
                                                <p class="text-muted">
                                                    Edit Product</p>
                                            </a>
                                            <a href="#" class="btn-box big span4"><i class="icon-remove"></i><h6>Only Product added by you can be edited</h6>
                                                <p class="text-muted">
                                                    Remove Product</p>
                                            </a>
                                        </div>
                                    </div> <!-- collapse -filter-content  .// -->
                                </article>
                                <article class="list-group-item">
                                    <div class="alert alert-primary">
                                        <a aria-expanded="true" href="#" data-target="#collapse2" data-toggle="collapse">
                                            <i class="icon-action fa fa-chevron-down"></i>
                                            <h6 class="title">CATEGORY </h6>
                                        </a>
                                    </div>
                                    <div class="filter-content collapse show" id="collapse2">
                                        <div class="btn-box-row row-fluid">
                                            <a href="ecommerce.php?add_category" class="btn-box big span4"><i class=" icon-plus"></i><h6>Authorized admin only</h6>
                                                <b class="text-muted">
                                                    Add Category</b>
                                            </a>
                                            <a href="ecommerce.php?add_subcategory" class="btn-box big span4"><i class=" icon-plus"></i><h6>Authorized admin only</h6>
                                                <b class="text-muted">
                                                    Add Subcategory</b>
                                            </a>
                                            <a href="ecommerce.php?add_leastcategory" class="btn-box big span4"><i class=" icon-plus"></i><h6>Authorized admin only</h6>
                                                <b class="text-muted">
                                                    Add Leastcategory</b>
                                            </a>
                                            
                                        </div>
                                        <div class="btn-box-row row-fluid">
                                            <a href="ecommerce.php?add_category" class="btn-box big span4"><i class=" icon-edit"></i><h6>Authorized admin only</h6>
                                                <b class="text-muted">
                                                    Change Category / Subcategory</b>
                                            </a>
                                        </div>
                                    </div>
                                </article>
                                <article class="list-group-item">
                                    <div class="alert alert-primary">
                                        <a aria-expanded="true" href="#" data-target="#collapse3" data-toggle="collapse">
                                            <i class="icon-action fa fa-chevron-down"></i>
                                            <h6 class="title">BANNERS & IMAGES</h6>
                                        </a>
                                    </div>
                                    <div class="filter-content collapse show" id="collapse3">
                                        <div class="btn-box-row row-fluid">
                                            <a href="ecommerce.php?add_img" class="btn-box big span4"><i class=" icon-plus"></i><h6>Authorized admin only</h6>
                                                <b class="text-muted">Add Site Images</b>
                                            </a>                                   
                                        </div>
                                    </div>
                                </article>
                            <!--/add Product section-->
                            <?php
                            if(isset($_GET['message'])){
                            ?>
                            <div class="control-group" style="margin-top: 10px;">
                                <div class="controls row-fluid">
                                    <input class="span12 alert alert-success disabled" value="<?php echo $_GET['message'];?>">
                                </div>
                            </div>
                            <?php
                            }
                            if(isset($_GET['add_product'])){


                            ?>
                            <div class="module">
                                <div class="module-head">
                                    <h3>Add Product</h3>
                                </div>
                                <div class="module-body">
                                    <form action="../engine/insert.php" method="POST"  enctype="multipart/form-data">
                                        <div class="module-body">
                                            <div class="control-group">
                                                <div class="controls row-fluid">
                                                    <label>Name & pricing</label>
                                                    <input class="span12" type="text"  name="p_name" required placeholder="Input product name" maxlength="100">
                                                    <input class="span4" type="number" name="p_price" required placeholder="Input actual price" maxlength="6">
                                                    <input class="span4" type="number" name="p_discount" required placeholder="Input discount on price" maxlength="2">
                                                    <label>Color</label>

                                                    <div class="radio">
                                                        <label><input type="radio" name="colradio" id="radio1" onClick="check();" value="input">Input Color</label>
                                                        <input class="span8" type="text" name="p_col_input" id="pass1" style="display: none;" placeholder="add '/' to multiple colors">
                                                
                                                        <label><input type="radio" name="colradio" id="radio2" onClick="check();" value="pick">Select color</label>
                                                        <div class="container-fluid" id="pass2" style="display: none;">
                                                            <label><input type="checkbox" name="pick_color[]" id="radio2" onClick="check();" value="blue"> Blue</label>
                                                            <label><input type="checkbox" name="pick_color[]" id="radio2" onClick="check();" value="black"> Black</label>
                                                            <label><input type="checkbox" name="pick_color[]" id="radio2" onClick="check();" value="silver"> Silver</label>
                                                        </div>
                                                    </div>

                                                </div>
                                                <hr>
                                                <label><h6>Category:</h6></label>
                                                <label><input type="radio" name="radiocat" id="catradio1" onClick="cat();" value="yes" required> Choose existing category</label>
                                                <label><input type="radio" name="radiocat" id="catradio2" onClick="cat();" value="no" required> No category</label>
                                                <div class="control row-fluid" id="catpass1" style="display: none;">
                                                    <select class="span4" name="m_cat" id="major_cat">
                                                        <option selected disabled>Major category</option>
                                                        <?php
                                                        $sql_ec = "SELECT * FROM ec_category";
                                                        $sql_ec_ini = $mycon2->query($sql_ec);
                                                        while ($cat= mysqli_fetch_array($sql_ec_ini) ) {
                                                        ?> 
                                                        <option value="<?php echo $cat['id']; ?>"><?php echo $cat['m_cat'] ?></option>   
                                                        <?php
                                                        }
                                                        ?>
                                                    </select>
                                                   
                                                    <select  name="s_cat" id="sub_cat">
                                                        <option selected disabled>Sub category</option>
                                                    
                                                    </select>
                                                    
                                                    <select class="span4" name="l_cat" id="least_cat">
                                                        <option selected disabled>Least category</option>
                                                        
                                                    </select>
                                                </div>
                                            </div>
                                            <br>
                                                
                                            <div class="control-group">
                                                <label><h6>Description & image:</h6></label>
                                                <div class="controls row-fluid">
                                                    <input type="file" name="d_banner">
                                                
                                                </div>
                                                <div class="controls row-fluid">
                                                    <textarea class="span8" type="text" rows="5" name="p_desc" required placeholder="Description"></textarea> 
                                                </div>

                                            </div>
                                            <div class="control-group">
                                                <div class="controls row-fluid">
                                                    <label><h6>Product front image:</h6></label>
                                                    <input class="span8 form-control" type="file" name="front_img"   required>
                                                </div>
                                                <div class="controls row-fluid">
                                                    <label><h6>Product detail images:</h6></label>
                                                    <input class="span8 form-control" type="file" name="p_img[]"  multiple required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="module-foot">
                                            <div class="control-group">
                                                <div class="controls clearfix">
                                                    <input name="add_product" type="submit" class="btn btn-primary pull-left" value="ADD Product">   
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                           <?php
                            }
                           ?>
        <!--/add product section-->
        <!-- add cartegory section -->
        
                            <?php
                            if(isset($_GET['add_category'])){


                            ?>
                            <div class="module">
                                <div class="module-head">
                                    <h3>Add Cartegory</h3>
                                </div>
                                <div class="module-body">
                                    <form action="../engine/insert.php" method="POST" enctype="multipart/form-data">
                                        <div class="module-body">
                                            <div class="control-group">
                                                <div class="controls row-fluid">
                                                    <input class="span8" type="text"  name="product_category" required placeholder="Input New Cartegory" required>
                                                </div>
                                                <div class="controls row-fluid">
                                                    <div class="form-control"><input class="span8" type="file"  name="cat_img"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="module-foot">
                                            <div class="control-group">
                                                <div class="controls clearfix">
                                                    <input name="add_ec_category" type="submit" class="btn btn-primary pull-left" value="ADD">   
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                           <?php
                            }

                            if(isset($_GET['add_subcategory'])){


                            ?>
                            <div class="module">
                                <div class="module-head">
                                    <h3>Add Sub-cartegory</h3>
                                </div>
                                <div class="module-body">
                                    <form action="../engine/insert.php" method="POST">
                                        <div class="module-body">
                                            <div class="control-group">
                                                <div class="controls row-fluid">
                                                    <input class="span8" type="text"  name="product_subcategory" required placeholder="Input New Sub-cartegory">
                                                </div>
                                                <div class="controls row-fluid">
                                                    <select class="form-control" name="m_cat" required>
                                                        <option value="" disabled selected>Major Category</option>
                                                        <?php
                                                        $sql_ec = "SELECT * FROM ec_category";
                                                        $sql_ec_ini = $mycon2->query($sql_ec);
                                                        while ($cat= mysqli_fetch_array($sql_ec_ini) ) {
                                                        ?> 
                                                        <option value="<?php echo $cat['id']; ?>"><?php echo $cat['m_cat'] ?></option>   
                                                        <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="module-foot">
                                            <div class="control-group">
                                                <div class="controls clearfix">
                                                    <input name="add_ec_subcategory" type="submit" class="btn btn-primary pull-left" value="ADD">   
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                           <?php
                            }
                           if(isset($_GET['add_leastcategory'])){


                            ?>
                            <div class="module">
                                <div class="module-head">
                                    <h3>Add Least cartegory</h3>
                                </div>
                                <div class="module-body">
                                    <form action="../engine/insert.php" method="POST">
                                        <div class="module-body">
                                            <div class="control-group">
                                                <div class="controls row-fluid">
                                                    <input class="span8" type="text"  name="product_leastcategory" required placeholder="Input New least category">
                                                </div>
                                                <div class="controls row-fluid">
                                                    <select class="form-control" name="m_cat" required id="major_cat2">
                                                        <option value="" disabled selected>Major Category</option>
                                                        <?php
                                                        $sql_ec = "SELECT * FROM ec_category";
                                                        $sql_ec_ini = $mycon2->query($sql_ec);
                                                        while ($cat= mysqli_fetch_array($sql_ec_ini) ) {
                                                        ?> 
                                                        <option value="<?php echo $cat['id']; ?>"><?php echo $cat['m_cat'] ?></option>   
                                                        <?php
                                                        }
                                                        ?>
                                                    </select>
                                                    <select class="form-control" name="s_cat" required id="sub_cat2">
                                                        <option value="" disabled selected>Sub Category</option>
                                                        <?php
                                                        $sql_ec2 = "SELECT * FROM ec_sub_category";
                                                        $sql_ec_ini2 = $mycon2->query($sql_ec2);
                                                        while ($cat2 = mysqli_fetch_array($sql_ec_ini2) ) {
                                                        ?> 
                                                        <option value="<?php echo $cat2['id']; ?>"><?php echo $cat2['s_cat'] ?></option>   
                                                        <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="module-foot">
                                            <div class="control-group">
                                                <div class="controls clearfix">
                                                    <input name="add_ec_leastcategory" type="submit" class="btn btn-primary pull-left" value="ADD">   
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                           <?php
                            }
                            if(isset($_GET['add_img'])){


                            ?>
                            <div class="module">
                                <div class="module-head">
                                    <h3>Add BANNER</h3>
                                </div>
                                <div class="module-body">
                                    <form action="../engine/insert.php" method="POST" enctype="multipart/form-data">
                                        <div class="module-body">
                                            <div class="control-group">
                                                <div class="controls row-fluid">
                                                    <input class="span8" type="file"  name="banner_img" required >
                                                </div>
                                                <div class="controls row-fluid">
                                                    <select class="form-control" name="banner_type">
                                                        <option value="" disabled selected>Type</option>
                                                        <option value="sld">Slideshow</option>
                                                        <option value="hb"> Hot banners</option>
                                                        <option value="sb">Single banner</option>
                                                    </select>
                                                    <input type="text" name="product" class="span8" placeholder="optional for single & hot banners">
                                                    <input type="text" name="discount" placeholder="optional discount price digits only.">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="module-foot">
                                            <div class="control-group">
                                                <div class="controls clearfix">
                                                    <input name="add_banner_img" type="submit" class="btn btn-primary pull-left" value="ADD">   
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
        <script type="text/javascript">

            $( "#major_cat" ).change(function() {
                var selected = $( this ).val();
                $("#sub_cat").load("../engine/shop-load.php",{m_cat : selected});
            });
            $( "#sub_cat" ).change(function() {
                var picked = $( this ).val();
                var msel = $("#major_cat").val();
                $("#least_cat").load("../engine/shop-load.php",{s_cat : picked, m_cat_id : msel});
            });
            $( "#major_cat2" ).change(function() {
                var selected = $( this ).val();
                $("#sub_cat2").load("../engine/shop-load.php",{m_cat : selected});
            });
            function check(){
                var c = 2;
                for (var i = 1; i <= c; i++) {
                  
                    if ($("#radio"+i).is(':checked'))
                    {
                        $("#pass"+i).show("fast");
                    }else{
                        $("#pass"+i).hide("fast");
                    }

                }
                    
            }
            function cat(){
                var c = 2;
                for (var i = 1; i <= c; i++) {
                  
                    if ($("#catradio"+i).is(':checked'))
                    {
                        $("#catpass"+i).show("fast");
                    }else{
                        $("#catpass"+i).hide("fast");
                    }

                }
                    
            }
            
        </script>
      
    </body>
