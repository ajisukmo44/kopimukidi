<header id="header" class="header">
    <div class="top-left">
        <div class="navbar-header">
            <a class="navbar-brand" href="home.php"><img src="images/logo1.png" alt="Logo"></a>
            <a class="navbar-brand hidden" href="home.php"><img src="images/logo1.png" alt="Logo"></a>
            <a id="menuToggle" class="menutoggle"><i class="fa fa-bars"></i></a>
        </div>
    </div>
    <div class="top-right">
        <div class="header-menu">
            <div class="user-area dropdown float-right">

                <a href="#" class="dropdown-toggle active" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <div class="user mr-2"> <?= $sesen_nama; ?></div> <img class="user-avatar rounded-circle" src="<?php
                                                                                                                    if ($sesen_jabatan == 'Pemilik') {
                                                                                                                        echo "images/avatar/pemilik.png";
                                                                                                                    } else {
                                                                                                                        echo "images/avatar/1.png";
                                                                                                                    }
                                                                                                                    ?>" alt="User Avatar">
                </a>
                <div class="user-menu dropdown-menu">
                    <a class="nav-link" href="editpassword.php"><i class="fa fa-power -off"></i>Ubah Password</a>
                    <a class="nav-link" href="logout.php"><i class="fa fa-power -off"></i>Logout</a>
                </div>
            </div>

        </div>
    </div>
</header>