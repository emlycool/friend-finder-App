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
    <!--Notification Section-->
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
    <?php include_once 'shop-menu.php'; ?>
    <div class="slider-area">
        <div class="slider-active owl-carousel">
            <div class="single-slider-4 slider-height-4 bg-img" style="background-image: url(assets/img/slider/6.jpg)">
                <div class="container">
                    <div class="slider-content-4 fadeinup-animated">
                        <h2 class="animated">Say hello! to the <br>future.</h2>
                        <h4 class="animated">Best Product With warranty  </h4>
                        <a class="electro-slider-btn btn-hover animated" href="product-details.html">buy now</a>
                    </div>
                </div>
            </div>
            <div class="single-slider-4 slider-height-4 bg-img" style="background-image: url(assets/img/slider/7.jpg)">
                <div class="container">
                    <div class="slider-content-4 fadeinup-animated">
                        <h2 class="animated">Say hello! to the <br>future.</h2>
                        <h4 class="animated">Best Product With warranty  </h4>
                        <a class="electro-slider-btn btn-hover animated" href="product-details.html">buy now</a>
                    </div>
                </div>
            </div>
            <div class="single-slider-4 slider-height-4 bg-img" style="background-image: url(assets/img/slider/6.jpg)">
                <div class="container">
                    <div class="slider-content-4 fadeinup-animated">
                        <h2 class="animated">Say hello! to the <br>future.</h2>
                        <h4 class="animated">Best Product With warranty  </h4>
                        <a class="electro-slider-btn btn-hover animated" href="product-details.html">buy now</a>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <div class="banner-area wrapper-padding gray-bg-7 pt-60">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-4">
                    <div class="banner-wrapper-4 mb-30">
                        <a href="#"><img src="assets/img/banner/20.jpg" alt=""></a>
                        <div class="banner-content4-style1">
                            <h4>Best <br>Electronics <br>Products.</h4>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="banner-wrapper-4 mb-30">
                        <a href="#"><img src="assets/img/banner/21.jpg" alt=""></a>
                        <div class="banner-content4-style2">
                            <h5 class="p-left">get</h5>
                            <h2>25% </h2>
                            <h5 class="p-right">off</h5>
                            <h3>Bitso X1202</h3>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="banner-wrapper-4 mb-30">
                        <a href="#"><img src="assets/img/banner/22.jpg" alt=""></a>
                        <div class="banner-content4-style3">
                            <h1>Up to <br>10% Off</h1>
                            <h3>Lonovo Vio D22</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="electro-product-wrapper wrapper-padding pt-85 pb-75 gray-bg-7">
        <div class="container">
            <div class="section-title-4 text-center mb-45">
                <h2>Top Products</h2>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="product-wrapper mb-30">
                        <div class="product-img-3">
                            <a href="product-details-9.html">
                                <img src="assets/img/product/electro/22.jpg" alt="">
                            </a>
                            <div class="hanicraft-action-position">
                                <div class="hanicraft-action">
                                    <a class="action-cart" title="Add To Cart" href="#">
                                        <i class="pe-7s-cart"></i>
                                    </a>
                                    <a class="action-like" title="Wishlist" href="#">
                                        <i class="pe-7s-like"></i>
                                    </a>
                                    <a class="action-repeat" title="Compare" href="#" data-toggle="modal" data-target="#exampleCompare" >
                                        <i class="pe-7s-repeat"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="product-content-electro2 text-center">
                            <h3><a href="product-details.html"> Demo TV 32GB</a></h3>
                            <span>Black</span>
                            <h5>$49.99</h5>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="product-wrapper mb-30">
                        <div class="product-img-3">
                            <a href="#">
                                <img src="assets/img/product/electro/23.jpg" alt="">
                            </a>
                            <div class="hanicraft-action-position">
                                <div class="hanicraft-action">
                                    <a class="action-cart" title="Add To Cart" href="#">
                                        <i class="pe-7s-cart"></i>
                                    </a>
                                    <a class="action-like" title="Wishlist" href="#">
                                        <i class="pe-7s-like"></i>
                                    </a>
                                    <a class="action-repeat" title="Compare" href="#" data-toggle="modal" data-target="#exampleCompare" >
                                        <i class="pe-7s-repeat"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="product-content-electro2 text-center">
                            <h3><a href="product-details.html">Pebble Time</a></h3>
                            <span>Black</span>
                            <h5>$49.99</h5>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="product-wrapper mb-30">
                        <div class="product-img-3">
                            <a href="#">
                                <img src="assets/img/product/electro/24.jpg" alt="">
                            </a>
                            <div class="hanicraft-action-position">
                                <div class="hanicraft-action">
                                    <a class="action-cart" title="Add To Cart" href="#">
                                        <i class="pe-7s-cart"></i>
                                    </a>
                                    <a class="action-like" title="Wishlist" href="#">
                                        <i class="pe-7s-like"></i>
                                    </a>
                                    <a class="action-repeat" title="Compare" href="#" data-toggle="modal" data-target="#exampleCompare" >
                                        <i class="pe-7s-repeat"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="product-content-electro2 text-center">
                            <h3><a href="product-details.html">Zendure 4-Port USB</a></h3>
                            <span>Black</span>
                            <h5>$49.99</h5>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="product-wrapper mb-30">
                        <div class="product-img-3">
                            <a href="#">
                                <img src="assets/img/product/electro/25.jpg" alt="">
                            </a>
                            <div class="hanicraft-action-position">
                                <div class="hanicraft-action">
                                    <a class="action-cart" title="Add To Cart" href="#">
                                        <i class="pe-7s-cart"></i>
                                    </a>
                                    <a class="action-like" title="Wishlist" href="#">
                                        <i class="pe-7s-like"></i>
                                    </a>
                                    <a class="action-repeat" title="Compare" href="#" data-toggle="modal" data-target="#exampleCompare" >
                                        <i class="pe-7s-repeat"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="product-content-electro2 text-center">
                            <h3><a href="product-details.html">Zendure 4-Port USB</a></h3>
                            <span>Black</span>
                            <h5>$49.99</h5>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="product-wrapper mb-30">
                        <div class="product-img-3">
                            <a href="#">
                                <img src="assets/img/product/electro/26.jpg" alt="">
                            </a>
                            <div class="hanicraft-action-position">
                                <div class="hanicraft-action">
                                    <a class="action-cart" title="Add To Cart" href="#">
                                        <i class="pe-7s-cart"></i>
                                    </a>
                                    <a class="action-like" title="Wishlist" href="#">
                                        <i class="pe-7s-like"></i>
                                    </a>
                                    <a class="action-repeat" title="Compare" href="#" data-toggle="modal" data-target="#exampleCompare" >
                                        <i class="pe-7s-repeat"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="product-content-electro2 text-center">
                            <h3><a href="product-details.html"> Demo TV 32GB</a></h3>
                            <span>Black</span>
                            <h5>$49.99</h5>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="product-wrapper mb-30">
                        <div class="product-img-3">
                            <a href="#">
                                <img src="assets/img/product/electro/27.jpg" alt="">
                            </a>
                            <div class="hanicraft-action-position">
                                <div class="hanicraft-action">
                                    <a class="action-cart" title="Add To Cart" href="#">
                                        <i class="pe-7s-cart"></i>
                                    </a>
                                    <a class="action-like" title="Wishlist" href="#">
                                        <i class="pe-7s-like"></i>
                                    </a>
                                    <a class="action-repeat" title="Compare" href="#" data-toggle="modal" data-target="#exampleCompare" >
                                        <i class="pe-7s-repeat"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="product-content-electro2 text-center">
                            <h3><a href="product-details.html"> Pebble Time</a></h3>
                            <span>Black</span>
                            <h5>$49.99</h5>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="product-wrapper mb-30">
                        <div class="product-img-3">
                            <a href="#">
                                <img src="assets/img/product/electro/28.jpg" alt="">
                            </a>
                            <div class="hanicraft-action-position">
                                <div class="hanicraft-action">
                                    <a class="action-cart" title="Add To Cart" href="#">
                                        <i class="pe-7s-cart"></i>
                                    </a>
                                    <a class="action-like" title="Wishlist" href="#">
                                        <i class="pe-7s-like"></i>
                                    </a>
                                    <a class="action-repeat" title="Compare" href="#" data-toggle="modal" data-target="#exampleCompare" >
                                        <i class="pe-7s-repeat"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="product-content-electro2 text-center">
                            <h3><a href="product-details.html">Zendure 4-Port USB</a></h3>
                            <span>Black</span>
                            <h5>$49.99</h5>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="product-wrapper mb-30">
                        <div class="product-img-3">
                            <a href="#">
                                <img src="assets/img/product/electro/29.jpg" alt="">
                            </a>
                            <div class="hanicraft-action-position">
                                <div class="hanicraft-action">
                                    <a class="action-cart" title="Add To Cart" href="#">
                                        <i class="pe-7s-cart"></i>
                                    </a>
                                    <a class="action-like" title="Wishlist" href="#">
                                        <i class="pe-7s-like"></i>
                                    </a>
                                    <a class="action-repeat" title="Compare" href="#" data-toggle="modal" data-target="#exampleCompare" >
                                        <i class="pe-7s-repeat"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="product-content-electro2 text-center">
                            <h3><a href="product-details.html">Zendure 4-Port USB</a></h3>
                            <span>Black</span>
                            <h5>$49.99</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="banner-area wrapper-padding pt-15 pb-95 gray-bg-7">
        <div class="container">
            <div class="electro-fexible-banner bg-img" style="background-image: url(assets/img/banner/23.jpg)">
                <div class="fexible-content fexible-content-2 ">
                    <h3>Play with flexible</h3>
                    <p>Multicontrol Smooth Controller, Black Color All Buttons
                        <br>are somooth, Super Shine.</p>
                    <a class="btn-hover flexible-btn" href="product-details.html">Buy Now</a>
                </div>
            </div>
        </div>
    </div>
    <div class="best-selling-area pb-95 gray-bg-7">
        <div class="section-title-4 text-center mb-60">
            <h2>Best Selling</h2>
        </div>
        <div class="best-selling-product">
            <div class="row no-gutters">
                <div class="col-lg-5">
                    <div class="best-selling-left">
                        <div class="product-wrapper">
                            <div class="product-img-4">
                                <a href="#"><img src="assets/img/product/electro/9.jpg" alt=""></a>
                                <div class="product-action-right">
                                    <a class="animate-top" title="Add To Cart" href="#">
                                        <i class="pe-7s-cart"></i>
                                    </a>
                                    <a class="animate-left" title="Wishlist" href="#">
                                        <i class="pe-7s-like"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="product-content-5 text-center">
                                <div class="product-rating-4">
                                    <i class="icofont icofont-star yellow"></i>
                                    <i class="icofont icofont-star yellow"></i>
                                    <i class="icofont icofont-star yellow"></i>
                                    <i class="icofont icofont-star yellow"></i>
                                    <i class="icofont icofont-star yellow"></i>
                                </div>
                                <h4><a href="product-details.html">desktop C27F551</a></h4>
                                <span>Headphone</span>
                                <h5>$133.00</h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="best-selling-right">
                        <div class="custom-container">
                            <div class="coustom-row-3">
                                <div class="custom-col-style-3 custom-col-3">
                                    <div class="product-wrapper mb-6">
                                        <div class="product-img-4">
                                            <a href="#">
                                                <img src="assets/img/product/electro/10.jpg" alt="">
                                            </a>
                                            <div class="product-action-right">
                                                <a class="animate-top" title="Add To Cart" href="#">
                                                    <i class="pe-7s-cart"></i>
                                                </a>
                                                <a class="animate-left" title="Wishlist" href="#">
                                                    <i class="pe-7s-like"></i>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="product-content-6">
                                            <div class="product-rating-4">
                                                <i class="icofont icofont-star yellow"></i>
                                                <i class="icofont icofont-star yellow"></i>
                                                <i class="icofont icofont-star yellow"></i>
                                                <i class="icofont icofont-star yellow"></i>
                                                <i class="icofont icofont-star yellow"></i>
                                            </div>
                                            <h4><a href="product-details.html">Play Station</a></h4>
                                            <h5>$145.00</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="custom-col-style-3 custom-col-3">
                                    <div class="product-wrapper mb-6">
                                        <div class="product-img-4">
                                            <a href="#">
                                                <img src="assets/img/product/electro/11.jpg" alt="">
                                            </a>
                                            <div class="product-action-right">
                                                <a class="animate-top" title="Add To Cart" href="#">
                                                    <i class="pe-7s-cart"></i>
                                                </a>
                                                <a class="animate-left" title="Wishlist" href="#">
                                                    <i class="pe-7s-like"></i>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="product-content-6">
                                            <div class="product-rating-4">
                                                <i class="icofont icofont-star yellow"></i>
                                                <i class="icofont icofont-star yellow"></i>
                                                <i class="icofont icofont-star yellow"></i>
                                                <i class="icofont icofont-star yellow"></i>
                                                <i class="icofont icofont-star yellow"></i>
                                            </div>
                                            <h4><a href="product-details.html">Joy Stick</a></h4>
                                            <h5>$145.00</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="custom-col-style-3 custom-col-3">
                                    <div class="product-wrapper mb-6">
                                        <div class="product-img-4">
                                            <a href="#">
                                                <img src="assets/img/product/electro/12.jpg" alt="">
                                            </a>
                                            <div class="product-action-right">
                                                <a class="animate-top" title="Add To Cart" href="#">
                                                    <i class="pe-7s-cart"></i>
                                                </a>
                                                <a class="animate-left" title="Wishlist" href="#">
                                                    <i class="pe-7s-like"></i>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="product-content-6">
                                            <div class="product-rating-4">
                                                <i class="icofont icofont-star yellow"></i>
                                                <i class="icofont icofont-star yellow"></i>
                                                <i class="icofont icofont-star yellow"></i>
                                                <i class="icofont icofont-star yellow"></i>
                                                <i class="icofont icofont-star yellow"></i>
                                            </div>
                                            <h4><a href="product-details.html">Awesome Tab</a></h4>
                                            <h5>$145.00</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="custom-col-style-3 custom-col-3">
                                    <div class="product-wrapper mb-6">
                                        <div class="product-img-4">
                                            <a href="#">
                                                <img src="assets/img/product/electro/13.jpg" alt="">
                                            </a>
                                            <div class="product-action-right">
                                                <a class="animate-top" title="Add To Cart" href="#">
                                                    <i class="pe-7s-cart"></i>
                                                </a>
                                                <a class="animate-left" title="Wishlist" href="#">
                                                    <i class="pe-7s-like"></i>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="product-content-6">
                                            <div class="product-rating-4">
                                                <i class="icofont icofont-star yellow"></i>
                                                <i class="icofont icofont-star yellow"></i>
                                                <i class="icofont icofont-star yellow"></i>
                                                <i class="icofont icofont-star yellow"></i>
                                                <i class="icofont icofont-star"></i>
                                            </div>
                                            <h4><a href="product-details.html">Trimmer C27F401</a></h4>
                                            <h5>$145.00</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="custom-col-style-3 custom-col-3">
                                    <div class="product-wrapper mb-6">
                                        <div class="product-img-4">
                                            <a href="#">
                                                <img src="assets/img/product/electro/14.jpg" alt="">
                                            </a>
                                            <div class="product-action-right">
                                                <a class="animate-top" title="Add To Cart" href="#">
                                                    <i class="pe-7s-cart"></i>
                                                </a>
                                                <a class="animate-left" title="Wishlist" href="#">
                                                    <i class="pe-7s-like"></i>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="product-content-6">
                                            <div class="product-rating-4">
                                                <i class="icofont icofont-star yellow"></i>
                                                <i class="icofont icofont-star yellow"></i>
                                                <i class="icofont icofont-star yellow"></i>
                                                <i class="icofont icofont-star yellow"></i>
                                                <i class="icofont icofont-star yellow"></i>
                                            </div>
                                            <h4><a href="product-details.html">Timer C27F500</a></h4>
                                            <h5>$145.00</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="custom-col-style-3 custom-col-3">
                                    <div class="product-wrapper mb-6">
                                        <div class="product-img-4">
                                            <a href="#">
                                                <img src="assets/img/product/electro/15.jpg" alt="">
                                            </a>
                                            <div class="product-action-right">
                                                <a class="animate-top" title="Add To Cart" href="#">
                                                    <i class="pe-7s-cart"></i>
                                                </a>
                                                <a class="animate-left" title="Wishlist" href="#">
                                                    <i class="pe-7s-like"></i>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="product-content-6">
                                            <div class="product-rating-4">
                                                <i class="icofont icofont-star yellow"></i>
                                                <i class="icofont icofont-star yellow"></i>
                                                <i class="icofont icofont-star yellow"></i>
                                                <i class="icofont icofont-star yellow"></i>
                                                <i class="icofont icofont-star"></i>
                                            </div>
                                            <h4><a href="product-details.html">Joy Stick</a></h4>
                                            <h5>$145.00</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="androit-banner-wrapper wrapper-padding pt-100 pb-175">
        <div class="container-fluid">
            <div class="androit-banner-img bg-img" style="background-image: url(assets/img/banner/36.jpg)">
                <div class="androit-banner-content">
                    <h3>Xolo Fast T2 Smartphone, Android <br>7.0 Unlocked.</h3>
                    <a href="product-details.html">Buy Now →</a>
                </div>
                <div class="banner-price text-center">
                    <div class="banner-price-position">
                        <span class="banner-price-new">$125.00</span>
                        <span class="banner-price-old">$199.00</span>
                    </div>
                </div>
                <div class="phn-img">
                    <img src="assets/img/banner/10.png" alt="">
                </div>
            </div>
        </div>
    </div>
    <div class="product-area-2 wrapper-padding pt-100 pb-70 gray-bg-7">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6 col-xl-4">
                    <div class="product-wrapper product-wrapper-border mb-30">
                        <div class="product-img-5">
                            <a href="#">
                                <img src="assets/img/product/electro/16.jpg" alt="">
                            </a>
                        </div>
                        <div class="product-content-7">
                            <h4><a href="#">Autel Robotics - X-Star Premium Quadcopter</a></h4>
                            <div class="product-rating-4">
                                <i class="icofont icofont-star yellow"></i>
                                <i class="icofont icofont-star yellow"></i>
                                <i class="icofont icofont-star yellow"></i>
                                <i class="icofont icofont-star yellow"></i>
                                <i class="icofont icofont-star"></i>
                            </div>
                            <h5>$499.00</h5>
                            <div class="product-action-electro">
                                <a class="animate-top" title="Add To Cart" href="#">
                                    <i class="pe-7s-cart"></i>
                                </a>
                                <a class="animate-left" title="Wishlist" href="#">
                                    <i class="pe-7s-like"></i>
                                </a>
                                <a class="animate-right" title="Compare" data-toggle="modal" data-target="#exampleCompare" href="#">
                                    <i class="pe-7s-repeat"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-xl-4">
                    <div class="product-wrapper product-wrapper-border mb-30">
                        <div class="product-img-5">
                            <a href="#">
                                <img src="assets/img/product/electro/17.jpg" alt="">
                            </a>
                        </div>
                        <div class="product-content-7">
                            <h4><a href="#">Autel Robotics - X-Star Premium Quadcopter</a></h4>
                            <div class="product-rating-4">
                                <i class="icofont icofont-star yellow"></i>
                                <i class="icofont icofont-star yellow"></i>
                                <i class="icofont icofont-star yellow"></i>
                                <i class="icofont icofont-star yellow"></i>
                                <i class="icofont icofont-star"></i>
                            </div>
                            <h5>$499.00</h5>
                            <div class="product-action-electro">
                                <a class="animate-top" title="Add To Cart" href="#">
                                    <i class="pe-7s-cart"></i>
                                </a>
                                <a class="animate-left" title="Wishlist" href="#">
                                    <i class="pe-7s-like"></i>
                                </a>
                                <a class="animate-right" title="Compare" data-toggle="modal" data-target="#exampleCompare" href="#">
                                    <i class="pe-7s-repeat"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-xl-4">
                    <div class="product-wrapper product-wrapper-border mb-30">
                        <div class="product-img-5">
                            <a href="#">
                                <img src="assets/img/product/electro/18.jpg" alt="">
                            </a>
                        </div>
                        <div class="product-content-7">
                            <h4><a href="#">Autel Robotics - X-Star Premium Quadcopter</a></h4>
                            <div class="product-rating-4">
                                <i class="icofont icofont-star yellow"></i>
                                <i class="icofont icofont-star yellow"></i>
                                <i class="icofont icofont-star yellow"></i>
                                <i class="icofont icofont-star yellow"></i>
                                <i class="icofont icofont-star"></i>
                            </div>
                            <h5>$499.00</h5>
                            <div class="product-action-electro">
                                <a class="animate-top" title="Add To Cart" href="#">
                                    <i class="pe-7s-cart"></i>
                                </a>
                                <a class="animate-left" title="Wishlist" href="#">
                                    <i class="pe-7s-like"></i>
                                </a>
                                <a class="animate-right" title="Compare" data-toggle="modal" data-target="#exampleCompare" href="#">
                                    <i class="pe-7s-repeat"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-xl-4">
                    <div class="product-wrapper product-wrapper-border mb-30">
                        <div class="product-img-5">
                            <a href="#">
                                <img src="assets/img/product/electro/19.jpg" alt="">
                            </a>
                        </div>
                        <div class="product-content-7">
                            <h4><a href="#">Autel Robotics - X-Star Premium Quadcopter</a></h4>
                            <div class="product-rating-4">
                                <i class="icofont icofont-star yellow"></i>
                                <i class="icofont icofont-star yellow"></i>
                                <i class="icofont icofont-star yellow"></i>
                                <i class="icofont icofont-star yellow"></i>
                                <i class="icofont icofont-star"></i>
                            </div>
                            <h5>$499.00</h5>
                            <div class="product-action-electro">
                                <a class="animate-top" title="Add To Cart" href="#">
                                    <i class="pe-7s-cart"></i>
                                </a>
                                <a class="animate-left" title="Wishlist" href="#">
                                    <i class="pe-7s-like"></i>
                                </a>
                                <a class="animate-right" title="Compare" data-toggle="modal" data-target="#exampleCompare" href="#">
                                    <i class="pe-7s-repeat"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-xl-4">
                    <div class="product-wrapper product-wrapper-border mb-30">
                        <div class="product-img-5">
                            <a href="#">
                                <img src="assets/img/product/electro/20.jpg" alt="">
                            </a>
                        </div>
                        <div class="product-content-7">
                            <h4><a href="#">Autel Robotics - X-Star Premium Quadcopter</a></h4>
                            <div class="product-rating-4">
                                <i class="icofont icofont-star yellow"></i>
                                <i class="icofont icofont-star yellow"></i>
                                <i class="icofont icofont-star yellow"></i>
                                <i class="icofont icofont-star yellow"></i>
                                <i class="icofont icofont-star"></i>
                            </div>
                            <h5>$499.00</h5>
                            <div class="product-action-electro">
                                <a class="animate-top" title="Add To Cart" href="#">
                                    <i class="pe-7s-cart"></i>
                                </a>
                                <a class="animate-left" title="Wishlist" href="#">
                                    <i class="pe-7s-like"></i>
                                </a>
                                <a class="animate-right" title="Compare" data-toggle="modal" data-target="#exampleCompare" href="#">
                                    <i class="pe-7s-repeat"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-xl-4">
                    <div class="product-wrapper product-wrapper-border mb-30">
                        <div class="product-img-5">
                            <a href="#">
                                <img src="assets/img/product/electro/21.jpg" alt="">
                            </a>
                        </div>
                        <div class="product-content-7">
                            <h4><a href="#">Autel Robotics - X-Star Premium Quadcopter</a></h4>
                            <div class="product-rating-4">
                                <i class="icofont icofont-star yellow"></i>
                                <i class="icofont icofont-star yellow"></i>
                                <i class="icofont icofont-star yellow"></i>
                                <i class="icofont icofont-star yellow"></i>
                                <i class="icofont icofont-star"></i>
                            </div>
                            <h5>$499.00</h5>
                            <div class="product-action-electro">
                                <a class="animate-top" title="Add To Cart" href="#">
                                    <i class="pe-7s-cart"></i>
                                </a>
                                <a class="animate-left" title="Wishlist" href="#">
                                    <i class="pe-7s-like"></i>
                                </a>
                                <a class="animate-right" title="Compare" data-toggle="modal" data-target="#exampleCompare" href="#">
                                    <i class="pe-7s-repeat"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="brand-logo-area-2 wrapper-padding ptb-80 gray-bg-7">
        <div class="container-fluid">
            <div class="brand-logo-active2 owl-carousel">
                <div class="single-brand">
                    <img src="assets/img/brand-logo/7.png" alt="">
                </div>
                <div class="single-brand">
                    <img src="assets/img/brand-logo/8.png" alt="">
                </div>
                <div class="single-brand">
                    <img src="assets/img/brand-logo/9.png" alt="">
                </div>
                <div class="single-brand">
                    <img src="assets/img/brand-logo/10.png" alt="">
                </div>
                <div class="single-brand">
                    <img src="assets/img/brand-logo/11.png" alt="">
                </div>
                <div class="single-brand">
                    <img src="assets/img/brand-logo/12.png" alt="">
                </div>
                <div class="single-brand">
                    <img src="assets/img/brand-logo/13.png" alt="">
                </div>
                <div class="single-brand">
                    <img src="assets/img/brand-logo/7.png" alt="">
                </div>
                <div class="single-brand">
                    <img src="assets/img/brand-logo/8.png" alt="">
                </div>
            </div>
        </div>
    </div>
    <div class="newsletter-area ptb-60 gray-bg-7">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="section-title-5">
                        <h2>Newsletter</h2>
                        <p>Sign Up for get all update news & Get <span>15% off</span></p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="newsletter-style-3">
                        <div id="mc_embed_signup" class="subscribe-form-3 pr-50">
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
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer class="footer-area">
        <div class="footer-top-3 black-bg pt-75 pb-25">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-md-6 col-xl-4">
                        <div class="footer-widget mb-40">
                            <h3 class="footer-widget-title-3">Contact Us</h3>
                            <div class="footer-info-wrapper-2">
                                <div class="footer-address-electro">
                                    <div class="footer-info-icon2">
                                        <span>Address:</span>
                                    </div>
                                    <div class="footer-info-content2">
                                        <p>77 Seventh Streeth Banasree
                                            <br>Road Rampura -2100 Dhaka</p>
                                    </div>
                                </div>
                                <div class="footer-address-electro">
                                    <div class="footer-info-icon2">
                                        <span>Phone:</span>
                                    </div>
                                    <div class="footer-info-content2">
                                        <p>+11 (019) 2518 4203
                                            <br>+11 (251) 2223 3353</p>
                                    </div>
                                </div>
                                <div class="footer-address-electro">
                                    <div class="footer-info-icon2">
                                        <span>Email:</span>
                                    </div>
                                    <div class="footer-info-content2">
                                        <p><a href="#">domain@mail.com</a>
                                            <br><a href="#">company@domain.info</a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-xl-3">
                        <div class="footer-widget mb-40">
                            <h3 class="footer-widget-title-3">My Account</h3>
                            <div class="footer-widget-content-3">
                                <ul>
                                    <li><a href="login.html">Login Hare</a></li>
                                    <li><a href="cart.html">Cart History</a></li>
                                    <li><a href="checkout.html"> Payment History</a></li>
                                    <li><a href="shop.html">Product Tracking</a></li>
                                    <li><a href="register.html">Register</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-6 col-xl-2">
                        <div class="footer-widget mb-40">
                            <h3 class="footer-widget-title-3">Information</h3>
                            <div class="footer-widget-content-3">
                                <ul>
                                    <li><a href="about-us.html">About Us</a></li>
                                    <li><a href="#">Our Service</a></li>
                                    <li><a href="#">Pricing Plan</a></li>
                                    <li><a href="#"> Vendor Detail</a></li>
                                    <li><a href="#">Affiliate</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-xl-3">
                        <div class="footer-widget widget-right mb-40">
                            <h3 class="footer-widget-title-3">Service</h3>
                            <div class="footer-widget-content-3">
                                <ul>
                                    <li><a href="#">Product Service</a></li>
                                    <li><a href="#">Payment Service</a></li>
                                    <li><a href="#"> Discount Service</a></li>
                                    <li><a href="#">Shopping Service</a></li>
                                    <li><a href="#">Promotional Add</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-middle black-bg-2 pt-35 pb-40">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-md-4">
                        <div class="footer-services-wrapper mb-30">
                            <div class="footer-services-icon">
                                <i class="pe-7s-car"></i>
                            </div>
                            <div class="footer-services-content">
                                <h3>Free Shipping</h3>
                                <p>Free Shipping on Bangladesh</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4">
                        <div class="footer-services-wrapper mb-30">
                            <div class="footer-services-icon">
                                <i class="pe-7s-shield"></i>
                            </div>
                            <div class="footer-services-content">
                                <h3>Money Guarentee</h3>
                                <p>Free Shipping on Bangladesh</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4">
                        <div class="footer-services-wrapper mb-30">
                            <div class="footer-services-icon">
                                <i class="pe-7s-headphones"></i>
                            </div>
                            <div class="footer-services-content">
                                <h3>Online Support</h3>
                                <p>Free Shipping on Bangladesh</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-bottom  black-bg pt-25 pb-30">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-5">
                        <div class="footer-menu">
                            <nav>
                                <ul>
                                    <li><a href="#">Privacy Policy </a></li>
                                    <li><a href="#"> Blog</a></li>
                                    <li><a href="#">Help Center</a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-7">
                        <div class="copyright f-right mrg-5">
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
                                        <td class="compare-title">
                                            <h4>Description </h4></td>
                                        <td class="compare-dec compare-common">
                                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has beenin the stand ard dummy text ever since the 1500s, when an unknown printer took a galley</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="compare-title">
                                            <h4>Sku </h4></td>
                                        <td class="product-none compare-common">
                                            <p>-</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="compare-title">
                                            <h4>Availability  </h4></td>
                                        <td class="compare-stock compare-common">
                                            <p>In stock</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="compare-title">
                                            <h4>Weight   </h4></td>
                                        <td class="compare-none compare-common">
                                            <p>-</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="compare-title">
                                            <h4>Dimensions   </h4></td>
                                        <td class="compare-stock compare-common">
                                            <p>N/A</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="compare-title">
                                            <h4>brand   </h4></td>
                                        <td class="compare-brand compare-common">
                                            <p>HasTech</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="compare-title">
                                            <h4>color   </h4></td>
                                        <td class="compare-color compare-common">
                                            <p>Grey, Light Yellow, Green, Blue, Purple, Black </p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="compare-title">
                                            <h4>size    </h4></td>
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
</body>

</html>