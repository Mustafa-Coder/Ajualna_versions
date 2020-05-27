<?php 

if (version_compare(PHP_VERSION,'7.0.0') >= 0) {

    session_start(array(
        'cache_limiter' => 'private',
        'read_and_close' => true,
    ));
}

elseif (version_compare(PHP_VERSION,'5.4.0') >= 0) {

    if(session_status() == PHP_SESSION_NONE){
        session_start();
    }
}

else {

    if (session_id() == ' ') {
        session_start();
    }
}

if(isset($_SESSION['user'])):
    header("location:home.php");
    exit;
endif;
$PAGENAME = 'Signup | JEEL'; // Name page
include 'init.php'; // include all files in resources
?>
<body>
<!-- Login page   -->
<!-- Navbar -->
<header>
    <nav class=" bg-light">
        <ul class="d-flex b-shadow ">
            <li class="nav-item"><a class="nav-link" href="./index.php">JEEL</a></li>
            <li class="nav-item"><a class="nav-link" href="">Team</a></li>
            <li class="nav-item"><a class="nav-link" href="">Privce Police</a></li>
        </ul>
    </nav>
</header>
<style>
    nav
    {
        box-shadow:0 0 19px #ddd;
        /* padding:10px; */
        width:100%;
        height:50px;
    }
    nav ul 
    {
        padding-top: 2px;
        list-style: none;
    }

    nav ul li a 
    {
        color:black;
        border-bottom:0px solid;
        transition:.2s ;
        opacity:.6;
    }

    nav ul li a:hover {
        border-bottom:2px solid blue;
        transition:.2s ;
        opacity:1;
        color:black; 

    }

    
</style>
<!-- end  -->
<section class="container Signuppage">
    <div class="card">
        <div class="row">
            <div class="col-lg-12">
                <!-- <h1 class="signname">Welcome to JEEL</h1>
                <p class="title_sign">
                Our generations let you know what is going on around your university 
                and your study files that you need in your school year.
                </p> -->
                <div id="loginForm" class="form-group p-4">
                    <div class="row">
                        <div class="col-md-12">
                            <label for="user">Fullname</label>
                            <input id="fullname"  type="text" class="form-control " placeholder="Fullname" require>
                        </div> 
                        <div class="col-md-12">
                            <label for="last">lastname</label>
                            <input id="last" type="text" class="form-control " placeholder="lastname">
                        </div>
                        <div class="col-md-12">
                            <label for="email">email</label>
                            <input id="email"  type="email" class="form-control " placeholder='Email'>
                        </div> 
                        <div class="col-md-12">
                            <label >Gender:</label>
                            <select class="form-control" id="gender">
                                <option selected>Gender</option>
                                <option value="male">Male</option>
                                <option value="famale">Famale</option>
                            </select>
                        </div>
                        <div class="col-md-12">
                            <label for="pass">password</label>
                            <input id="pass"  type="password" class="form-control " placeholder='password'>
                        </div> 
                        <div class="col-md-4">
                        <button id="btnLogin" class="btn btn-primary" >Sign up</button>
                        <!--  -->
                        </div>
                        
                        <div class="col-md-12">
                        <p id="text"></p>
                        <p>Are you have  <a href="login.php">Account</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
            <p class="copy text-center">JEEL | copyright &copy; 2020</p>
</section>
    
<!--End Login page   -->



<?php include $source . '/templates/footer.php' ?>
<script>
    $(function (){

    
        $('#pass').on('mousemove',function (){
            if ($("#fullname").val().length < 4) {
                $("#fullname").css({"borderBottom":'2px solid red'});
                $("#text").html("<div class='alert alert-danger animated pulse'> Yor fullname smaller than 4 char</div>");
            } else {
                
                $("#fullname").css({"borderBottom":'2px solid #3fa9f5'});
                $("#email").css({"borderBottom":'2px solid #3fa9f5'});
            }

            if ($("#pass").val().length < 4) {

                $("#pass").css({"borderBottom":'2px solid red'});
                $("#text").html("<div class='alert alert-danger animated pulse'>Please Yor Password smaller than 4 char</div>");

              }

              if ($("#email").val().length < 4) {

                $("#email").css({"borderBottom":'2px solid red'});
                $("#text").html("<div class='alert alert-danger animated pulse'> Yor email smaller than 4 char</div>");

              } 

              if ($("#last").val().length < 4) {

                $("#last").css({"borderBottom":'2px solid red'});
                $("#text").html("<div class='alert alert-danger animated pulse'> Yor lastname smaller than 4 char</div>");

              } 

              if ($("#gender").val()  == ' ') {

                $("#gender").css({"border":'2px solid red'});
                $("#text").html("<div class='alert alert-danger animated pulse'> Check Gender </div>");

              } 

              if ($("#gender").val().length  == 0 || $("#last").val().length == 0 || $("#email").val().length == 0 || $("#pass").val().length == 0 || $("#fullname").val().length == 0 ) {

                $("#btnLogin").attr("disabled",true);
                $("#text").html("<div class='alert alert-danger animated pulse'> Please Check From Your Information !!</div>");


              } else {
                $("#fullname").css({"borderBottom":'2px solid #3fa9f5'});
                $("#last").css({"borderBottom":'2px solid #3fa9f5'});
                $("#email").css({"borderBottom":'2px solid #3fa9f5'});
                $("#pass").css({"borderBottom":'2px solid #3fa9f5'});
                $("#text").text("");
                $("#btnLogin").attr("disabled",false);
               

                $("#btnLogin").on("click",function(){

                    let user = $("#fullname").val(),
                      last = $("#last").val(),
                      email = $("#email").val(),
                      gender = $("#gender").val(),
                      pass = $("#pass").val();

                    //   console.log(user + last + email + gender + pass);

                $.ajax({


                    method:'POST',
                    url:'./data/sign_login_update_delete_user.php',
                    data:{'req':"signup",'full':user,'pass':pass,'last':last,'email':email,'gender':gender},
                    success:function(data,stats) {
                        console.log(data);
                        console.log(stats);
                        if (data == 'Done') {
                            $("#btnLogin").hide();
                            $("#text").html("<div class='text-dark'>Done...</div>");
                            setTimeout(() => {window.location.href="home.php"},2000); 
                        }
                        if (data) {

                            $("#btnLogin").show(100);
                            $("#text").html(data);

                        }
                           
                        
                    }

                });

                });

               

            }
        });
                 
      




    });
</script>