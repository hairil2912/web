<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>SIRUSI</title>
  <link rel="stylesheet" href="<?= base_url(); ?>assets/pasiens/vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="<?= base_url(); ?>assets/pasiens/vendors/css/vendor.bundle.base.css">
  <link rel="stylesheet" href="<?= base_url('assets/pasiens/plugins/alertifyjs/css/alertify.min.css') ?>" />
  <link rel="stylesheet" href="<?= base_url('assets/pasiens/plugins/alertifyjs/css/themes/bootstrap.min.css') ?>" />
  <link rel="stylesheet" href="<?= base_url(); ?>assets/pasiens/css/style.css">
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
    border-radius: 9px;
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
          <div class="col-lg-3.5 mx-auto">
            <div class="auth-form-light text-left p-5">
              <div class="brand-logo" style="text-align: center;">
                <span style="font-size: 26px; color: #27d0b7;" class="logo-lg"><b>SIRUSI</b></span>
              </div>
              <p class="text-error"></p>
              <h4 style="text-align:left;">Reset Password</h4>
              <form action="<?= site_url('pendaftaran/login/login') ?>" class="pt-3" method="POST" id="myform">
                <div class="form-group">
                  <input type="text" class="form-control form-control-lg" id="email" name="email" placeholder="Email">
                </div>
                <div class="mt-3">
                  <button type="submit" class="btn btn-block btn-gradient-success btn-lg font-weight-medium auth-form-btn">RESET PASSWORD</button>
                </div>
                <div class="text-center mt-4 font-weight-light"><a href="<?= site_url('pendaftaran/login'); ?>" class="text-success">Kembali Kehalaman Login</a>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="<?= base_url('assets/pasiens/plugins/jquery/dist/jquery.min.js') ?>"></script>
  <script src="<?= base_url('assets/pasiens/plugins/bootstrap/dist/js/bootstrap.min.js') ?>"></script>
  <script src="<?= base_url('assets/pasiens/plugins/alertifyjs/alertify.min.js') ?>"></script>
  <script src="<?= base_url('assets/pasiens/plugins/jquery.blockUI.min.js') ?>"></script>
  <script src="<?= base_url('assets/pasiens/plugins/js.cookie.min.js') ?>"></script>
  <script src="<?= base_url('assets/pasiens/plugins/main.js') ?>"></script>
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