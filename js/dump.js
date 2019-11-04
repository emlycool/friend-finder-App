/*
      var field = document.getElementsByClassName("comment");
      field[0].addEventListener("keyup", function(event) {
        if (event.keyCode === 13) {
         event.preventDefault();
         document.getElementById("comment-btn").click();
         $(".comment").val("");
        }
      });
      */
      $(".comment").keyup(function(e){
        
        if(e.which == 13){
          function comment(){
            $('.comment-btn').click();
          return false;  
          }
          
        }
      });//enter key to click button
      function man(id){
        if (window.XMLHttpRequest){
                        xmlhttp=new XMLHttpRequest();
                    }

                    else{
                        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
                        }                                        
                    xmlhttp.open("POST","../engine/comment-function.php",true);
                    xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
                    xmlhttp.send("modal_cid="+id);
                   // alert('Friend Request Sent');
                    //$("#reset").load(" #reset");
                    setTimeout(function() { 
                      
                      location.reload(true);
                      $(window).on('load', function(){
                      $('#commentModal').modal('show');
                      });
                      

                    }, 1000); 
        /*$("#comment-modal").load( "../engine/comment-function.php",{comment_id : id, rpost_id : id }, function(){
          alert("hi");
        });
        setTimeout(function() { 
        $('#commentModal').modal('show');

        }, 1000);
        
                    var post_id ='<?php echo $post_id; ?>';
                    
                    $("#reset").load("../engine/load-more.php",{all_comments : post_id}, function(){
                        
                    }).slideDown("slow");
        */
      }

      /*
      $(document).ready(function(){
        $("#myCarousel").swiperight(function(){
          $(this).carousel('prev');
        });
        $("#myCarousel").swipeleft(function(){
          $(this).carousel('next');
        });
      });
      */
