<!DOCTYPE html>
<html lang="en">

<head>
    <?php $this->load->view('template2/_partial/head.php'); ?>
</head>

<body>
    <div class="wrapper">

        <?php $this->load->view('template2/_partial/navbar.php'); ?>

        <div class="main-panel">
            <nav class="navbar navbar-transparent navbar-absolute">
                <div class="container-fluid">
                    <div class="navbar-minimize">
                        <button id="minimizeSidebar" class="btn btn-round btn-white btn-fill btn-just-icon">
                            <i class="material-icons visible-on-sidebar-regular">more_vert</i>
                            <i class="material-icons visible-on-sidebar-mini">view_list</i>
                        </button>
                    </div>
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="#">
                            <?php

                            if ($this->uri->segment(1)) {
                                $judul = explode('_', $this->uri->segment(1));
                                if (isset($judul[1])) {
                                    $judul2 = $judul[1];
                                } else {
                                    $judul2 = '';
                                }
                                // echo " - ". ucfirst($judul[0].' '). ucfirst($judul2);
                                echo ucfirst($judul[0] . ' ') . ucfirst($judul2);
                            } else {
                                echo "Dashboard";
                            }
                            ?>
                        </a>
                    </div>
                    <div class="collapse navbar-collapse">
                        <ul class="nav navbar-nav navbar-right">

                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="material-icons">notifications</i>
                                    <span class="notification">1</span>
                                    <p class="hidden-lg hidden-md">
                                        Pemberitahuan
                                        <b class="caret"></b>
                                    </p>
                                </a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="#">Mike John responded to your email</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="separator hidden-lg hidden-md"></li>
                        </ul>
                    </div>
                </div>
            </nav>
            <div class="content">
                <div class="container-fluid">
                    <?php echo $content; ?>
                </div>
            </div>

            <?php $this->load->view('template2/_partial/footer.php'); ?>
        </div>

    </div>
    <!-- ./wrapper -->

    <?php $this->load->view('template2/_partial/js.php'); ?>
</body>

</html>