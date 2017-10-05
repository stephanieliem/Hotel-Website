<nav class="navbar navbar-default navbar-static-top m-b-0">
    <div class="navbar-header">
        <div class="top-left-part">
            <!-- Logo -->
            <a class="logo" href="#">
                <!-- Logo icon image, you can use font-icon also --><b>
                <!--This is dark logo icon-->
             </b>
                <span style="color: black; vertical-align: middle;"><span style="font-family: Tribal Animal; font-size: 150%;">f</span> S2K Hotel</span></a>
        </div>
        <!-- /Logo -->
        <ul class="nav navbar-top-links navbar-right pull-right">
            <!-- <li>
                <form role="search" class="app-search hidden-sm hidden-xs m-r-10">
                    <input type="text" placeholder="Search..." class="form-control"> <a href=""><i class="fa fa-search"></i></a> </form>
            </li> -->
            <li class="dropdown">
                <a class="profile-pic dropdown-toggle" data-toggle="dropdown" href="#"> <img src="../plugins/images/users/users.png" alt="user-img" width="36" class="img-circle"><b class="hidden-xs"><?php echo $_SESSION['nama'];?> </b><span class="caret"></span></a>
                <ul class="dropdown-menu" style="width: 100%; background-color: #2f323e;">
                  <li><a href="logout.php" style="color: white;"><i class="fa fa-sign-out fa-fw" aria-hidden="true"></i>Logout</a></li>   
                </ul>
            </li>
        </ul>
    </div>
    <!-- /.navbar-header -->
    <!-- /.navbar-top-links -->
    <!-- /.navbar-static-side -->
</nav>