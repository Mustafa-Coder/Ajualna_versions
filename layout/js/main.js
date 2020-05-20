$(function () {
    // function to redirect in anypages
    let GoPages = (url,number = 500) =>  {setTimeout(() => { window.location.href=""+ url +"" }, number);}

    // LOGIN PAGE
    $('#login').on('click',function (){
        GoPages("login.php");
    });

    $("#dash").on('click', function () {
        GoPages("../../Ajualna/dashboard/dashboard.php?dash=dashboard");
     });

       $("#logout").on('click',function (){

             GoPages("../../Ajualna/logout.php");

        });

        // Redirect on profilepage:
        $("#profilepage").on('click', function () {
            var userid = $("#userid").val();
            GoPages("../../Ajualna/u/profile.php?user=profilepage&id="+ userid +"");
         });

         // Redirect on logout when your delete account:
        //  deleteUser
        let DeleteUser = _ =>
        {
            var id = $("#userid").val(),
                text = $("#textDeleteMesg");

            $.ajax({


                method:"POST",
                url:"/Ajualna/data/sign_login_update_delete_user.php",
                data:{"req":"DeleteUser","id":id},
                success:function(data,stats){
                    if(data == 'Delete')
                    {
                        text.html("<div class='alert alert-primary p-2 mt-2'>Your Delete Your Acount no you will redirect login Welcome again... 10s</div>");
                        $("#deleteUser").hide(100);
                    }else
                    {
                        console.log(data);
                        console.log(stats);
                    }
                }

            });
        }

        $("#deleteUser").on('click', function () {
            setTimeout(() => { window.location.href="/Ajualna/logout.php" }, 10000);
            DeleteUser();
         });

    // SETTINGS NOTIFICATION BAR

     //  When you click this btn show menu profile:
     $("#ShowMenuPerson").on('click',function (){
        $("#moadlMenu").toggleClass('display');
        $("#modalNotif").removeClass("display");

    });
    $("#ShowNotification").on('click',function () {
        $("#moadlMenu").removeClass('display');
        $("#modalNotif").toggleClass("display");
    });
    $(".container").on('click', function () {
        $("#moadlMenu").removeClass('display');
        $("#modalNotif").removeClass("display");
     });

     // Redirect Page > EDIT PROFILE
    //  profiledit
    $("#brandhome").on('click',function (){
        GoPages("../../Ajualna/home.php");

   });



//    console.log($("#oldcollege").val());


   // oldcollege newcollege  saxuser old-pass new-pass
//    SETTING

// USER SYSTEM EDIT DELETE  ============================================================
let male = $("#male").val(),
   famale = $("#famale").val();
    // console.log(male + famale);
    let editUserInfo = _ =>
    {
        let oldcollege = $("#oldcollege").val(),
              newcollege = $("#newcollege").val(),
            //   saxuserman = $("#saxuserman").val(),
            //   saxuserwomen = $("#saxuserwomen").val(),
              Gender = $("#Gender").val(),
              national = $("#nationalnum").val(),
              lastN = $("#last").val(),
              userN = $("#user").val(),
              email = $("#email").val(),
              oldPass = $("#old-pass").val(),
              newPass = $("#new-pass").val(),
              langs = $("#langs").val(),
              country = $("#country").val(),
              numphone = $("#numberphone").val(),
            //   information user
              userid = $("#userID").val(),
              collegeid = $("#collegeid").val();


            $.ajax({

                method:"POST",
                url:"/Ajualna/data/sign_login_update_delete_user.php",
                data:{
                    "req":"update",
                    "user":userN,
                    "last":lastN,
                    "email":email,
                    "oldpass":oldPass,
                    "newpass":newPass,
                    "national":national,
                    "Gender":Gender,
                    "langs":langs,
                    "country":country,
                    "Np":numphone,
                    // "famale":famale,
                    "userid":userid,
                    "collegeid":collegeid},
                success:function(data,stats){
                    if(data == 'Done'){
                      $("#html").html('<div class="alert alert-primary">Succssfully Updating </div>');
                    }

                    if(data == 'wrong'){
                        $("#html").html('<div class="alert alert-danger">Nothing Updating </div>');
                    }
                }

            });






    }

    $("#update").on("click",function(){
        editUserInfo();
    });


    // Uploade file on database for avatar

    $("#openfile").on("click",function(){
        $("#fileToUpload").click();
    });

    // DARKMODE 

        // When push btn dark do this :
        $("#darkmode").on("click",function(){
            let dark = $("#darkmode").val(),
                id = $("#id").val();

            $.ajax({
                type:"post",
                url:"/Ajualna/data/settings.php",
                data:{"req":"darkmode","modes":dark,"id":id},
                success:function(data,stats){
                    if(data == 'Done'){
                        $("#modes").html('<div class="alert alert-dark alert-sm p-3 w-50 m-auto"><i class="fas fa-cloud-showers-heavy"></i> Dark Mode</div>');
                    }
                    console.log(data);

                }
            });

        });

        // When push btn light do this :
        $("#lightmode").on("click",function(){
            let dark = $("#lightmode").val(),
                id = $("#id").val();

            $.ajax({
                type:"post",
                url:"/Ajualna/data/settings.php",
                data:{"req":"darkmode","modes":dark,"id":id},
                success:function(data,stats){
                    if(data == 'Done'){
                        $("#modes").html('<div class="alert alert-primary alert-sm p-3 w-50 m-auto"><i class="fas fa-sun"></i> Light Mode</div>');
                    }

                    console.log(data);
                }
            });

        });

// END USER SYSTEM EDIT DELETE  ============================================================

//  POST SYSTEM EDIT DELETE  ============================================================


    // SYSTEM SEND POST DATA IN DATABASE:::::::::::
    // userid name college photo postbtn

    let CreatePost = _ =>
    {
        var id = $("#userid").val(),
              name = $("#name").val(),
              desc = $("#description").val(),
              photo = $("#photo").val(),
              country = $("#country").val(),
              college = $("#college").val(),
              private = $("#private").val();


            $.ajax({

                method:"POST",
                url:"/Ajualna/data/post.php",
                data:{
                    "req":"createpost",
                    "id":id,
                    "name":name,
                    "desc":desc,
                    "college":college,
                    "country":country,
                    "photo":photo,
                    "private":private

                     },
                beforeSend:function(){
                    $("#text").show(100);
                    $("#info").show(1000);
                    $("#info").css({"display":"flex"});
                    $("#notification").show(200);
                },
                success:function(data,stats){
                    if(data == 'Done'){
                        $("#description").html('');
                        $("#text").html('<div class="animated bounceOutDown slow" id="postsuccess"><i class="fas fa-mail-bulk"></i> Success</div>');
                        // $("#text").hide(10000);
                        $("#postmusic")[0].play();
                        $("#postmusicnotif")[0].play();



                     }else
                     {
                         console.log(data);
                         console.log(stats);
                     }

                    // if(data){
                        // console.log(data);
                        // console.log(stats);
                    // }
                },
                error:function(err){
                    console.log(err);
                }

            });

            // get all data about posts

            $.ajax({
                type:"post",
                url:"/Ajualna/data/fetch_data.php",
                data:{"req":"getposts"},
                beforeSend:function(){$("#waitingpost").show(10);},
                success:function(data,stats){console.log(stats); $("#showposts").html(data);$("#waitingpost").addClass("fadeIn");}
            });









    }

    // Create Post in database
    // When Message is empty : 
    $("#description").on("mousemove",function (){
        console.log();
        if($("#description").val().length === 0){
            $("#postbtn").attr("disabled",true);
        }else {
            $("#postbtn").attr("disabled",false);
        }
    });

    $("#postbtn").on("click",function(){
        CreatePost();
    });

    // Foucs on add_post:::
    $("#add_post").on("mousemove",function(){
        $("#messagecard").show(500);
    });

    // Agnour on add_post:::
    $("#add_post").on("mouseleave",function(){
        $("#messagecard").hide(500);
    });

    // remove active  on notif btn post message:::
    $("#notification").on("click",function(){
        $(this).hide(200);

        
    });

   
    // Edit post
   
  

        // console.log($("#btneditpost").length);

        // for (let i = 0; i < $("#btneditpost").length; i++) {
           
        //    console.log($("#btneditpost")[i]);
            
        // }

         // AJAX TO GET POSTS DATA WHEN YOU ADD NEW POST
         $.ajax({   
            type:"post",
            url:"/Ajualna/data/fetch_data.php",
            data:{"req":"getposts"},
            beforeSend:function(){$("#waitingpost").show(10);},
            success:function(data,stats){console.log(stats); $("#showposts").html(data);$("#waitingpost").addClass("fadeIn");}
        });

        
            

           
        

    




// END POST SYSTEM EDIT DELETE  ============================================================



// pages ============================================================




    // $.ajax({
    //     type:"post",
    //     url:"/Ajualna/data/fetch_data.php",
    //     data:{"req":"getpostspage","namepage":namepage},
    //     // beforeSend:function(){$("#waitingpost").show(10);},
    //     success:function(data,stats){/*console.log(stats);*/ $("#showposts").html(data);}
    // });



    // Create PAGES in database  ============================================================================


    let Cpages = _ =>
    {
        var id = $("#userid").val(),
              pagename	 = $("#pagename").val(),
              pagetitle = $("#titlepage").val(),
              country = $("#cpage").val();


            $.ajax({

                method:"POST",
                url:"/Ajualna/data/pages.php",
                data:{"req":"createpages","id":id,"pn":pagename,"c":country,"t":pagetitle},
                success:function(data,stats){
                    if(data == 'Done'){
                        $("#text").html('<div class="animated flash slow" id="postsuccess"><i class="fas fa-university"></i> Your Create Page  </div>');
                        $("#text").hide(10000);
                        $("#postmusic")[0].play();

                     }else
                     {
                         console.log(data);
                         console.log(stats);
                     }

                    // if(data){
                    //     console.log(data);
                    //     console.log(stats);
                    //
                    // }
                },
                error:function(err){
                    console.log(err);
                }

            });


            // get all data about posts

            $.ajax({
                type:"post",
                url:"/Ajualna/data/fetch_data.php",
                data:{"req":"getpages"},
                success:function(data,stats){console.log(stats); $("#pages").html(data);}
            });









    }

    // get all data about posts load page


      $.ajax({
          type:"post",
          url:"/Ajualna/data/fetch_data.php",
          data:{"req":"getpages"},
          success:function(data,stats){/*console.log(stats);*/ $("#pages").html(data);}
      });
    

    // Show The Modal Create Page:
    $("#createpages").on("click",function (){
        $("#modalpage").show(100);
    });

    //  Create Page:
    $("#buttoncreate").on("click",function (){
        $("#modalpage").fadeOut(300);
        Cpages();
    });







//  ====================== [Support Box ] ========================== //

// username	email	messages	userid send 

let SendMessageSupport = _ =>
{ // start fun 

    // get information 
    var user = $("#username").val(),
        email = $("#email").val(),
        message = $("#message").val(),
        userid = $("#userid").val();

    // Send information in data 
    $.ajax({

        method:"POST", 
        url:"/Ajualna/data/settings.php",
        data:{"req":'sendmessage',"u":user,"e":email,"m":message,"i":userid},
        success:function(data,st){
            if(data == 'send'){
                $(".mesgrequest").html('<div class="alert alert-primary p-2 mt-3">We will review your message soon Thank you <i class="fas fa-smile-beam"></i> </div>');
            }
            if(data == 'wrong'){
                $(".mesgrequest").html('<div class="alert alert-danager p-2 mt-3">Check from Your data Before Send <i class="fab fa-tired"></i> !!</div>');
            }
            console.log(data);
        }

    });

} // end fun 


    // if(){

    // }
    // When Message is empty : 
    $("#message").on("mousemove",function (){
        console.log();
        if($(this).val().length === 0){
            $("#send").attr("disabled",true);
        }else {
            $("#send").attr("disabled",false);
        }
    });

    // When Click Send Message 
    $("#send").on("click",function (){
        SendMessageSupport();
        $("#sbm")[0].play();

    });










});



            


        