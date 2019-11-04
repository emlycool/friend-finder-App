$(document).ready(function(){
                        $("#upload").submit(function(e){
                                e.preventDefault();
                              
                                $.ajax({
                                    type: "POST",
                                    url: "../engine/insert.php",
                                    data: new FormData(this),
                                    cache: false,
                                    contentType: false,
                                     processData: false,
                                     beforeSend: function() {
                                    //$('#maincontainer').hide();
                                     //$('#mainloader').show();
                                     
                                   },
                                   complete: function() {
                                  
                                     
                                     // $('#maincontainer').show();
                                      //$('#mainloader').hide();
                                    },   
                                    success: function(html){
                                                                           
                                   

                                     if(html == "done"){
                                      swal({
                                        text: "Published",
                                        icon:"success",
                                        timer: 1000,
                                        button: false,
                                      });
                                      $('#uploadModal').modal('hide');
                                      $("#feed").load("../engine/feed-reload.php",{newsfeed : 'reload'}, function(){
                                        }).fadeIn(4000);
                                      $("#imgfeed").load("../engine/feed-reload.php",{imgfeed : 'reload'}, function(){
                                        }).fadeIn(4000);
                                     }else{
                                      $("#PICpreview-error").fadeIn(1000, function(){                        
                                                $("#PICpreview-error").html('<div class="alert alert-danger"> <span class="glyphicon glyphicon-info-sign"></span> &nbsp; '+html+' !</div>');
                                                
                                      });
                                     }
                                    }
                                });
                                return false;
                            });
                            $("#textUpload").submit(function(e){
                                e.preventDefault();
                              
                                $.ajax({
                                    type: "POST",
                                    url: "../engine/insert.php",
                                    data: new FormData(this),
                                    cache: false,
                                    contentType: false,
                                     processData: false,
                                     beforeSend: function() {
                                    //$('#maincontainer').hide();
                                     //$('#mainloader').show();
                                     
                                   },
                                   complete: function() {
                                  
                                     
                                     // $('#maincontainer').show();
                                      //$('#mainloader').hide();
                                    },   
                                    success: function(html){
                                                                           
                                   

                                     if(html == "ok"){
                                      swal({
                                        text: "Published",
                                        icon:"success",
                                        timer: 1000,
                                        button: false,
                                      });
                                      $('#textModal').modal('hide');
                                      $("#feed").load("../engine/feed-reload.php",{newsfeed : 'reload'}, function(){
                                        }).fadeIn(4000);   
                                     }else{
                                      $("TEXTpreview-error").fadeIn(1000, function(){                        
                                                $("#TEXTpreview-error").html('<div class="alert alert-danger"> <span class="glyphicon glyphicon-info-sign"></span> &nbsp; '+html+' !</div>');
                                                
                                            });
                                     }
                                    }
                                });
                                return false;
                            });
                            $("#videoUpload").submit(function(e){
                                e.preventDefault();
                              
                                $.ajax({
                                    type: "POST",
                                    url: "../engine/insert.php",
                                    data: new FormData(this),
                                    cache: false,
                                    contentType: false,
                                     processData: false,
                                     beforeSend: function() {
                                    //$('#maincontainer').hide();
                                     //$('#mainloader').show();
                                     
                                   },
                                   complete: function() {
                                  
                                     
                                     // $('#maincontainer').show();
                                      //$('#mainloader').hide();
                                    },   
                                    success: function(html){
                                                                           
                                   

                                     if(html == "done"){
                                      swal({
                                        text: "Published",
                                        icon:"success",
                                        timer: 1000,
                                        button: false,
                                      });
                                      $('#videoModal').modal('hide');
                                      $("#feed").load("../engine/feed-reload.php",{newsfeed : 'reload'}, function(){
                                        }).fadeIn(4000);   
                                     }else{
                                      $("#VIDpreview-error").fadeIn(1000, function(){                        
                                                $("#VIDpreview-error").html('<div class="alert alert-danger"> <span class="glyphicon glyphicon-info-sign"></span> &nbsp; '+html+' !</div>');
                                                
                                            });
                                     }
                                    }
                                });
                                return false;
                            });
                        });  
$(window).on('load', function(){
        
        setInterval(function(){
          $("#feed").load("../engine/feed-reload.php",{newsfeed : 'reload'}, function(){
          }).fadeIn(4000);
          }, 100000);
      });