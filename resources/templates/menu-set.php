
                    <div class="card menu-settings mt-5 <?php echo $Userinformation['modes'] == 'dark' ? 'bg-bor-col-dark ' :' ' ?> ">
                        <div class="profile-info">
                            <img class="img-fiuld text-center" <?php if(!empty($Userinformation['avatar'])): echo "src='/Ajualna/u/uploads/avatar/".$Userinformation['avatar']."'"; else: echo "src=/Ajualna/layout/images/icons/user.png";endif;?> alt="image user">
                            <h2 class="username"><?php echo $Userinformation['username'] . ' ' . $Userinformation['lastname'] ?></h2>
                        </div>
                        <ul class="pages">
                            <li class="nav-item"><a class="nav-link <?php echo $Userinformation['modes'] == 'dark' ? 'icons-co ' :' ' ?>  " href="#">Edit Details</a></li>
                            <li class="nav-item"><a class="nav-link <?php echo $Userinformation['modes'] == 'dark' ? 'icons-co ' :' ' ?>  " href="/Ajualna/u/profile.php?user=profileavatar&id=<?php echo $_SESSION['id']; ?>">Picture profile</a></li>
                            <li class="nav-item"><a class="nav-link <?php echo $Userinformation['modes'] == 'dark' ? 'icons-co ' :' ' ?>  " href="/Ajualna/u/profile.php?user=DeleteUserall&id=<?php echo $_SESSION['id']; ?>">Delete Profile</a></li>
                            <li class="nav-item"><a class="nav-link <?php echo $Userinformation['modes'] == 'dark' ? 'icons-co ' :' ' ?>  " href="#">Send Box</a></li>
                            <li class="nav-item"><a class="nav-link <?php echo $Userinformation['modes'] == 'dark' ? 'icons-co ' :' ' ?>  " href="/Ajualna/u/profile.php?user=Modeforyou&id=<?php echo $_SESSION['id']; ?>">Themes</a></li>
                        </ul>
                    </div>
                   