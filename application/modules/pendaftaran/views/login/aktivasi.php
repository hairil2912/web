<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>AKTIVASI</title>
    <link rel="stylesheet" href="<?= base_url(); ?>assets/pasien/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/pasien/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="<?= base_url('assets/pasien/') ?>bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/pasien/plugins/alertifyjs/css/alertify.min.css') ?>" />
    <link rel="stylesheet" href="<?= base_url('assets/pasien/plugins/alertifyjs/css/themes/bootstrap.min.css') ?>" />
    <link rel="stylesheet" href="<?= base_url(); ?>assets/pasien/css/style.css">
    <link rel="shortcut icon" href="<?= base_url(); ?>assets/favicon.ico" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

    <script>
        var site_url = '<?= site_url() ?>';
        var tokenName = '<?= $this->security->get_csrf_token_name() ?>';
        var segment1 = '<?= $this->uri->segment(1) ?>';
        var segment2 = '<?= $this->uri->segment(2) ?>';
        var segment3 = '<?= $this->uri->segment(3) ?>';
        var segment4 = '<?= $this->uri->segment(4) ?>';
    </script>
</head>
<style>
    .auth-form-light.text-left.p-5 {
        border-radius: 51px;
        box-shadow: 0 0 6px 0 rgba(0, 0, 0, .12) !important;
    }

    p.text-error {
        color: red;
    }

    .content-wrapper {
        background: #e6e6e6;
    }

    #example1 {
        background: url(<?= base_url('assets/register_new.png'); ?>);
        background-repeat: no-repeat;
        background-size: contain !important;
        height: 586px !important;
        padding-top: 16px !important;
        margin-top: 16px !important;
    }
</style>

<body>

    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-center auth">
                <div class="row flex-grow">
                    <div class="col-lg-5 mx-auto">
                        <div class="auth-form-light text-left p-5">
                            <div class="brand-logo" style="text-align: center;">
                            <?php if ($this->url == 'http://103.141.148.136/') : ?>
                                <span style="font-size: 26px; color: #27d0b7;" class="logo-lg"><b>SIMPEL </b>AJA</span>
                            <?php else : ?>
                                <span style="font-size: 26px; color: #27d0b7;" class="logo-lg"><b>KLIK </b>PASIEN</span>
                            <?php endif; ?>
                            <br>
                            </div>
                            <p class="text-error"></p>
                            <h4 style="text-align:center;">Aktivasi Akun</h4>
                            <h5 style="text-align:left;">INFO !</h5>
                            <h6 style="text-align:left;">Mohon isi data dibawah ini dengan benar untuk proses aktivasi akun.</h6>
                            <form action="<?= site_url('pendaftaran/login/aktivasi') ?>" class="pt-3" method="POST" id="myform">
                                <div class="form-group">
                                    <label for="">NIK / No.Kartu Berobat</label>
                                    <input type="text" class="form-control form-control-lg" id="id" name="id" placeholder="NIK / No.Kartu Berobat" autocomplete="off">
                                </div>
                                <div class="form-group">
                                    <label for="">Nama Lengkap</label>
                                    <input type="text" class="form-control form-control-lg" id="nama" name="nama" placeholder="Nama Lengkap">
                                </div>
                                <div class="form-group">
                                    <label for="">Tanggal Lahir</label>
                                    <input type="text" class="form-control form-control-lg" id="tgl_lhr" name="tgl_lhr" placeholder="tanggal lahir (20/05/1996)">
                                </div>
                                <div class="form-group">
                                    <label for="">Password</label>
                                    <input type="password" class="form-control form-control-lg" id="password" name="password" placeholder="Password">
                                </div>
                                <div class="mt-3">
                                    <button type="submit" class="btn btn-block btn-gradient-success btn-lg font-weight-medium auth-form-btn">AKTIVASI AKUN</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="<?= base_url('assets/pasien/plugins/jquery/dist/jquery.min.js') ?>"></script>
    <script src="<?= base_url('assets/pasien/plugins/bootstrap/dist/js/bootstrap.min.js') ?>"></script>
    <script src="<?= base_url('assets/pasien/') ?>bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
    <script src="<?= base_url('assets/pasien/plugins/alertifyjs/alertify.min.js') ?>"></script>
    <script src="<?= base_url('assets/pasien/plugins/jquery.blockUI.min.js') ?>"></script>
    <script src="<?= base_url('assets/pasien/plugins/js.cookie.min.js') ?>"></script>
    <script src="<?= base_url('assets/pasien/plugins/main.js') ?>"></script>
</body>

</html>

<script>
    document.onreadystatechange = () => {
        if (document.readyState === "complete") {
            var App = new Main;

            App.authenticate('#myform', false, function(response) {
                if (response.status === true) {
                    window.location.href = response.redirect
                } else {
                    App.notify(response.message, 0);
                }
            });
            
            $("#tgl_lhr").datepicker({
                format: 'dd/mm/yyyy',
                autoclose: true
            });
        }
    }
</script>