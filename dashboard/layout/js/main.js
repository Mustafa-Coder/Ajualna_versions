$(function () {
    // Dashboard
    //  When you click this btn  show a menu: 
    $("#menuShow").on('click',function (){
        // $("#menu").toggleClass("display");
        $("#menu").show(500);

    });
     //  When you click this btn Hide a menu: 
    $("#menuHide").on('click',function (){
        $("#menu").fadeOut(900);
        // $("#menu").removeClass("display");

    });
   
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
//   ------------------ Home Page ------------------------------
    $("#showProfile").on('click', function () {
        $("#overlay").show(500);
    });
    $("#overlay").on('click', function () {
        $(this).hide(500);
    });

    // Replace Pages
    $("#dash").on('click', function () {
       setTimeout(() => {window.location.href="Dashboard.php?dash=dashboard"}, 200);
    });
    $("#home").on('click', function () {
        setTimeout(() => {window.location.href="../../../Ajualna/home.php"}, 100);
     });

    //  $("#logout").on('click',function (){
    //     setTimeout(() => {window.location.href="index.html"}, 2000);
    // });

     // When CLick this btn go to this page: publicposte
     $("#publicposte").on("click",function () {
         var userid = $("#userid").val();
        setTimeout(() => { window.location.href="dashboard.php?dash=postpub&id="+ userid +""},500);
    });

      // When CLick this btn go back in this page: Dashboard
      $("#backDash").on("click",function () {
        setTimeout(() => { window.location.href="Dashboard.html" },500);
      });
      // Pages
      $("#pages").on("click",function () {
        var userid = $("#userid").val();
        setTimeout(() => { window.location.href="dashboard.php?dash=pages&id="+ userid +""},500);
      });  

      // Messages Pages

      $("#message").on("click",function () {
        setTimeout(() => { window.location.href="messages.html" },500);
      });  

      // logout page dashboard
      $("#logout").on("click",function () {
        setTimeout(() => { window.location.href="logout.php" },500);
      }); 
// Index file 

    $("#signup").on('click',function (){
        $(this).hide(300);
        $(this).text('lading...');
        setTimeout(() => {window.location.href="home.html"}, 2000);
    });
    // When click this btn refresh page to sign page :
    $("#signuppage").on('click',function (){
        setTimeout(() => {window.location.href="signup.html"}, 200);
    });
    // When click this btn refresh page to login page :
    $("#login").on('click',function (){
        setTimeout(() => {window.location.href="login.html"}, 200);
    });

// public page 
// hide notes 


          document.querySelectorAll("overlay-page").forEach(item => {

            item.on('click', function () {
                item.hide(1000);
            });
              
          });


    //Pages: Hidden
    $("#ShowElementHide").on('click',function (){
        $("#overlay-pages").show(250);
    });
    // HidePages
    $("#HidePages").on('click',function (){
        $("#overlay-pages").hide(250);
        $("#elements").css({'opacity':'.5'});
        // $(this).append('<button id="Showpage" class="btn btn-primary  mr-2">اظهار</button>');

        // $("#ShowElementHide").text('اظهار');
        // $("#elements").appendTo('');
    });

    
    // Pages: Delete
    $("#ShowElementDelete").on('click',function (){
        $("#overlay-pages-delete").show(250);
    
    });

    // page show 
    $("#Showpage").on('click',function (){

        $("#overlay-pages-show").show(250);
        // $(this).append('<button id="ShowElementHide" class="btn btn-primary  mr-2">اخفاء</button>');

    
    });

    
    // ShowElement
    $("#ShowElement").on('click',function (){
        $("#overlay-pages-show").hide(250);
    });

    // Add-Page
    $("#Add-Page").on("click",function (){
        $("#overlay-pages-add").show(250);
    });

      
    

    // Poste public page =====================================================
        // function CreatePostPublic
        let CreatePostPublic = _ => 
        {
            // Get Data
            const title = $("#titlepost").val(),
                description = $("#descp").val(),
                userid = $("#userid").val();
                //   console.log(title + description + userid);
                
            // Ajax Send Data.....
            $.ajax({
                method:"POST",
                url:'/Ajualna/dashboard/data/post.php',
                data:{'req':'post','title':title,'descp':description,'userid':userid},
                success:function(data,stats){
                if (data == 'Create') {$("#showresualt").html("You Create Post now");}
                if (data == 'Wrong') {$("#showresualt").html('Please Check from your information');}

                    //  console.log(data);
                },
                error:function(err){
                    console.log(err);
                }
            });

            // test

            

        }

        // When Click this btnpost do this:
        $("#btnpost").on("click",function(){CreatePostPublic()});




    // Hide PAGES IN SETTINGS PAGE 
    // HidePages
    let PageSettings = (id,namepage,status,other = null) => 
    {
        const address = id; // this is id pages for hide and delete and show
        // console.log(address + namepage + status);

        $.ajax({

            method:'POST',
            url:'/Ajualna/dashboard/data/' + namepage + '.php',
            data:{'req':''+status+'','id':address,'namepage':other},
            success:function(data,stats){
                console.log(data);
                console.log(stats);
            }

        });
              
    }

     // When Click this HidePages do this:
     $("#HidePages").on("click",function(){
            var idpage = $("#pageid").text();
            PageSettings(idpage,"settings","allowed");
        });
    // When Click this Show page and do this: ShowElement
    $("#ShowElement").on("click",function(){
        var idpage = $("#pageid").text();
        $("#elements").css({'opacity':'1'});
        PageSettings(idpage,"settings","notallowed");
    });
    // When Click this DelPages do this:
    $("#DelPages").on('click',function (){
        $("#overlay-pages-delete").hide(250);
        $("#elements").fadeOut(350);
        var idpage = $("#pageid").text();
        PageSettings(idpage,"settings","delete");
    });
    // When Click this btn do this:
    // Pages: Create page

    $("#create").on('click',function (){
        $("#overlay-pages-add").hide(250);
        var idpage = $("#userid").val(),
           namepage = $("#namepage").val();
        PageSettings(idpage,"settings","create",namepage);
    });
});