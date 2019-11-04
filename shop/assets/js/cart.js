$(document).ready(function(){

        });
        function add_cart(id,q){
            $("#cart-menu").load("../engine/cart.php",{add_cart : id, action : "add", qty : q}, function(){
                swal({
                    text: "Added to cart",
                    icon:"success",
                    timer: 1000,
                    button: false,
                });
            });
        }
        function cart_detail(id){
            var q = document.getElementById("qty").value;
            var c = document.getElementById("color-section").value;
            $("#cart-menu").load("../engine/cart.php",{add_cart : id, action : "add", qty : q, col : c}, function(){
                swal({
                    text: "Added to cart",
                    icon:"success",
                    timer: 1000,
                    button: false,
                });
            });
        }
        function remove_cart(id){
            swal({
                title:"Are you sure?",
                icon:"warning",
                buttons: true,
                dangerMode: true,
                }).then((willDelete) => {
                        if (willDelete) {
                            $("#cart-menu").load("../engine/cart.php",{remove_cart : id, action : "remove"},function(){
                                        swal({
                                            text: "Removed from cart",
                                            icon:"success",
                                            timer: 1000,
                                            button: false,
                                        });
                                        setTimeout(function(){location.reload(true);},1000);
                            });
                        }

                    });

        }
        function change_cart(id){
            var sel = document.getElementById("qty"+id).value;
            $.post( "../engine/cart.php", { action: "change", change_cart: id, qty : sel } )
            .done(function() {
                swal({
                    text: "Cart updated",
                    icon:"success",
                    timer: 1000,
                    button: false,
                });
                setTimeout(function(){location.reload(true);},1000);
            });

        }