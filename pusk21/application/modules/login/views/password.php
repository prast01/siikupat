<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>
        <?php
        // echo strtoupper(SITE_NAME);
        if ($this->uri->segment(1)) {
            $judul = explode('-', $this->uri->segment(1));
            if (isset($judul[1])) {
                $judul2 = $judul[1];
            } else {
                $judul2 = '';
            }
            // echo " - ". ucfirst($judul[0].' '). ucfirst($judul2);
            echo ucfirst($judul[0] . ' ') . ucfirst($judul2);
        }
        ?>
    </title>
    <link rel="shortcut icon" href="<?php echo LOGO; ?>" type="image/x-icon">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo base_url('plugins/fontawesome-free/css/all.min.css'); ?>">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="<?php echo base_url('plugins/icheck-bootstrap/icheck-bootstrap.min.css'); ?>">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url('dist/css/adminlte.min.css'); ?>">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <!-- jQuery-UI -->
    <link rel="stylesheet" href="<?php echo base_url('plugins/jquery-ui/jquery-ui.css'); ?>">

    <style>
        .login-page {
            background: url("assets/img/login.jpg") no-repeat center fixed;
            background-size: cover;
        }
    </style>
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <img src="<?php echo LOGO; ?>" alt="" width="100px"> <br>
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Ubah Sandi</p>

                <?php if ($this->session->flashdata('gagal')) : ?>
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h5><i class="icon fas fa-ban"></i> Opss!</h5>
                        <?php echo $this->session->flashdata('gagal'); ?>
                    </div>
                <?php endif; ?>

                <form method="post" action="<?php echo site_url('../login/ubah/' . $kode_pusk) ?>">
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" name="sandi" placeholder="Kata Sandi Baru">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" name="sandi2" placeholder="Ulangi Kata Sandi Baru">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- /.col -->
                        <div class="col-6">
                            <a href="<?php echo site_url('../logout') ?>" class="btn btn-block btn-flat btn-danger" onclick="return confirm('Yakin keluar?')">
                                Keluar
                            </a>
                        </div>
                        <div class="col-6">
                            <button type="submit" class="btn btn-primary btn-block btn-flat">Simpan</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
            </div>
            <!-- /.login-card-body -->
            <div class="card-footer text-center">
                &copy; 2021
                <script>
                    // document.write(new Date().getFullYear())
                </script>
                <a href="http://sikdkkjepara.net">Dinas Kesehatan Kabupaten Jepara</a>
            </div>
        </div>
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="<?php echo base_url('plugins/jquery/jquery.min.js'); ?>"></script>
    <!-- Bootstrap 4 -->
    <script src="<?php echo base_url('plugins/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>
    <!-- jQuery-UI -->
    <script src="<?php echo base_url('plugins/jquery-ui/jquery-ui.js'); ?>"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo base_url('dist/js/adminlte.min.js'); ?>"></script>

</body>

</html>