
<?php 
session_start();
if(isset($_SESSION['user'])):
    header("location:dashboard.php");
    exit;
endif;
$PAGENAME = 'تسجيل الدخول'; // Name page
include 'init.php'; // include all files in resources
?>
<body style="background-image:url('./layout/images/ico-bg.png');height:100%;background-repeat: no-repeat;">
<!-- Login page   -->

<section class="container loginPages">
    <div class="card">
        <div class="row">
            <div class="col-lg-6">
                <h1 class="login_name">Login | Ajualna</h1>
                <div id="loginForm" class="form-group p-4">
                    <div class="row">
                        <div class="col-md-12">
                            <label for="user">Username</label>
                            <input id="user"  type="text" class="form-control form-control-lg" placeholder="Username">
                        </div>
                        <div class="col-md-12">
                            <label for="pass">password</label>
                            <input id="pass" type="password" class="form-control form-control-lg" placeholder="password">
                        </div>
                        <div class="col-md-4">
                        <button id="btnLogin" class="btn btn-primary">Login</button>
                        
                        <!--  -->
                        </div>
                        <div class="col-md-12">
                        <p id="text"></p>
                        <p>Don't Have <a href="signup.php">Account</a></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="overlay">
                <h1 class="py-3 mt-3 text-center">AJUALNA</h1>
                <P class=" text-center">
                Ajyalna website Share with us what is going on around your university, college or field of study
                </P>
                </div>
                <img src="./layout/images/log-bg.jpeg"  class="img-fiuld log-img" alt="">
            </div>
        </div>
    </div>
            <p class="copy text-center">AJUALNA | copyright &copy; 2020</p>
</section>
    
<!--End Login page   -->



<?php include $source . '/templates/footer.php' ?>
<script>
    $(function (){

    
        $('#pass').on('mousemove',function (){
            if ($("#user").val().length < 4) {

                $("#user").css({"borderBottom":'2px solid red'});
                $("#text").text(" Your username smaller than 4 char ");

            }

            if ($("#pass").val().length < 4) {
                
                $("#pass").css({"borderBottom":'2px solid red'});
                $("#text").text(" Your Password smaller than 4 char ");

            }
            
            if ($("#pass").val().length == 0 || $("#user").val().length == 0 ) {
                $("#user").css({"borderBottom":'2px solid red'});
                $("#pass").css({"borderBottom":'2px solid red'});
                $("#text").text(" Please Check from Your Information !! ");
                $("#btnLogin").attr("disabled",true);

            }else {
                $("#user").css({"borderBottom":'2px solid #3fa9f5'});
                $("#pass").css({"borderBottom":'2px solid #3fa9f5'});
                $("#text").text("");
                $("#btnLogin").attr("disabled",false);

                $("#btnLogin").on("click",function(){

                
                const user = $("#user").val(),
                      pass = $("#pass").val();

                $.ajax({


                    method:'POST',
                    url:'./data/sign_login_update_delete_user.php',
                    data:{'req':'login','user':user,'pass':pass},
                    success:function(data,stats) {
                        console.log(data);
                        console.log(stats);
                        if (data == 'welcome') {
                            $("#btnLogin").hide();
                            $("#text").html(data);
                            setTimeout(() => {window.location.href="home.php"},1000); 
                        }
                        if (data == 'wrong') {

                            $("#btnLogin").show(100);
                            $("#text").html("Please check your information !!");

                        }
                           
                        
                    }

                });

            });

            }
        });
                 
      




    });
</script>