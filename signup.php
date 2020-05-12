<?php 
session_start();
if(isset($_SESSION['user'])):
    header("location:home.php");
    exit;
endif;
$PAGENAME = 'Signup page'; // Name page
include 'init.php'; // include all files in resources
?>
<body>
<!-- Login page   -->

<section class="container Signuppage">
    <div class="card">
        <div class="row">
            <div class="col-lg-6">
                <h1 class="signname">Welcome to Ajualna</h1>
                <p class="title_sign">
                Our generations let you know what is going on around your university 
                and your study files that you need in your school year.
                </p>
                <div id="loginForm" class="form-group p-4">
                    <div class="row">
                        <div class="col-md-12">
                            <label for="user">Fullname</label>
                            <input id="fullname"  type="text" class="form-control form-control-lg" placeholder="Fullname" require>
                        </div> 
                        <div class="col-md-12">
                            <label for="last">lastname</label>
                            <input id="last" type="text" class="form-control form-control-lg" placeholder="lastname">
                        </div>
                        <div class="col-md-12">
                            <label for="email">email</label>
                            <input id="email"  type="email" class="form-control form-control-lg" placeholder='Email'>
                        </div> 
                        <div class="col-md-12">
                            <label >Gender:</label>
                            <select class="form-control" id="gender">
                                <option value="male">Male</option>
                                <option value="famale">Famale</option>
                            </select>
                        </div>
                        <div class="col-md-12">
                            <label for="pass">password</label>
                            <input id="pass"  type="password" class="form-control form-control-lg" placeholder='password'>
                        </div> 
                        <div class="col-md-4">
                        <button id="btnLogin" class="btn btn-primary">Sign up</button>
                        <!--  -->
                        </div>
                        
                        <div class="col-md-12">
                        <p id="text"></p>
                        <p>Are you have  <a href="login.php">Account</a></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <!-- <div class="overlay">
                <h1 class="py-3 mt-3 text-center">AJUALNA</h1>
                <P class=" text-center">
                Ajyalna website Share with us what is going on around your university, college or field of study
                </P>
                </div> -->
                <img src="./layout/images/stud.png"  class="img-fiuld log-img" alt="">
            </div>
        </div>
    </div>
            <p class="copy text-center">AJUALNA | copyright &copy; 2020</p>
</section>
    
<!--End Login page   -->



<?php include $source . '/templates/footer.php' ?>
<script>
    $(function (){

    
        $('#btnLogin').on('mousedown',function (){
            if ($("#fullname").val().length < 4 || $("#email").val() == '') {
                $("#fullname").css({"borderBottom":'2px solid red'});
                $("#email").css({"borderBottom":'2px solid red'});
            }else {
                
                $("#fullname").css({"borderBottom":'2px solid #3fa9f5'});
                $("#email").css({"borderBottom":'2px solid #3fa9f5'});
            }

            if ($("#pass").val().length < 4) {

                $("#pass").css({"borderBottom":'2px solid red'});
                $("#text").html("<div class='alert alert-danger animated pulse'>Welcome...</div>");

            }else {
                $("#fullname").css({"borderBottom":'2px solid #3fa9f5'});
                $("#text").text("");

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
                            $("#text").html("<div class='alert alert-success animated flash'>Please Check from your information !!</div>");
                            setTimeout(() => {window.location.href="home.php"},2000); 
                        }
                        if (data == 'wrong') {

                            $("#btnLogin").show(100);
                            $("#text").html("<div class='alert alert-danger animated pulse'>Please Check from your information !!</div>");

                        }
                           
                        
                    }

                });

            }
        });
                 
      




    });
</script>