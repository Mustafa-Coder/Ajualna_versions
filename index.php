<?php 
$PAGENAME = 'AJUALNA';
include 'init.php';
?>
<?php include $source . '/templates/navbar.php'; ?>
<!-- Home page   -->
    <section class="container home-page">
        <div class="row">
            <div class="col-lg-6 mt-3">
                <h2 class="py-3 mt-5 display-3">AJUALNA</h2>
                <p>
                    اجيالنا | هى منصة تعليمية لطلاب جامعات الازهر الشريف
                    تتيح للطالب معرفة جميع ما يحتاجه لعامه الدراسى من اوراق الى منهج
                </p>
            </div>
            <div class="col-lg-6 mt-3">
                <h2 class="py-5 title-sign"> أذا كنت طالبا جديد سجل الان  او <a href="#"> سجل كافة بياناتك</a></h2>
                <div class="form-group mt-4">
                    <!-- <form > -->
                        <div class="row">
                            <div class="col-md-6">
                                <input type="text" class="form-control" placeholder="الاسم الاول">
                            </div>
                            <div class="col-md-6">
                                <input type="text" class="form-control" placeholder="الاسم الثانى">
                            </div>
                            <div class="col-md-12">
                                <input type="email" class="form-control" placeholder="البريد الاكترونى">
                            </div>
                            <div class="col-md-6">
                                <input type="password" class="form-control" placeholder="كلمة السر">
                            </div>
                            <div class="col-md-6">
                                <input type="password" class="form-control" placeholder="تأكيد كلمة السر">
                            </div>
                            <div class="col-md-4">
                                <button id="signup" class="btn btn-primary">تسجيل الان</button>
                            </div>
                        </div>
                    <!-- </form> -->
                </div>
            </div>
        </div>
    </section>
    <hr>
    <section class="container about">
        <div class="row">
            <div class="col-lg-4">
                  <!--  -->
            </div>
        </div>
    </section>
<!--End Home page   -->
<!--End Home page   -->
<?php include $source . '/templates/footer.php'; ?>