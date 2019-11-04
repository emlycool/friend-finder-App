<header>
        <div class="header-top-wrapper-2 border-bottom-2">
            <div class="header-info-wrapper pl-200 pr-200">
                <div class="header-contact-info header-contact-info2 ">
                    <ul>
                        <li><i class="pe-7s-call"></i> Not available</li>
                        <li><i class="pe-7s-mail"></i> <a href="#">Not available</a></li>
                    </ul>
                </div>
                <div class="electronics-login-register">
                    <ul>
                        <li><a data-toggle="modal" data-target="#exampleCompare" href="#"><i class="pe-7s-repeat"></i>Compare</a></li>                  
                        <li><a href="wishlist.php" ><i class="pe-7s-like"></i>Wishlist</a></li>
                        <?php
                        if (!isset($_SESSION['user_id'])) {
                        ?>
                        <li><a href="login.php"><i class="pe-7s-users"></i>Login</a></li>
                        <li><a href="#"><i class="pe-7s-user"></i> Sign Up</a></li>
                        <?php   
                        }else{
                        ?>
                        <li>
                            <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Hi, <?php echo get_user($mycon,"firstname") ?> </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="account.php">Account</a>
                                <a class="dropdown-item" href="orders.php">My Orders</a>
                                <a class="dropdown-item" href="wishlist.php">Saved items</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="../engine/logout.php">Log out</a>
                            </div>
                        </li>
                        <?php
                        }
                        ?>
                        <li><a class="border-none" href="#"><i class="fa fa-chat"></i>Get Social</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="header-bottom ptb-40 clearfix">
            <div class="header-bottom-wrapper pr-200 pl-200">
                <div class="logo-3">
                    <a href="index.php">
                        <img src="../images/logo-black.png" alt="">
                    </a>
                </div>
                <div class="categories-search-wrapper categories-search-wrapper2">
                    <div class="all-categories">
                        <div class="select-wrapper">
                            <select class="select">
                                <option value="">All Categories</option>
                                <option value="">Smartphones </option>
                                <option value="">Computers</option>
                                <option value="">Laptops </option>
                                <option value="">Camerea </option>
                                <option value="">Watches</option>
                                <option value="">Lights </option>
                                <option value="">Air conditioner</option>
                            </select>
                        </div>
                    </div>
                    <div class="categories-wrapper">
                        <form action="#">
                            <input placeholder="Enter Your key word" type="text">
                            <button type="button"> Search </button>
                        </form>
                    </div>
                </div>
                <div class="header-cart-3" id="cart-menu">
                    <?php
                     if (isset($_SESSION['cart'])) { $total_cart = total_cart(); } 
                     
                    ?>
                    <a href="#">
                        <i class="ti-shopping-cart"></i>My Cart
                        <?php if (isset($_SESSION['cart'])) {?><span><?php echo $total_cart;?></span><?php }  ?>
                    </a>
                    <?php
                    if (isset($_SESSION['cart'])) {
                    ?>
                    <ul class="cart-dropdown" >
                        <?php
                        if(!empty($_SESSION["cart"])){   
                            foreach($_SESSION["cart"] as $key => $value){
                                $cart_sql = "SELECT * FROM products WHERE id = $key";
                                $cart_result = $mycon2->query($cart_sql);
                                $cart_info = mysqli_fetch_array($cart_result);
                                   
                                
                            
                        ?>
                        <li class="single-product-cart">
                            <div class="cart-img">
                                <a><img src="<?php echo $cart_info['thumbDir']; ?>" alt=""></a>
                            </div>
                            <div class="cart-title">
                                <h5><a href="#"> <?php echo reduced_text($value['item_name'], 15); ?></a></h5>
                                <span>&#8358; <?php echo number_format($value['item_price']); ?></span>
                                <span> x <?php echo $value['item_quantity']; ?></span>
                            </div>
                            <div class="cart-delete">
                                <a href="#" onClick="remove_cart(<?php echo $key ?>);"><i class="ti-trash"></i></a>
                            </div>
                        </li>
                        <?php
                                
                            }
                        }
                        ?>
                        <li class="cart-btn-wrapper">
                            <a class="cart-btn btn-hover" href="shop-cart.php">view cart</a>
                            <a class="cart-btn btn-hover" href="#">checkout</a>
                        </li>
                    </ul>
                    <?php
                }
                    ?>
                </div>
                <div class="mobile-menu-area mobile-menu-none-block electro-2-menu">
                    <div class="mobile-menu">
                        <nav id="mobile-menu-active">
                            <ul class="menu-overflow">
                                <li><a href="#">HOME</a>
                                    
                                </li>
                                <li><a href="#">pages</a>
                                    <ul>
                                        <li><a href="about-us.php">about us</a></li>
                                        <li><a href="menu-list.php">menu list</a></li>
                                        <li><a href="login.php">login</a></li>
                                        <li><a href="register.php">register</a></li>
                                        <li><a href="cart.php">cart page</a></li>
                                        <li><a href="checkout.php">checkout</a></li>
                                        <li><a href="wishlist.php">wishlist</a></li>
                                        <li><a href="contact.php">contact</a></li>
                                    </ul>
                                </li>
                                <li><a href="#">shop</a>
                                    <ul>
                                        <li><a href="shop-grid-2-col.php"> grid 2 column</a></li>
                                        <li><a href="shop-grid-3-col.php"> grid 3 column</a></li>
                                        <li><a href="shop.php">grid 4 column</a></li>
                                        <li><a href="shop-grid-box.php">grid box style</a></li>
                                        <li><a href="shop-list-1-col.php"> list 1 column</a></li>
                                        <li><a href="shop-list-2-col.php">list 2 column</a></li>
                                        <li><a href="shop-list-box.php">list box style</a></li>
                                        <li><a href="product-details.php">tab style 1</a></li>
                                        <li><a href="product-details-2.php">tab style 2</a></li>
                                        <li><a href="product-details-3.php"> tab style 3</a></li>
                                        <li><a href="product-details-4.php">sticky style</a></li>
                                        <li><a href="product-details-5.php">sticky style 2</a></li>
                                        <li><a href="product-details-6.php">gallery style</a></li>
                                        <li><a href="product-details-7.php">gallery style 2</a></li>
                                        <li><a href="product-details-8.php">fixed image style</a></li>
                                        <li><a href="product-details-9.php">fixed image style 2</a></li>
                                    </ul>
                                </li>
                                <li><a href="#">BLOG</a>
                                    <ul>
                                        <li><a href="blog.php">blog 3 colunm</a></li>
                                        <li><a href="blog-2-col.php">blog 2 colunm</a></li>
                                        <li><a href="blog-sidebar.php">blog sidebar</a></li>
                                        <li><a href="blog-details.php">blog details</a></li>
                                        <li><a href="blog-details-sidebar.php">blog details 2</a></li>
                                    </ul>
                                </li>
                                <li><a href="contact.php"> Contact  </a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- header end -->
    