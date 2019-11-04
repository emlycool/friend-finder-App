<?php
session_start();
include_once("database.php");
include_once('../processes/my-functions.php');

if (isset($_POST['action'])) {
    switch($_POST['action']) {
        case "add":
            if ($_POST['add_cart']) {
                if (!isset($_POST['col'])) {
                    $col = "";
                }
                else{ $col = $_POST['col'];}
                
                $product_sql = "SELECT * FROM products WHERE id = {$_POST['add_cart']}";
                $product_result = $mycon2->query($product_sql);
                $product_info = mysqli_fetch_array($product_result);
                $item_array = array(
                    'product_id' => $_POST['add_cart'],
                    'item_name'  =>  $product_info['name'],
                    'item_price' =>  $product_info['new_price'],
                    'item_quantity' => $_POST['qty'],
                    'old_price' =>  $product_info["price"],
                    'item_color' => $col,
                    'subtotal' => $product_info['new_price'] * $_POST['qty']
                );
            }
            if(isset($_SESSION["cart"])){
                if (array_key_exists($_POST['add_cart'], $_SESSION['cart'])) {
                    $_SESSION['cart'][$_POST['add_cart']]['item_quantity'] += $_POST['qty'];
                    $_SESSION['cart'][$_POST['add_cart']]['subtotal'] = $_SESSION['cart'][$_POST['add_cart']]['item_quantity'] * $product_info['new_price'];

                }else{
                    $_SESSION['cart'][$_POST['add_cart']] = $item_array;
                }

            }
            else{
                
                $_SESSION['cart'] = array(
                    $_POST['add_cart'] => $item_array
                );
            }
        break;
        case "remove":
            if(!empty($_SESSION["cart"])) {
                $count = count($_SESSION['cart']);
                if ($count == 1) {
                    unset($_SESSION['cart']);
                }else{
                    unset($_SESSION["cart"][$_POST['remove_cart']]);
                }
                
                
            }
        break;
        case "change":
            if (isset($_POST['change_cart'])) {
                $product_sql = "SELECT * FROM products WHERE id = {$_POST['change_cart']}";
                $product_result = $mycon2->query($product_sql);
                $product_info = mysqli_fetch_array($product_result);

                $_SESSION['cart'][$_POST['change_cart']]['item_quantity'] = $_POST['qty'];
                $_SESSION['cart'][$_POST['change_cart']]['subtotal'] = $_SESSION['cart'][$_POST['change_cart']]['item_quantity'] * $product_info['new_price'];
            }
        break;
        case "empty":
        break;
        default:
            echo "<script>
                swal({
                        text: 'something to happened',
                        icon: 'warning',
                        timer: 2000,
                        button: false,
                    });</script>";

    }

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
}


?>
