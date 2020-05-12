<section id="nav">
        <nav class="menu-home">
        <!-- if($Userinformation['Gender'] == 'male'):echo "../layout/images/icons/011.png"; else: echo "../layout/images/icons/012.png";endif;?> -->
            <div id="brandhome"  class="brand ml-3"><?php echo lang("name_site"); ?></div>
            <ul class="menu ">
                <li  class="link"><i class="fas fa-house-damage"></i><?php echo lang("name_home"); ?></li>
                <li  class="link"><i class="fas fa-question-circle"></i><?php echo lang("Ques"); ?></li>
                <li id="ShowNotification" class="link"><i class="fas fa-bell"></i><span id="notification"></span></li>
                <li  id="ShowMenuPerson" class="link link-img"><img class="img-fiuld text-center" <?php if(!empty($Userinformation['avatar'])): echo "src='/Ajualna/u/uploads/avatar/".$Userinformation['avatar']."'"; else: echo "src=/Ajualna/layout/images/icons/user.png";endif;?> alt="image user"></li>
            </ul>
        </nav>
    </section>
 <!-- Modal Users -->
 <div id="moadlMenu" class="modal-menu card ">
    <ul>
        <li id="profilepage"><a href="../../Ajualna/u/profile.php?user=profilepage&id=<?php echo $_SESSION['id']; ?>"><i class="fas fa-user-alt"></i><?php echo lang("pf"); ?></a> </li>        <?php if($_SESSION['admin'] == 1 ): echo '<li id="dash"><i class="fas fa-tachometer-alt"></i>'. lang("dash").'</li>'; endif; ?>
        <li ><a href="../../Ajualna/u/profile.php?user=profiledit&id=<?php echo $_SESSION['id']; ?>"><i class="fas fa-cog"></i> <?php echo lang("set"); ?></a> </li>
        <li id="logout"><i class="fas fa-power-off"></i> <?php echo lang("log"); ?></li>
    </ul>
  </div>
<!-- Notification -->
<div id="modalNotif" class="modalNotif card">
<?php 

// Functions data: ;
    $get_notification = get_something("notifications","*","WHERE pagesname = ".$college_session." AND seen = 1 ORDER BY id DESC ","fetchAll"); // get data users
    $get_notification_id = get_something("notifications","u_id","WHERE u_id = ".$userid."","fetch"); // get data users


?>  
            <h1 class="notif">Notification</h1>

        <!-- <?php if($get_notification_id??['u_id'] == $_SESSION['id']): ?> -->

       <?php  foreach ($get_notification as $value) { ?>

            
            
            
            <?php
                $select = "SELECT *  FROM signup WHERE userid = :userid ";
                $notif = $con->prepare($select);
                $notif->bindparam(":userid",$value['u_id']);
                $notif->execute();
                $rowdata = $notif->fetch();
            ?>
        <div class="info">
            
            <div class="avatar">
            <img src="./u/uplaods/avatar/<?php echo $rowdata['avatar']; ?>" alt="">
            </div>
            <div class="user">
                <h2 class="username"> <?php echo $rowdata['username'] . " " .  $rowdata['lastname']  ?> > <a href="#"><?php echo $pagesforyou["pagename"] ?></a></h2>
                <p class="time"><i class="fas fa-clock"></i><?php echo $value['times'] ?></p>
                <p class="desc">
                <?php  echo  substr($value['title'],0,65) . "..." ?>
                </p>
            </div>
        </div>
            
        <?php  }  ?>
                    
       <!-- <?php endif; ?> -->
       
  </div>    