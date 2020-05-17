<!-- Navbar Menu -->
    <!-- -------------------------------------------------------------------------- -->
    <section id="nav">
        <nav class="navbar">
            <ul class="menu ">
                <li  class="link"><i class="fas fa-bell"></i></li>
                <?php $info = information("signup","avatar","WHERE userid = ".$_SESSION['id']." " ,"fetch") ?>
                <li  id="ShowMenuPerson" class="link link-img"><img  class="img-fiuld" <?php echo empty($info['avatar'])  ? 'src="./layout/images/icons/011.png"': 'src="/Ajualna/u/uploads/avatar/'.$info['avatar'].'"' ?> alt="avatar user"></li>
            </ul>
        </nav>
    </section>
    <!-- -------------------------------------------------------------------------- -->
    <!-- End Navbar Menu -->