<?php 
session_start();
if(isset($_SESSION['user'])):
    header("location:dashboard.php");
    exit;
endif;
$PAGENAME = 'تسجيل الدخول'; // Name page
include 'init.php'; // include all files in resources
?>

<!-- Login page   -->
<section class="container loginPages">
    <h1 class="py-3 mt-3 text-center">AJUALNA</h1>
    <P class=" text-center">مرحبا بعودتك </P>
    <div class="row">
        <div class="col-lg-12">
            <div id="loginForm" class="form-group card p-4">
                <div class="row">
                    <div class="col-md-12">
                        <input id="user"  type="text" class="form-control" placeholder="الاسم المستخدم">
                    </div>
                    <div class="col-md-12">
                        <input id="pass" type="password" class="form-control" placeholder="كلمة السر">
                    </div>
                    <div class="col-md-4">
                    <button id="btnLogin" class="btn btn-primary">تسجيل</button>
                    <!--  -->
                    </div>
                    <div class="col-md-12">
                    <p id="text"></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
            <p class="copy text-center">AJUALNA | copyright &copy; 2020</p>
</section>
    
<!--End Login page   -->



<?php include $source . '/templates/footer.php' ?>
<script>
    $(function (){

    
        $('#btnLogin').on('click',function (){
            if ($("#user").val().length < 4) {
                $("#user").css({"borderBottom":'2px solid red'});
            }else {
                
                $("#user").css({"borderBottom":'2px solid #3fa9f5'});
            }

            if ($("#pass").val().length < 4) {
                $("#pass").css({"borderBottom":'2px solid red'});
                $("#text").text("تأكد من اسمك او كلمة السر لا تقل عن 10");

            }else {
                $("#user").css({"borderBottom":'2px solid #3fa9f5'});
                $("#text").text("");

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
                            setTimeout(() => {window.location.href="dashboard.php?dash=dashboard"},250); 
                        }
                        if (data == 'wrong') {

                            $("#btnLogin").show(100);
                            $("#text").html("Please check your information !!");

                        }
                           
                        
                    }

                });

            }
        });
                 
      




    });
</script>