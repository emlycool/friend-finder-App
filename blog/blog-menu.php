<!--================Frist Main hader Area =================-->
        <header class="header_menu_area">
            <nav class="navbar navbar-default">
                <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="blog-finder.php"><img src="../images/logo.png" alt=""></a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse pull-left" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <li><a href="../index.php">Home</a></li>
                        <li class= "active"><a href="blog-finder.php">Blog</a></li>
                        <li><a href="../shop/index.php" >Shop</a></li>
                        <li><a href="about-us.php">About Us</a></li>
                        <li><a href="contact.php">Contact us</a></li>
                        <?php
                            if (isset($_SESSION['user_id'])) {
                                }else{
                        ?>
                        <li><a  href="#!" data-toggle="modal" data-target="#loginModal">Login</a>
                        </li>
                        <?php
                                }
                        ?>
                    </ul>
                    <?php
                            if (isset($_SESSION['user_id'])) {
                                
                    ?>
                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown submenu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user"></i>Account</a>
                            <ul class="dropdown-menu">
                                <li><a href="community.html">Profile</a></li>
                                <li><a href="../engine/logout.php">Logout</a></li>  
                            </ul>
                        </li>
                    </ul>
                    <?php
                            }
                    ?>
                    </div><!-- /.navbar-collapse -->
                </div><!-- /.container-fluid -->
            </nav>
        </header>
            <!--================Frist Main hader Area =================-->
        
        <!--================Banner Area =================-->
        <section class="banner_area" style=" background: url(../img/banner/banner-bg-4.jpg) no-repeat scroll center center;">
            <div class="container">
                <div class="banner_content">
                    <h3 title="Friend finder"><img class="left_img" src="../img/banner/t-left-img.png" alt="">Friend finder<img class="right_img" src="../img/banner/t-right-img.png" alt=""></h3>
                    <a href="blog-finder.php">Home</a>
                    <a onClick="goBack();" class="popup-with-zoom-anim pull-right"><i class="fa fa-backward" aria-hidden="true"></i>&nbspBack</a></li>
                </div>
            </div>
        </section>