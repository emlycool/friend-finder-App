      function unfriend(id){
        swal({
                                title:"Are you sure?",
                                icon:"warning",
                                buttons: true,
                                dangerMode: true,
                            })
                  .then((willDelete) => {
                    if (willDelete) {
                      setTimeout(function() { 
                      $("#friend-toggle").load("../engine/test2.php",{unfriend_id : id}, function(){
                          swal("Poof! Unfriended", {
                            icon: "success",
                            timer: 1000,
                          }); 
                       
                      });

                    }, 1000);
                      
                    } 
                  });
      }
      function add_friend(id){

        if (window.XMLHttpRequest){
             xmlhttp=new XMLHttpRequest();
                }

                else{
              xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
                    }

                xmlhttp.open("POST","../engine/insert.php",true);
                xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
                xmlhttp.send("add_friend_id="+id);
               // alert('Friend Request Sent');
                var checkBtn = document.getElementById(id).innerHTML;
                if(checkBtn == "Add Friend"){
                document.getElementById(id).innerHTML = "Request Sent";
                }

                 if(checkBtn == "Request Sent"){
                document.getElementById(id).innerHTML = "Request Canceled";
                }

                 if(checkBtn == "Request Canceled"){
                document.getElementById(id).innerHTML = "Request Sent";
                }
               // $("#"+id).load(" #"+id);
               
      } 
      function commentbtn(id){
        
                    setTimeout(function() { 
                      $("#comment-modal").load( "../engine/comment-function.php",{modal_post : id}, function(){
                        
                        $('#view-comment-btn').trigger('click');
                      });

                    }, 500);
      }
      function Mimgbtn(id){
                    
                   // alert('Friend Request Sent');
                    //$("#reset").load(" #reset");
                    setTimeout(function() { 
                      $("#img-modal").load( "../engine/test2.php",{modal_img : id}, function(){
                        $('#img-modalbtn').trigger('click');
                      });

                    }, 500);
      }
      function Mvidbtn(id){
                    
                    //alert('Friend Request Sent');
                    //$("#reset").load(" #reset");
                    setTimeout(function() { 
                      $("#vid-modal").load( "../engine/test2.php",{modal_vid : id}, function(){
                        
                        $('#vid-modalbtn').trigger('click');

                      });

                    }, 500);
      }
      function loadComments(count){
                    $("#load-btn").html('<i class="fa fa-spinner fa-spin"></i> &nbsp; Please wait');
                    var post_id = document.getElementById("input").value;
                    var Newcount = count + 2;
                    $("#loadC-section").load("../engine/load-more.php",{all_Scomment : Newcount, lpid : post_id}, function(){
                    }).slideDown(4000);
                    
                }
      function comment(id){
                    $("#comment-btn-"+id).html('Sending');
                    if (window.XMLHttpRequest){
                        xmlhttp=new XMLHttpRequest();
                    }

                    else{
                        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
                        }
                    var text = document.getElementById("comment-input"+id).value;                                        
                    xmlhttp.open("POST","../engine/insert.php",true);
                    xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
                    xmlhttp.send("Scomment="+text + "&Spost_id="+id);
                   // alert('Friend Request Sent');
                    //$("#reset").load(" #reset");
                    setTimeout(function() {
                        $("#user-comment").load( "../engine/comment-function.php",{Spost_id : id }, function(){
                            swal({
                                text: "Commented",
                                icon:"success",
                                timer: 1000,
                                button: false,
                            });
                            $("#comment-input"+id).val("");                     
                            $("#comment-btn-"+id).html('Send');
                            setTimeout(function() { $("#loadC-section").load("../engine/feed-reload.php",{comment_feed : 'reload', cpid : id }, function(){
                                        }).fadeIn(4000);
                          }, 10000); 
                        });
                    }, 1000); 
        }
      function like(id){
                    $("#viewrs_"+id).load("../engine/test2.php",{Slike_id : id });
      }
      function dislike(id){
                    $("#viewrs_"+id).load("../engine/test2.php",{dislike_id : id });
      }    
      $("#file").on("change", function() {
        if ($("#file")[0].files.length > 7) { 
          swal({
            text: "You can select only 7 images",
            icon:"warning",
            button: true,
          });
            document.getElementById("Pupload-btn").disabled = true;
        } else {
         document.getElementById("Pupload-btn").disabled = false;
         }
      });