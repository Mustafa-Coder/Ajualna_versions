<?php 
session_start();
if (!isset($_SESSION['user'])) {
    header("location:index.php");
    exit;
}
if(isset($_SESSION['user']) && $_SESSION['admin'] == 1 ): // START PAGE
// ----------------------------------------------------------------
$PAGENAME = "لوحة التحكم";
include './init.php';
include $source . '/templates/navbar.php'; // nativigation bar
if (isset($_GET['dash'])) {
    $dash = $_GET['dash'];
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
                        <h1 class="py-3 title-name">لوحة القيادة</h1>
                        <div class="row mt-4">
                            <div class="col-md-4">
                                <div class="card border-0 studient counter">
                                    <h2 class="name">الطلاب</h2>
                                    <p id="number"><?php echo Counter('signup','username'); ?></p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card border-0 pages counter">
                                    <h2 class="name">الصفحات</h2>
                                    <p><?php echo Counter_All('pages','pagename'); ?></p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card border-0 posts counter">
                                    <h2 class="name">المنشورات</h2>
                                    <p>10,562</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card border-0 male counter">
                                    <h2 class="name">شباب</h2>
                                    <p><?php echo Get_People('signup','Gender','1'); ?></p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card border-0 famale counter">
                                    <h2 class="name">بنات</h2>
                                    <p><?php echo Get_People('signup','Gender','1'); ?></p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card border-0 famale counter">
                                    <h2 class="name">منشور الادارة</h2>
                                    <p><?php echo Counter_All("postpublic","titlename"); ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="row lists mt-5">
                            <div class="col-md-7">
                                <table class="table border-0">
                                        <thead>
                                            <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Cover</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">student</th>
                                            <th scope="col">Posts</th>
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
                                            $pages = get_something('pages','*');
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
                                            <?php }?>
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
    default:
        # code...
        break;
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