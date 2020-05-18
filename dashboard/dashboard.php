<?php
session_start();
if (!isset($_SESSION['user']))  {
    header("location:index.php");
    exit;
}
if(isset($_SESSION['user']) && $_SESSION['admin'] == 1 ): // START PAGE
// ----------------------------------------------------------------
$PAGENAME = "Dashboard";
include './init.php';
include $source . '/templates/navbar.php'; // nativigation bar
if (isset($_GET['dash'])) {
    $dash = $_GET['dash'];
    ?><input id="userid" type="hidden" value="<?php echo $_SESSION['id'] ?>"><?php
}else {

    header("location:logout.php");
    exit;
}
switch ($dash) {
    case 'dashboard':
        // ----------------------------------------------------------------
        ?>
         <div class="container-fiuld mr-3 ml-3">
                <div class="row">
                    <div class="col-lg-4">
                    <!-- ========================[INCLUDE MENU]=============== -->
                    <?php include  $source . '/templates/menu.php'; ?>
                    <!-- ===================================================== -->
                    </div>
                    <div class="col-lg-8 mt-5 home-page ">
                        <h1 class="py-3 title-name"><?php echo lang("Dash") ?></h1>
                        <div class="row mt-4">
                            <div class="col-md-4">
                                <div class="card border-0 studient counter">
                                    <h2 class="name"><?php echo lang("ad") ?></h2>
                                    <p id="number"><?php echo Counter('signup','username'); ?></p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card border-0 pages counter">
                                    <h2 class="name"><?php echo lang("pg"); ?></h2>
                                    <p><?php echo Counter_All('pages','pagename'); ?></p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card border-0 posts counter">
                                    <h2 class="name"><?php echo lang("po") ?></h2>
                                    <p><?php echo Counter_All('posts','postid'); ?></p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card border-0 posts counter">
                                    <h2 class="name"><?php echo lang("noti") ?></h2>
                                    <p><?php echo Counter_All('notifications','id'); ?></p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card border-0 male counter">
                                    <h2 class="name"><?php echo lang("yo") ?></h2>
                                    <p><?php echo Get_People("signup","*",""); ?></p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card border-0 famale counter">
                                    <h2 class="name"><?php echo lang("box") ?></h2>
                                    <p><?php echo Counter_All("supportbox","id"); ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="row lists mt-5">
                            <div class="col-md-7">
                                <table class="table border-0">
                                        <thead>
                                            <tr>
                                            <th scope="col">#</th>
                                            <th scope="col"><?php echo lang("co") ?></th>
                                            <th scope="col"><?php echo lang("na") ?></th>
                                            <th scope="col"><?php echo lang("stu") ?></th>
                                            <th scope="col"><?php echo lang("po") ?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $pages = get_something('pages','*');
                                            foreach ($pages as $page) {
                                            ?>
                                                <tr>
                                                <th scope="row"><?php echo $page['pageid']; ?></th>
                                                <td>none</td>
                                                <td><?php echo $page['pagename']; ?></td>
                                                <td>3250</td>
                                                <td>3250</td>
                                                </tr>
                                            <?php }?>
                                        </tbody>
                                    </table>
                            </div>
                            <div class="col-md-5">
                                <table class="table border-0">
                                    <thead>
                                        <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">First</th>
                                        <th scope="col">Last</th>
                                        <th scope="col">Managment</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $admins = get_admins('signup','*');
                                        foreach ($admins as $admin) {
                                        ?>
                                            <tr>
                                            <th scope="row"><?php echo $admin['userid']; ?></th>
                                            <td><?php echo $admin['username']; ?></td>
                                            <td><?php echo $admin['lastname']; ?></td>
                                            <td><?php echo $admin['admin'] == 1 ?  "admin" :  "student";  ?></td>
                                            </tr>
                                        <?php }?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="moadlMenu" class="modal-menu card ">
                    <ul>
                        <li>رؤية الصفحة</li>
                        <li>تعديل الصفحة</li>
                        <li id="logout">تسجيل الخروج</li>
                    </ul>
                </div>
                <!-- get id  -->
                <input id="userid" type="hidden" value="<?php echo $_SESSION['id']; ?>">
            </div>
        <!-- END DASHBOARD =====================================================================  -->
        <!-- ===================================================================== -->
        <?php
        break;
        // START POST PAGE ===================================================================== -->
        case 'postpub':
            if ($_GET['dash'] == 'postpub'): // START PAGE ?>

                <div class="container-fiuld mr-3 ml-3">
                        <div class="row">
                            <div class="col-lg-4">
                                <!-- ========================[INCLUDE MENU]=============== -->
                                <?php include  $source . '/templates/menu.php'; ?>
                                <!-- ===================================================== -->
                              </div>
                                <div class="col-lg-8 mt-5 home-page ">
                                    <h1 class="py-3 title-name">منشور عام</h1>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label for="titlepost">عنوان الموضوع</label>
                                                <input id="titlepost" class="form-control mb-3" type="text" require='' >
                                            </div>
                                            <div class="col-md-12">

                                                <label for="descp">الوصف</label>
                                                <textarea id="descp" class="form-control mb-3" id="" cols="30" rows="10" require=''></textarea>
                                                <!-- get id  -->
                                                <input id="userid" type="hidden" value="<?php echo $_SESSION['id']; ?>">
                                            </div>
                                            <div class="col-md-6">
                                                <button id="btnpost" class="btn btn-primary">نشر</button>
                                                <p id="showresualt" class="mt-5"></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                        <div class="notes">
                                                <div id="note" class="alert alert-primary p-3 note">هذا المنشور سوف يعرض على جميع الصفحات الموجود فى الموقع</div>
                                                <div id="note" class="alert alert-primary p-3 note">قد يكون المنشور الذى تود نشره هو <strong>بيان رسمى او خطاب للطلاب</strong></div>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                        </div>
                        <div id="moadlMenu" class="modal-menu card ">
                            <ul>
                                <li>رؤية الصفحة</li>
                                <li>تعديل الصفحة</li>
                                <li id="logout">تسجيل الخروج</li>
                            </ul>
                        </div>
                </div>

           <?php  endif; // END PAGE
        break;
        // END POST PAGE ===================================================================== -->
        // START PAGES  ===================================================================== -->
        case 'pages':
            if ($_GET['dash'] == 'pages'): // START PAGE ?>
                <div class="container-fiuld mr-3 ml-3">
                        <div class="row">
                            <div class="col-lg-4">
                                <!-- Start Slide Menu -->
                                    <!-- -------------------------------------------------------------------------- -->
                                        <!-- ========================[INCLUDE MENU]=============== -->
                                        <?php include  $source . '/templates/menu.php'; ?>
                                    <!-- ===================================================== -->
                                    <!-- End Slide Menu -->
                                    <!-- -------------------------------------------------------------------------- -->
                                </div>
                                <div class="col-lg-8 mt-5 PagesLists ">
                                    <button id="Add-Page" class="btn btn-primary mt-5 float-right mb-3">اضافة صفحة</button>
                                    <table class="table table-dark mt-5">
                                        <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">الاسم</th>
                                            <th scope="col">عدد الطلاب</th>
                                            <th scope="col">المنشورات</th>
                                            <th scope="col">الاعدادات</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $pages = get_something("pages","*");
                                            foreach ($pages as $page) {
                                             ?>
                                             <?php echo $page['allowed'] == 0 ? '<tr id="elements" class="hide">' : '<tr id="elements" class="show" >' ?>
                                                 <th id="pageid" scope="row"><?php echo $page['pageid']; ?></th>
                                                     <td><?php echo $page['pagename']; ?></td>
                                                 <td>4564</td>
                                                    <td>5642</td>
                                                    <td> <?php echo $page['allowed'] == 1 ? '<button id="ShowElementHide" class="btn btn-primary  mr-2">اخفاء</button>' : '<button id="Showpage" class="btn btn-primary  mr-2">اظهار</button>' ?>
                                                     <button id="ShowElementDelete" class="btn btn-danger ">حذف</button>
                                                    </td>
                                                     </tr>
                                             <?php  }?>
                                        </tbody>
                                    </table>
                                </div>
                        </div>
                        <!-- Modals -->
                        <div id="moadlMenu" class="modal-menu card ">
                            <ul>
                                <li>رؤية الصفحة</li>
                                <li>تعديل الصفحة</li>
                                <li id="logout">تسجيل الخروج</li>
                            </ul>
                        </div>
                        <!-- Modals edit pages -->
                        <div id="overlay-pages" class="overlay-pages">
                            <div class="ActivePages text-center mt-5">
                                <h2 class="py-2 display-4">هل تريد اخفاء هذه الصفحة</h2>
                                <p>اذا اخفيت هذه الصفحة لن تظهر فى <strong>الصفحات</strong></p>
                                <button id="HidePages" class="btn btn-primary">اخفاء</button>
                            </div>
                        </div>
                        <!-- Show Element -->
                        <div id="overlay-pages-show" class="overlay-pages">
                            <div class="ActivePages text-center mt-5">
                                <h2 class="py-2 display-4">هل تريد  اظهار هذه الصفحة</h2>
                                <button id="ShowElement" class="btn btn-primary">اظهار</button>
                            </div>
                        </div>
                        <!-- Delete modal -->
                        <div id="overlay-pages-delete" class="overlay-pages">
                            <div class="ActivePages text-center mt-5">
                                <h2 class="py-2 display-4">هل تريد حذف هذه الصفحة</h2>
                                <p> اذا حذفت هذه الصفحة لن تظهر فى <strong>الصفحات</strong>وسوف يتم مسح جميع بياناتها</p>
                                <button id="DelPages" class="btn btn-primary">حذف</button>
                            </div>
                        </div>
                        <!-- Add page modal -->
                        <div id="overlay-pages-add" class="overlay-pages">
                            <div class="ActivePages  mt-5">
                                <input id="namepage" class="form-control" type="text" placeholder="اسم الصفخة">
                                <input id="userid" type="hidden" value="<?php echo $_SESSION['id']; ?>">
                                <button id="create" class="btn btn-primary">انشاء</button>
                                <div class="alert alert-info">لا يمكنك اضافة اى شئ غير اسم الصفحة وذلك لان الشخص القائم على الصفحة هو الوحيد الذى يستطيع نشر والتعديل الكامل على الصفحة</div>

                            </div>
                        </div>
                    </div>
            <?php endif; // END PAGE
        break;
        // END PAGES  ===================================================================== -->
        // Mail User
        case 'message': ?>
            <div class="container-fiuld mr-3 ml-3 messagesbox">
                            <div class="row">
                                <div class="col-lg-4">
                                    <!-- ========================[INCLUDE MENU]=============== -->
                                    <?php include  $source . '/templates/menu.php'; ?>
                                    <!-- ===================================================== -->
                                </div>
                                <div class="col-lg-8 mt-5">
                                    <table class="table table-sm mt-5 ">
                                        <thead>
                                            <tr class="titles">
                                                <th scope="col"><i class="fas fa-user"></i></th>
                                                <th scope="col">Name</th>
                                                <th scope="col">Email</th>
                                                <th scope="col">Message</th>
                                                <th scope="col">control</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $suportbox = get_something("supportbox","*"); ?>

                                            <?php foreach($suportbox as $boxs): ?>
                                                <?php if(empty($boxs['r_replace'])): ?>
                                             <tr class="infomessage">
                                             <?php $userinfo = information("signup","*","WHERE userid = ".$boxs['userid']."","fetch");   ?>
                                            <th scope="row"><?php echo !empty($userinfo['avatar']) ? '<img class="img-fiuld rounded" src="../u/uploads/avatar/'.$userinfo['avatar'].'" alt="profile" />' : '<img class="img-fiuld rounded" src="./layout/images/icons/011.png" alt="profile" />' ?> </th>
                                            <td><a href="../u/profile.php?user=profilepage&id=<?php echo $boxs['userid']; ?>" class="nav-link"><?php echo $userinfo['username']; ?></a></td>
                                            <td><?php echo $userinfo['email']; ?></td>
                                            <td><?php echo substr($boxs['messages'],0,50); ?>...</td>
                                            <td><a href="dashboard.php?dash=rboxmessage&userid=<?php echo $boxs['userid'] ?>&id=<?php echo $boxs['id']; ?>" class="btn btn-primary"><i class="fas fa-reply"></i></a></td>
                                            </tr>
                                                <?php endif; ?>

                                            <?php endforeach; ?>
                                            <?php if(!empty($boxs['r_replace'])): ?>
                                                <tr>
                                                    <th>
                                                        <td><p style="font-size:14px;color: rgb(75, 110, 134);" class="p-2 mt-2"><i class="fas fa-paper-plane"></i> No Replace Message Now </p></td>
                                                    </th>
                                                </tr>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div id="moadlMenu" class="modal-menu card ">
                                <ul>
                                    <li>رؤية الصفحة</li>
                                    <li>تعديل الصفحة</li>
                                    <li id="logout">تسجيل الخروج</li>
                                </ul>
                            </div>
                    </div>
        <?php break; ?>
        <?php
        // END  Mail User
        // Start Replace On the Message box
        case 'rboxmessage': ?>
            <div class="container-fiuld mr-3 ml-3 messagesbox">
                            <div class="row">
                                <div class="col-lg-4">
                                    <!-- ========================[INCLUDE MENU]=============== -->
                                    <?php include  $source . '/templates/menu.php'; ?>
                                    <!-- ===================================================== -->
                                </div>
                                <div class="col-lg-8 mt-5">
                                    <div class="card rmessage border-0 mt-5 pt-3 pb-1 pl-3" >
                                        <div class="row">

                                            <div class="col-md-6">

                                            <?php $userinfo = information("signup","*","WHERE userid = ".$_GET['userid']."","fetch");   ?>
                                            <?php $box = information("supportbox","*","WHERE userid = ".$_GET['userid']." and id = ".$_GET['id']." ","fetchAll");   ?>
                                                <h1><i class="fas fa-paper-plane"></i> Welcome <?php echo $_SESSION['user'] ?> !</h1>
                                                <p>Send Replace To <?php echo $userinfo['username'] ?></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card crmessage border-0 mt-3 p-3">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="info">
                                                    <?php echo !empty($userinfo['avatar']) ? '<img class="img-fiuld rounded-circle" src="../u/uploads/avatar/'.$userinfo['avatar'].'" alt="profile" />' : '<img class="img-fiuld rounded-circle" src="./layout/images/icons/011.png" alt="profile" />' ?>
                                                    <h4><a class="nav-link" href=""><?php echo $userinfo['username'] ?></a></h4>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <?php foreach($box as $mes): ?><div  class="rmesg mt-3 mb-2 ml-5"><p><?php echo $mes['messages'] ?></p><input type="hidden" id="useridbox" value="<?php echo $mes['userid'] ?>"> </div> <?php endforeach; ?>
                                                <!-- Message update -->
                                                <div id="textmessage">

                                                </div>
                                                <input id="replacemessage" class="form-control" type="text" placeholder="replace">
                                                <input id="idbox" type="hidden" value="<?php echo $_GET['id'] ?>">
                                                <br>
                                                <button id="sendreplace" class="btn btn-primary btn-sm">Send</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="moadlMenu" class="modal-menu card ">
                                <ul>
                                    <li>رؤية الصفحة</li>
                                    <li>تعديل الصفحة</li>
                                    <li id="logout">تسجيل الخروج</li>
                                </ul>
                            </div>
                    </div>
        <?php break;
}
?>
<!-- ===================================================================== -->
<?php
// ----------------------------------------------------------------
// INCLUDE JAVASCRIPT FILES
include $source . '/templates/footer.php';
else : // Refresh to out
    header('location:index.php');
    exit;
endif; // END PAGE
