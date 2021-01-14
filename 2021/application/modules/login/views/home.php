<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= SITE_NAME; ?></title>
    <link rel="icon" type="image/png" href="<?= LOGO; ?>" />
    <!-- Bootstrap core CSS     -->
    <link href="<?= base_url("assets/css/bootstrap.min.css"); ?>" rel="stylesheet" />
    <!--  Material Dashboard CSS    -->
    <link href="<?= base_url("assets/css/material-dashboard.css"); ?>" rel="stylesheet" />
    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="<?= base_url("assets/css/demo.css"); ?>" rel="stylesheet" />
    <!--     Fonts and icons     -->
    <link href="<?= base_url("assets/css/font-awesome.css"); ?>" rel="stylesheet" />
    <link href="<?= base_url("assets/css/google-roboto-300-700.css"); ?>" rel="stylesheet" />
</head>

<body>

    <div class="wrapper wrapper-full-page">
        <div class="full-page login-page" filter-color="black" data-image="assets/img/login.jpg">
            <!--   you can change the color of the filter page using: data-color="blue | purple | green | orange | red | rose " -->
            <div class="content">
                <div class="container">
                    <div class="row">
                        <div class="col-md-4 col-sm-6 col-md-offset-4 col-sm-offset-3">
                            <form method="post" action="<?= base_url("login/auth"); ?>">
                                <div class="card card-login card-hidden">
                                    <div class="card-header text-center" data-background-color="info">
                                        <img src="<?= LOGO; ?>" alt="" style="width: 100px;">
                                    </div>
                                    <div class="card-content">
                                        <h4 class="text-center">Sistem Keuangan Cepat</h4>
                                        <h4 class="text-center">Tahun 2021</h4>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">face</i>
                                            </span>
                                            <div class="form-group label-floating">
                                                <label class="control-label">Nama Akun</label>
                                                <input type="text" id="nama" name="nama" class="form-control">
                                            </div>
                                        </div>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">lock_outline</i>
                                            </span>
                                            <div class="form-group label-floating">
                                                <label class="control-label">Kata Sandi</label>
                                                <input type="password" name="sandi" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="footer text-center">
                                        <button type="submit" class="btn btn-info btn-wd btn-lg">Masuk</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <footer class="footer">
                <div class="container">
                    <p class="copyright pull-right">
                        &copy; 2021
                        <script>
                            // document.write(new Date().getFullYear())
                        </script>
                        <a href="http://sikdkkjepara.net">Dinas Kesehatan Kabupaten Jepara</a>
                    </p>
                </div>
            </footer>
        </div>
    </div>

    <!--   Core JS Files   -->
    <script src="<?= base_url("assets/js/jquery-3.1.1.min.js"); ?>" type="text/javascript"></script>
    <script src="<?= base_url("assets/js/jquery-ui.min.js"); ?>" type="text/javascript"></script>
    <script src="<?= base_url("assets/js/bootstrap.min.js"); ?>" type="text/javascript"></script>
    <script src="<?= base_url("assets/js/material.min.js"); ?>" type="text/javascript"></script>
    <script src="<?= base_url("assets/js/perfect-scrollbar.jquery.min.js"); ?>" type="text/javascript"></script>
    <!-- Forms Validations Plugin -->
    <script src="<?= base_url("assets/js/jquery.validate.min.js"); ?>"></script>
    <!--  Plugin for Date Time Picker and Full Calendar Plugin-->
    <script src="<?= base_url("assets/js/moment.min.js"); ?>"></script>
    <!--  Charts Plugin -->
    <script src="<?= base_url("assets/js/chartist.min.js"); ?>"></script>
    <!--  Plugin for the Wizard -->
    <script src="<?= base_url("assets/js/jquery.bootstrap-wizard.js"); ?>"></script>
    <!--  Notifications Plugin    -->
    <script src="<?= base_url("assets/js/bootstrap-notify.js"); ?>"></script>
    <!--   Sharrre Library    -->
    <script src="<?= base_url("assets/js/jquery.sharrre.js"); ?>"></script>
    <!-- DateTimePicker Plugin -->
    <script src="<?= base_url("assets/js/bootstrap-datetimepicker.js"); ?>"></script>
    <!-- Vector Map plugin -->
    <script src="<?= base_url("assets/js/jquery-jvectormap.js"); ?>"></script>
    <!-- Sliders Plugin -->
    <script src="<?= base_url("assets/js/nouislider.min.js"); ?>"></script>
    <!--  Google Maps Plugin    -->
    <!--<script src="https://maps.googleapis.com/maps/api/js"></script>-->
    <!-- Select Plugin -->
    <script src="<?= base_url("assets/js/jquery.select-bootstrap.js"); ?>"></script>
    <!--  DataTables.net Plugin    -->
    <script src="<?= base_url("assets/js/jquery.datatables.js"); ?>"></script>
    <!-- Sweet Alert 2 plugin -->
    <script src="<?= base_url("assets/js/sweetalert2.js"); ?>"></script>
    <!--	Plugin for Fileupload, full documentation here: http://www.jasny.net/bootstrap/javascript/#fileinput -->
    <script src="<?= base_url("assets/js/jasny-bootstrap.min.js"); ?>"></script>
    <!--  Full Calendar Plugin    -->
    <script src="<?= base_url("assets/js/fullcalendar.min.js"); ?>"></script>
    <!-- TagsInput Plugin -->
    <script src="<?= base_url("assets/js/jquery.tagsinput.js"); ?>"></script>
    <!-- Material Dashboard javascript methods -->
    <script src="<?= base_url("assets/js/material-dashboard.js"); ?>"></script>
    <!-- Material Dashboard DEMO methods, don't include it in your project! -->
    <script src="<?= base_url("assets/js/demo.js"); ?>"></script>
    <script type="text/javascript">
        $().ready(function() {
            demo.checkFullPageBackgroundImage();

            setTimeout(function() {
                // after 1000 ms we add the class animated to the login/register card
                $('.card').removeClass('card-hidden');
            }, 700)
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            $("#nama").autocomplete({
                source: "<?php echo site_url('../login/get_autocomplete/?'); ?>"
            });
        });
    </script>

</body>

</html>