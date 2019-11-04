<?php
session_start();
include_once '../engine/database.php';
include_once '../processes/my-functions.php';
?>
<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Friend finder shop. Buy all electronics and gadgets at affordable prices.</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.png">

    <!-- all css here -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/magnific-popup.css">
    <link rel="stylesheet" href="assets/css/animate.css">
    <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/css/themify-icons.css">
    <link rel="stylesheet" href="assets/css/pe-icon-7-stroke.css">
    <link rel="stylesheet" href="assets/css/icofont.css">
    <link rel="stylesheet" href="assets/css/meanmenu.min.css">
    <link rel="stylesheet" href="assets/css/bundle.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/responsive.css">
    <script src="assets/js/vendor/modernizr-2.8.3.min.js"></script>
    </head>
    <body>
        <!--[if lt IE 8]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
        <!-- header start -->
        <div class="notification-section notification-section-padding notification-img-2 ptb-15">
        <div class="container-fluid">
            <div class="notification-wrapper">
                <div class="notification-pera-graph notification-pera-graph-2">
                    <p>Get A big Discount for Gadgets. 10% to 70% Discount for all products. Save money</p>
                </div>
                <div class="notification-btn-close">
                    <div class="notification-btn notification-btn-2">
                        <a href="#">Shop Now</a>
                    </div>
                    <div class="notification-close notification-icon-2 notification-icon">
                        <button><i class="pe-7s-close"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include_once 'shop-header.php'; ?>
		<div class="breadcrumb-area pt-120 pb-150" style="background-image: url(assets/img/bg/breadcrumb.jpg)">
            <div class="container">
                <div class="breadcrumb-content text-center">
                    <h2> Cart</h2>
                    <ul>
                        <li><a href="index.php">home</a></li>
                        <li>Cart</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- shopping-cart-area start -->
        <div class="cart-main-area pt-95 pb-100">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <h1 class="cart-heading">Cart</h1>
                        <?php
                        if (empty($_SESSION['cart'])) {
                        ?>
                        <h4>No product in your cart.</h4>
                        <?php
                        }
                        else{
                        ?>
                        <form action="#">
                            <div class="table-content table-responsive">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>remove</th>
                                            <th>images</th>
                                            <th>Product</th>
                                            <th>Unit price</th>
                                            <th>Quantity</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            foreach($_SESSION["cart"] as $key => $value){
                                                $cart_sql = "SELECT * FROM products WHERE id = $key";
                                                $cart_result = $mycon2->query($cart_sql);
                                                $cart_info = mysqli_fetch_array($cart_result);
                                        ?>
                                        <tr>
                                            <td class="product-remove"><a href="#" onClick="remove_cart(<?php echo $key ?>);"><i class="pe-7s-close"></i></a></td>
                                            <td class="product-thumbnail">
                                                <a href="product-details.php?product=<?php echo $key; ?>"><img src="<?php echo $cart_info['thumbDir']; ?>" alt=""></a>
                                            </td>
                                            <td class="product-name"><a href="product-details.php?product=<?php echo $key; ?>"><?php echo reduced_text($value['item_name'], 20); ?></a></td>
                                            <td class="product-price-cart"><span class="amount">&#8358; <?php echo number_format($value['item_price']); ?></span>
                                            
                                            </td>
                                            <td class="product-quantity">
                                                <div class="col-md-12 pull-center" >
                                                    <select id="qty<?php echo $key; ?>" onChange="change_cart(<?php echo $key; ?>);" >
                                                        <?php
                                                            for ($i=1; $i < 11 ; $i++) { 
                                                            
                                                        ?>
                                                        <option <?php if ($i == $value['item_quantity']) { echo "selected"; }?> value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                                        <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </td>
                                            <td class="product-subtotal text-nowrap" id="subtotal-data<?php echo $key; ?>">&#8358; <?php echo number_format(($value['subtotal'])); ?></td>

                                        </tr>
                                        <?php
                                        }
                                        ?>
                                        
                                    </tbody>
                                </table>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="coupon-all">
                                        <div class="coupon">
                                            <input id="coupon_code" class="input-text" name="coupon_code" value="" placeholder="Coupon code" type="text">
                                            <input class="button" name="apply_coupon" value="Apply coupon" type="submit">
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-5 ml-auto">
                                    <div class="cart-page-total">
                                        <h2>Cart totals</h2>
                                        <h6>-<span>Shipping fees not included yet</span></h6>
                                        <ul>
                                            
                                            <li>Total<span>&#8358; <?php echo total_price();  ?></span></li>
                                        </ul>
                                        <a href="checkout.php">Proceed to checkout</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <?php
                        }    
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <!-- shopping-cart-area end -->
		<footer class="footer-area">
            <div class="footer-top-area bg-img pt-105 pb-65" style="background-image: url(assets/img/bg/1.jpg)" data-overlay="9">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-4 col-md-3">
                            <div class="footer-widget mb-40">
                                <h3 class="footer-widget-title">Custom Service</h3>
                                <div class="footer-widget-content">
                                    <ul>
                                        <li><a href="cart.html">Cart</a></li>
                                        <li><a href="register.html">My Account</a></li>
                                        <li><a href="login.html">Login</a></li>
                                        <li><a href="register.html">Register</a></li>
                                        <li><a href="#">Support</a></li>
                                        <li><a href="#">Track</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-md-3">
                            <div class="footer-widget mb-40">
                                <h3 class="footer-widget-title">Categories</h3>
                                <div class="footer-widget-content">
                                    <ul>
                                        <li><a href="shop.html">Dress</a></li>
                                        <li><a href="shop.html">Shoes</a></li>
                                        <li><a href="shop.html">Shirt</a></li>
                                        <li><a href="shop.html">Baby Product</a></li>
                                        <li><a href="shop.html">Mans Product</a></li>
                                        <li><a href="shop.html">Leather</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-md-6">
                            <div class="footer-widget mb-40">
                                <h3 class="footer-widget-title">Contact</h3>
                                <div class="footer-newsletter">
                                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum is dummy.</p>
                                    <div id="mc_embed_signup" class="subscribe-form pr-40">
                                        <form action="http://devitems.us11.list-manage.com/subscribe/post?u=6bbb9b6f5827bd842d9640c82&amp;id=05d85f18ef" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
                                            <div id="mc_embed_signup_scroll" class="mc-form">
                                                <input type="email" value="" name="EMAIL" class="email" placeholder="Enter Your E-mail" required>
                                                <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
                                                <div class="mc-news" aria-hidden="true">
                                                    <input type="text" name="b_6bbb9b6f5827bd842d9640c82_05d85f18ef" tabindex="-1" value="">
                                                </div>
                                                <div class="clear">
                                                    <input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="button">
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="footer-contact">
                                        <p><span><i class="ti-location-pin"></i></span> 77 Seventh avenue USA 12555. </p>
                                        <p><span><i class=" ti-headphone-alt "></i></span> +88 (015) 609735 or +88 (012) 112266</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer-bottom black-bg ptb-20">
                <div class="container">
                    <div class="row">
                        <div class="col-12 text-center">
                            <div class="copyright">
                                <p>
                                    Copyright ©
                                    <a href="https://hastech.company/">HasTech</a> 2018 . All Right Reserved.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
		<!-- modal -->
        <div class="modal fade" id="exampleCompare" tabindex="-1" role="dialog" aria-hidden="true">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span class="pe-7s-close" aria-hidden="true"></span>
            </button>
            <div class="modal-dialog modal-compare-width" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <form action="#">
                            <div class="table-content compare-style table-responsive">
                                <table>
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>
                                                <a href="#">Remove <span>x</span></a>
                                                <img src="assets/img/cart/4.jpg" alt="">
                                                <p>Blush Sequin Top </p>
                                                <span>$75.99</span>
                                                <a class="compare-btn" href="#">Add to cart</a>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="compare-title"><h4>Description </h4></td>
                                            <td class="compare-dec compare-common">
                                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has beenin the stand ard dummy text ever since the 1500s, when an unknown printer took a galley</p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="compare-title"><h4>Sku </h4></td>
                                            <td class="product-none compare-common">
                                                <p>-</p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="compare-title"><h4>Availability  </h4></td>
                                            <td class="compare-stock compare-common">
                                                <p>In stock</p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="compare-title"><h4>Weight   </h4></td>
                                            <td class="compare-none compare-common">
                                                <p>-</p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="compare-title"><h4>Dimensions   </h4></td>
                                            <td class="compare-stock compare-common">
                                                <p>N/A</p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="compare-title"><h4>brand   </h4></td>
                                            <td class="compare-brand compare-common">
                                                <p>HasTech</p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="compare-title"><h4>color   </h4></td>
                                            <td class="compare-color compare-common">
                                                <p>Grey, Light Yellow, Green, Blue, Purple, Black </p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="compare-title"><h4>size    </h4></td>
                                            <td class="compare-size compare-common">
                                                <p>XS, S, M, L, XL, XXL </p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="compare-title"></td>
                                            <td class="compare-price compare-common">
                                                <p>$75.99 </p>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
	
		<!-- all js here -->
        <script src="assets/js/vendor/jquery-1.12.0.min.js"></script>
        <script src="assets/js/popper.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
        <script src="assets/js/jquery.magnific-popup.min.js"></script>
        <script src="assets/js/isotope.pkgd.min.js"></script>
        <script src="assets/js/imagesloaded.pkgd.min.js"></script>
        <script src="assets/js/jquery.counterup.min.js"></script>
        <script src="assets/js/waypoints.min.js"></script>
        <script src="assets/js/ajax-mail.js"></script>
        <script src="assets/js/owl.carousel.min.js"></script>
        <script src="assets/js/plugins.js"></script>
        <script src="assets/js/main.js"></script>
        <script type="text/javascript" src="../js/sweetalert.min.js"></script>
        <script src="assets/js/cart.js"></script>
        <script type="text/javascript">
            /*
            function thousands_separators(num)
                  {
                    var num_parts = num.toString().split(".");
                    num_parts[0] = num_parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                    return num_parts.join(".");
                  }

            function subtotal(id) {
                
                var selected = document.getElementById("qty"+id).value;
                var unitprice = document.getElementById("unit-price"+id).value;
                var priceint = parseInt(unitprice);
                var subtotal = selected * priceint;
                document.getElementById("subtotal-data"+id).innerHTML = "&#8358; "+thousands_separators(subtotal);

                /*
                $( "#qty"+id ).change(function() {
                
                var selected = $( this ).val();
                var price = document.getElementsByClassName("unit-price").value;
                var total = selected * price;
                alert(total);
            });
            
            }*/
            
        </script>
    </body>
</html>
