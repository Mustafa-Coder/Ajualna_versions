<?php 
$PAGENAME = 'JEEL | For University';
include 'init.php';
?>
<!-- Home page   -->
    <section class="container-fiuld home-page">
    <?php  include $source . '/templates/navbar.php'; ?>
       <div class="row  m-3">
            <div class="col-lg-6">
                <div class="py-5 mt-5">
                <h1 class="py-2 text-light">JEEL</h1>
                <h2 class="text-light py-1">Get Your Best Day With Your University Friends </h2>
                <p class="text-light">Our generations let you know what is going on around your university 
                and your study files that you need in your school year.</p>
                <a style="width:150px;box-shadow:0 15px 22px #55555561" class="btn btn-primary" href="./signup.php">Signup</a>
                <a style="width:150px;box-shadow:0 15px 22px #55555561" class="btn btn-info" href="./login.php">Login</a>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="img">
                    <img src="./layout/images/per/01.jpeg" alt="student"  style="width:520px;    box-shadow: 0 0 27px #2828288a;">
                </div>
            </div>
       </div>
    </section>
    <section class="container about mb-5">
        <div class="row">
            <div class="col-lg-6">
                <div class="img">
                    <img src="./layout/images/per/02.jpeg" class="img-fiuld" style="margin-top: 67px;margin-bottom: 61px;" />
                </div>
            </div>
            <div class="col-lg-6">
                <div class="mt-5 py-3">
                    <h4 style="color:rgb(33, 33, 59);font-weight: bold;" class="mt-5">About Us </h4>
                    <p style="width:350px;">
                    In JEEL platform, everything is easy and simple, you can get your own account and then start working
                    </p>
                    <button style="width:150px;box-shadow:0 15px 22px #55555561" class="btn btn-primary">Get Now</button>
                    <!-- <ul class="mouset mt-4 d-flex">
                        <li style="list-style:none;" class="pt-2 pr-5"><i class="fab fa-facebook-f"></i></li>
                        <li style="list-style:none;" class="pt-2 pr-5"><i class="fab fa-twitter"></i></li>
                        <li style="list-style:none;" class="pt-2 pr-5"><i class="fab fa-instagram"></i></li>
                    </ul> -->
                </div>
            </div>
        </div>
    </section>
    <!-- Serbice page -->
    <section class="container-fiuld service m-3">
    <h2>What's New ?</h2>
    <p class="title">Lorem  dolor sit amet consectetur adipisicing elit. Quae, modi.</p>
    <div class="row ">
        <div class="col-lg-3">
            <div class="card border-0 p-2">
                <i class="fa fa-comment icon"></i>
                <h3>Your Chating</h3>
                <p>Simple System to start talk with friends </p>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="card border-0 p-2">
                <i class="fa fa-bug icon"></i>
                <h3>Something Wrong</h3>
                <p>When you rvail Wrong on Website , First Call you  </p>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="card border-0 p-2">
                <i class="fa fa-box icon"></i>
                <h3>Security Advanced</h3>
                <p>Your Information is secure no Hacking and no details and no visite you profile  </p>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="card border-0 p-2">
                <i class="fa fa-plus icon"></i>
                <h3>Post Global Host</h3>
                <p>You can publish your own publication on the curriculum of your country and university </p>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="card border-0 p-2">
                <i class="fa fa-comments icon"></i>
                <h3>Comments it's Easy</h3>
                <p>You can publish your own publication on the curriculum of your country and university </p>
            </div>
        </div>
        </div>
    </div>
    </section>
<style>

.service h2 
{
    font-size: 24px;
    font-weight: 600;
    border-bottom: 3px solid rgb(140, 141, 240);
    width: 208px;
}

.service .title 
{
    font-size: 12px;
    color: rgb(77, 78, 121);
}

.service .card 
{
    width: 100%;
    opacity: .7;
    height: 180px;
    transition: .6s;
    margin-bottom: 17px;
}
.service .card:hover
{
    opacity: 1;
    box-shadow: 0px 5px 0px 0px rgba(96, 97, 238, 0.77);
    transition: .6s;
    /* border-bottom:2px solid rgba(96, 97, 238, 0.77); */
        
}

.service .card .icon
{
    width: 40px;
    height: 40px;
    margin: 10px;
    background: rgb(96, 97, 238);
    padding: 10px;
    color:white;
    border-radius: 30px;
    box-shadow: 0 0 0px 7px rgba(96, 97, 238, 0.38);
}

.service .card h3 
{
    font-size: 18px;
    font-weight: 600;
    margin: 5px;
}
.service .card p
{
    font-size: 13px;
    color: rgb(61, 81, 99);
}
</style>
<!--End Home page   -->
<?php include $source . '/templates/footer.php'; ?>