$(function () {
//     // Dashboard
//     //  When you click this btn  show a menu: 
//     $("#menuShow").on('click',function (){
//         // $("#menu").toggleClass("display");
//         $("#menu").show(500);

//     });
//      //  When you click this btn Hide a menu: 
//     $("#menuHide").on('click',function (){
//         $("#menu").fadeOut(900);
//         // $("#menu").removeClass("display");

//     });
   

// //   ------------------ Home Page ------------------------------
//     $("#showProfile").on('click', function () {
//         $("#overlay").show(500);
//     });
//     $("#overlay").on('click', function () {
//         $(this).hide(500);
//     });

//     // Replace Pages
    
//     $("#home").on('click', function () {
//         setTimeout(() => {window.location.href="home.html"}, 100);
//      });



//      // When CLick this btn go to this page: publicposte
//      $("#publicposte").on("click",function () {
//          var userid = $("#userid").val();
//         setTimeout(() => { window.location.href="dashboard.php?dash=postpub&id="+ userid +""},500);
//     });

//       // When CLick this btn go back in this page: Dashboard
//       $("#backDash").on("click",function () {
//         setTimeout(() => { window.location.href="Dashboard.html" },500);
//       });
//       // Pages
//       $("#pages").on("click",function () {
//         var userid = $("#userid").val();
//         setTimeout(() => { window.location.href="dashboard.php?dash=pages&id="+ userid +""},500);
//       });  

//       // Messages Pages

//       $("#message").on("click",function () {
//         setTimeout(() => { window.location.href="messages.html" },500);
//       });  

//       // logout page dashboard
//       $("#logout").on("click",function () {
//         setTimeout(() => { window.location.href="logout.php" },500);
//       }); 
// // Index file 

//     $("#signup").on('click',function (){
//         $(this).hide(300);
//         $(this).text('lading...');
//         setTimeout(() => {window.location.href="home.html"}, 2000);
//     });
//     // When click this btn refresh page to sign page :
//     $("#signuppage").on('click',function (){
//         setTimeout(() => {window.location.href="signup.html"}, 200);
//     });
//     // When click this btn refresh page to login page :
//     $("#login").on('click',function (){
//         setTimeout(() => {window.location.href="login.html"}, 200);
//     });

// // public page 
// // hide notes 


//           document.querySelectorAll("overlay-page").forEach(item => {

//             item.on('click', function () {
//                 item.hide(1000);
//             });
              
//           });


//     //Pages: Hidden
//     $("#ShowElementHide").on('click',function (){
//         $("#overlay-pages").show(250);
//     });
//     // HidePages
//     $("#HidePages").on('click',function (){
//         $("#overlay-pages").hide(250);
//         $("#elements").css({'opacity':'.5'});
//         // $(this).append('<button id="Showpage" class="btn btn-primary  mr-2">اظهار</button>');

//         // $("#ShowElementHide").text('اظهار');
//         // $("#elements").appendTo('');
//     });

    
//     // Pages: Delete
//     $("#ShowElementDelete").on('click',function (){
//         $("#overlay-pages-delete").show(250);
    
//     });

//     // page show 
//     $("#Showpage").on('click',function (){

//         $("#overlay-pages-show").show(250);
//         // $(this).append('<button id="ShowElementHide" class="btn btn-primary  mr-2">اخفاء</button>');

    
//     });

    
//     // ShowElement
//     $("#ShowElement").on('click',function (){
//         $("#overlay-pages-show").hide(250);
//     });

//     // Add-Page
//     $("#Add-Page").on("click",function (){
//         $("#overlay-pages-add").show(250);
//     });

      
    

//     // Poste public page =====================================================
//         // function CreatePostPublic
//         let CreatePostPublic = _ => 
//         {
//             // Get Data
//             const title = $("#titlepost").val(),
//                 description = $("#descp").val(),
//                 userid = $("#userid").val();
//                 //   console.log(title + description + userid);
                
//             // Ajax Send Data.....
//             $.ajax({
//                 method:"POST",
//                 url:'/Ajualna/dashboard/data/post.php',
//                 data:{'req':'post','title':title,'descp':description,'userid':userid},
//                 success:function(data,stats){
//                 if (data == 'Create') {$("#showresualt").html("You Create Post now");}
//                 if (data == 'Wrong') {$("#showresualt").html('Please Check from your information');}

//                     //  console.log(data);
//                 },
//                 error:function(err){
//                     console.log(err);
//                 }
//             });

//             // test

            

//         }

//         // When Click this btnpost do this:
//         $("#btnpost").on("click",function(){CreatePostPublic()});




//     // Hide PAGES IN SETTINGS PAGE 
//     // HidePages
//     let PageSettings = (id,namepage,status,other = null) => 
//     {
//         const address = id; // this is id pages for hide and delete and show
//         // console.log(address + namepage + status);

//         $.ajax({

//             method:'POST',
//             url:'/Ajualna/dashboard/data/' + namepage + '.php',
//             data:{'req':''+status+'','id':address,'namepage':other},
//             success:function(data,stats){
//                 console.log(data);
//                 console.log(stats);
//             }

//         });
              
//     }

//      // When Click this HidePages do this:
//      $("#HidePages").on("click",function(){
//             var idpage = $("#pageid").text();
//             PageSettings(idpage,"settings","allowed");
//         });
//     // When Click this Show page and do this: ShowElement
//     $("#ShowElement").on("click",function(){
//         var idpage = $("#pageid").text();
//         $("#elements").css({'opacity':'1'});
//         PageSettings(idpage,"settings","notallowed");
//     });
//     // When Click this DelPages do this:
//     $("#DelPages").on('click',function (){
//         $("#overlay-pages-delete").hide(250);
//         $("#elements").fadeOut(350);
//         var idpage = $("#pageid").text();
//         PageSettings(idpage,"settings","delete");
//     });
//     // When Click this btn do this:
//     // Pages: Create page

//     $("#create").on('click',function (){
//         $("#overlay-pages-add").hide(250);
//         var idpage = $("#userid").val(),
//            namepage = $("#namepage").val();
//         PageSettings(idpage,"settings","create",namepage);
//     });

// LAMDING PAGE 
// 

    // function to redirect in anypages
    let GoPages = (url) =>  {setTimeout(() => { window.location.href=""+ url +"" },500);}

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

    // console.log($("#fileToUpload"));

    // SYSTEM SEND POST DATA IN DATABASE:::::::::::
    // userid name college photo postbtn

    let CreatePost = _ => 
    {
        var id = $("#userid").val(),
              name = $("#name").val(),
              desc = $("#description").val(),
              photo = $("#photo").val(),
              country = $("#country").val(),
              college = $("#college").val();


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
                    "photo":photo

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

        // send data to notification column 
            // postnotif

            // $.ajax({
            //     type:"post",
            //     url:"/Ajualna/data/notifi_fun.php",
            //     data:{"req":"postnotif"},
            //     success:function(data,stats){
            //         console.log(data);
            //         console.log(stats);
            //     }

            // });
    });

    // Like System :::
    // const likes = document.querySelectorAll(".like");
    //     likes.forEach(like => {

    //        like.addEventListener("click",_ => {
    //            like.style.color="rgb(67, 154, 246)";
            
    //        });

    //     });
        
    // console.log($(".like").length);

    // for (let i = 0; i < $(".like").length; i++) {

    //     // console.log($(".like")[i]);

    //     $(".like")[i].addEventListener("click", function (){
    //         $(this).css({"color":"rgb(67, 154, 246)"});

    //         // Get A value post::
    //          var id = $(".like")[i].value;
    //          $.ajax({

    //             method:"post",
    //             url:"/Ajualna/data/post.php",
    //             data:{"req":"addlike","id":id},
    //             success:function(data,stats){
    //                 if(data == 'Done'){
    //                     console.log(data);
    //                 }

    //                 if(data == 'wrong'){
    //                     console.log(data);
    //                 }
                    
                    
    //             }
            
            
    //             });
             

                

    //     });

        
    
        
    // }

    
 
         // AJAX TO GET POSTS DATA WHEN YOU ADD NEW POST
         $.ajax({
            type:"post",
            url:"/Ajualna/data/fetch_data.php",
            data:{"req":"getposts"},
            beforeSend:function(){$("#waitingpost").show(10);},
            success:function(data,stats){console.log(stats); $("#showposts").html(data);$("#waitingpost").addClass("fadeIn");}
        });
    // Ajax Function Like system:
    // for (let i = 0; i < $(".postid").length; i++) {

    //     // var id post: 
    //     var id = $(".postid")[i].value;

    //     // Ajax Like function =======================
    //     $.ajax({

    //         method:"post",
    //         url:"/Ajualna/data/post.php",
    //         data:{"req":"addlike","id":id},
    //         success:function(data,stats){
    //             console.log(data);
    //             console.log(stats);
    //         }


    //     });
        
        
    // }






// pages ============================================================




    $.ajax({
        type:"post",
        url:"/Ajualna/data/fetch_data.php",
        data:{"req":"getpostspage","namepage":namepage},
        // beforeSend:function(){$("#waitingpost").show(10);},
        success:function(data,stats){/*console.log(stats);*/ $("#showposts").html(data);}
    });



    // Create Post in database  


});