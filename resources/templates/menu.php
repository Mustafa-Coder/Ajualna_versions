<section id="nav">
        <nav class="menu-home <?php echo $Userinformation['modes'] == 'dark'  ? "bg-dark" : " " ?> ">
        <!-- if($Userinformation['Gender'] == 'male'):echo "../layout/images/icons/011.png"; else: echo "../layout/images/icons/012.png";endif;?> -->
            <div id="brandhome"  class="brand ml-3 <?php echo $Userinformation['modes'] == 'dark'  ? "text-light" : " " ?>"><?php echo lang("name_site"); ?></div>
            <ul class="menu ">
                <li  class="link"><a href="/Ajualna/home.php"><i class="fas fa-house-damage"></i><?php echo lang("name_home"); ?></a></li>
                <li  class="link"><input class="form-control <?php echo $Userinformation['modes'] == 'dark'  ? "input-user" : " " ?>  search" type="search"  id="search" placeholder="Search.."> <!--<i class="fas fa-question-circle"></i><?php echo lang("Ques"); ?>--></li>
                <li id="ShowNotification" class="link"><i class="fas fa-bell"></i><span class="notification"><?php echo Counter_All("notifications","seen","WHERE seen = 0"); ?></span></li>
                <li  id="ShowMenuPerson" class="link link-img"><img class="img-fiuld text-center" <?php if(!empty($Userinformation['avatar'])): echo "src='/Ajualna/u/uploads/avatar/".$Userinformation['avatar']."'"; else: echo "src=/Ajualna/layout/images/icons/user.png";endif;?> alt="image user"></li>
            </ul>
        </nav>
    </section>
 <!-- Modal Users -->
 <div id="moadlMenu" class="modal-menu card <?php echo $Userinformation['modes'] == 'dark'  ? "bg-bor-col-dark" : " " ?> ">
    <ul>
        <li id="profilepage"><a href="../../Ajualna/u/profile.php?user=profilepage&id=<?php echo $_SESSION['id']; ?>"><i class="fas fa-user-alt icons"></i><?php echo lang("pf"); ?></a> </li>        <?php if($Userinformation['admin'] == 1 ): echo '<li ><a href="/Ajualna/dashboard/dashboard.php?dash=dashboard"><i class="fas fa-tachometer-alt icons"></i>'. lang("dash").'</a></li>'; endif; ?>
        <li ><a href="../../Ajualna/u/profile.php?user=profiledit&id=<?php echo $_SESSION['id']; ?>"><i class="fas fa-cog icons"></i> <?php echo lang("set"); ?></a> </li>
        
          
        <li><i class="fas fa-box-open icons"></i><a href="../../Ajualna/u/profile.php?user=supportbox&id=<?php echo $_SESSION['id']; ?>"><?php echo lang("sup"); ?></a> </li>
        <li id="logout"><i class="fas fa-power-off icons"></i> <?php echo lang("log"); ?></li>
    </ul>
  </div>
<!-- Notification -->
<div id="modalNotif" class="modalNotif card <?php echo $Userinformation['modes'] == 'dark'  ? "bg-bor-col-dark" : " " ?>">
<?php

// Functions data: ;
    $get_notification = get_something("notifications","*","WHERE typenotfi_id = ".$college_session." ORDER BY id DESC ","fetchAll"); // get data users
    $get_notification_id = get_something("notifications","u_id","WHERE u_id = ".$userid."","fetch"); // get data users


?>
          


  </div>
