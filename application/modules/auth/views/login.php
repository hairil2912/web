<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?= (!empty(@$post->title)) ? $post->title : get_site_setting('site_name') ?></title>

    <link rel="stylesheet" href="<?= base_url('assets/pasien/') ?>bower_components/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/pasien/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/pasien/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="<?= base_url('assets/pasien/plugins/alertifyjs/css/alertify.min.css') ?>" />
    <link rel="stylesheet" href="<?= base_url('assets/pasien/plugins/alertifyjs/css/themes/bootstrap.min.css') ?>" />
    <link rel="stylesheet" href="<?= base_url(); ?>assets/pasien/css/style.css">
    <link rel="shortcut icon" href="<?= base_url(); ?>assets/favicon.ico" />
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
</style>

<body>

    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-center auth">
                <div class="row flex-grow">
                    <div class="col-lg-5 mx-auto">
                        <div class="auth-form-light text-left p-5">
                            <div class="brand-logo" style="text-align: center;">
                                <!-- <h4><?= (!empty(@$post->title)) ? $post->title : get_site_setting('site_name') ?></h4><br> -->
                                <img id="profile-img" class="profile-img-card" src="<?= site_url('assets/uploads/' . get_site_setting('site_icon')) ?>" / <br><br><br>
                                <span style="font-size: 26px; color: #27d0b7;" class="logo-lg"><b>LOGIN</span>
                            </div>
                            <p class="text-error"></p>
                            <form action="<?= site_url('auth/login') ?>" class="pt-3" method="POST" id="myform">
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-lg" id="username" name="username" placeholder="Username" autocomplete="off">
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control form-control-lg" id="password" name="password" placeholder="Password">
                                </div>
                                <div class="mt-3">
                                    <button type="submit" class="btn btn-block btn-gradient-success btn-lg font-weight-medium auth-form-btn">LOGIN</button>
                                </div>
                                <div class="my-2 d-flex justify-content-between align-items-center">
                                    <div class="form-check form-check-success">
                                        <label class="form-check-label text-muted">
                                    </div>
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
    <script src="<?= base_url('assets/pasien/plugins/alertifyjs/alertify.min.js') ?>"></script>
    <script src="<?= base_url('assets/pasien/plugins/jquery.blockUI.min.js') ?>"></script>
    <script src="<?= base_url('assets/pasien/plugins/main.js') ?>"></script>
</body>

</html>

<script type="text/javascript">
    document.onreadystatechange = function() {
        if (document.readyState === 'complete') {
            App.authenticate('#myform', false, function(response) {
                if (response.status === true) {
                    window.location.href = response.redirect
                } else {
                    $('.text-error').text(response.message)
                }
            });
        }
    }
</script>