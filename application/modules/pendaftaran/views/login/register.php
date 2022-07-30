<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="colorlib.com">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PENDAFTARAN</title>
    <link rel="stylesheet" href="<?= base_url() ?>assets/form_wizard/fonts/themify-icons/themify-icons.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/form_wizard/css/style.css">
    <link rel="stylesheet" href="<?= base_url('assets/pasien/plugins/alertifyjs/css/alertify.min.css') ?>" />
    <link rel="stylesheet" href="<?= base_url('assets/pasien/') ?>bower_components/select2/dist/css/select2.min.css">
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

<body>
    <style>
        body {
            background: #e6e6e6 !important;
        }

        h2 {
            color: #27d0b7 !important;
        }

        .container {
            width: 1069px;
            border-radius: 51px;
        }

        .current .title {
            background: #27d0b7 !important;
            width: 200px !important;
        }

        .actions ul li a {
            background: #27d0b7 !important;
        }

        span.title {
            width: 200px !important;

        }

        label.error {
            display: block;
            position: inherit !important;
            top: 0px;
            right: 0;
            color: red;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            color: #444;
            line-height: 55px;
            width: 423px;
        }

        .select2-container .select2-selection--single {
            height: 55px !important;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            top: 15px !important;
        }

        .steps {
            margin-bottom: 23px;
            margin-left: 234px;
            margin-right: 234px;
        }
    </style>
    <div class="main">
        <div class="container">
            <h2>PENDAFTARAN PASIEN BARU</h2>
            <form class="signup-form" method="POST" id="signup-form">
                <h3>
                    <span class="icon"><i class="ti-email"></i></span>
                    <span class="title_text">Email & Password</span>
                </h3>
                <fieldset>
                    <legend>
                        <span class="step-number">Step 1 / 2</span>
                    </legend>
                    <div class="form-group">
                        <label for="" class="form-label required"> Email/Nik</label>
                        <input id="email" name="email" type="text" placeholder="Email/Nik" autocomplete="off" class="required">
                    </div>
                    <div class="form-group">
                        <label for="" class="form-label required">Password</label>
                        <input id="password" name="password" type="password" class="required" placeholder="Password">
                    </div>
                    <div class="form-group">
                        <label for="" class="form-label required">Ketik Ulang Password</label>
                        <input id="confirm-2" name="confirm" type="password" class="required" placeholder="Ketik Ulang Password">
                    </div>
                </fieldset>
                <h3>
                    <span class="icon"><i class="ti-user"></i></span>
                    <span class="title_text">Biodata</span>
                </h3>
                <fieldset>
                    <legend>
                        <span class="step-number">Step 2 / 2</span>
                    </legend>
                    <div class="form-group">
                        <label for="" class="form-label required">Nama Lengkap</label>
                        <input type="text" name="nama" id="nama" class="required" placeholder="Nama Lengkap" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="" class="form-label required">Nik</label>
                        <input type="number" name="nik" id="nik" class="required" placeholder="Nik">
                    </div>
                    <div class="form-group">
                        <label for="" class="form-label required">Jenis Kelamin</label>
                        <select name="jenis_kelamin" id="jenis_kelamin" class="required">
                            <option value="">Piih Jenis Kelamin</option>
                            <option value="1">Laki-laki</option>
                            <option value="2">Perempuan</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="" class="form-label required">Tempat Lahir</label>
                        <input type="text" name="tempat_lahir" id="tempat_lahir" class="required" placeholder="Tempat Lahir" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="" class="form-label required">Tgl Lahir</label>
                        <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="required">
                    </div>
                    <div class="form-group">
                        <label for="" class="form-label required">Agama</label>
                        <select name="agama" id="agama" class="required">
                            <option value="">Piih Agama</option>
                            <option value=" 1">Islam</option>
                            <option value="2">Protestan</option>
                            <option value="3">Khatolik</option>
                            <option value="4">Hindu</option>
                            <option value="5">Budha</option>
                            <option value="6">Lainnya</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="" class="form-label required">Status Kawin</label>
                        <select name="status_kawin" id="status_kawin" class="required">
                            <option value="">Piih Status Kawin</option>
                            <option value=" 1">Kawin</option>
                            <option value="2">Belum Kawin</option>
                            <option value="3">Janda</option>
                            <option value="4">Duda</option>
                        </select>
                    </div>
                    <div class=" form-group">
                        <label for="" class="form-label required">Alamat Lengkap</label>
                        <input type="text" name="alamat" id="alamat" class="required" placeholder="Alamat Lengkap" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="" class="form-label required">Provinsi</label>
                        <select name="id_provinsi" id="id_provinsi" class="required">
                            <option value="">Pilih Provinsi</option>
                            <?php foreach ($provinsi as $p) : ?>
                                <option value="<?= $p->id_prov ?>"><?= $p->nama_provinsi ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="" class="form-label required">Kabupaten</label>
                        <select name="id_kab" id="id_kab" class="required">
                            <option value="">Pilih Kabupaten</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="" class="form-label required">Kecamatan</label>
                        <select name="id_kec" id="id_kec" class="required">
                            <option value="">Pilih Kecamatan</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="" class="form-label required">Desa</label>
                        <select name="id_desa" id="id_desa" class="required">
                            <option value="">Pilih Desa</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="" class="form-label required">No Hp</label>
                        <input type="number" name="no_hp" id="no_hp" class="required" placeholder="Nomor Hp/Telpon" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="" class="form-label required">Asuransi</label>
                        <select name="id_asuransi" id="id_asuransi">
                            <option value="">Pilih Asuransi</option>
                            <?php foreach ($asuransi as $a) : ?>
                                <option value="<?= $a->id_asuransi ?>"><?= $a->nama_asuransi ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="" class="form-label required">No Asuransi</label>
                        <input type="text" name="no_asuransi" id="no_asuransi" class="required" placeholder="No Asuransi" autocomplete="off">
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
    <script src="<?= base_url() ?>assets/pasien/bower_components/jquery/dist/jquery.min.js"></script>
    <script src="<?= base_url() ?>assets/pasien/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="<?= base_url() ?>assets/pasien/bower_components/select2/dist/js/select2.full.js"></script>
    <script src="<?= base_url() ?>assets/form_wizard/vendor/jquery-validation/dist/jquery.validate.min.js"></script>
    <script src="<?= base_url() ?>assets/form_wizard/vendor/jquery-validation/dist/additional-methods.min.js"></script>
    <script src="<?= base_url() ?>assets/form_wizard/vendor/jquery-steps/jquery.steps.min.js"></script>
    <script src="<?= base_url() ?>assets/pasien/plugins/alertifyjs/alertify.min.js"></script>
    <script src="<?= base_url() ?>assets/pasien/plugins/jquery.blockUI.min.js"></script>
    <script src="<?= base_url() ?>assets/pasien/plugins/js.cookie.min.js"></script>
    <script src="<?= base_url() ?>assets/main.js"></script>
</body>

</html>

<script>
    document.onreadystatechange = () => {
        if (document.readyState === "complete") {
            var App = new Main;
            $(document).ready(function() {
                var form = $("#signup-form");
                form.steps({
                    headerTag: "h3",
                    bodyTag: "fieldset",
                    transitionEffect: "fade",
                    labels: {
                        previous: 'SEBELUMNYA',
                        next: 'SELANJUTNYA',
                        finish: 'REGISTER',
                        current: ''
                    },
                    titleTemplate: '<span class="title">#title#</span>',
                    onStepChanging: function(event, currentIndex, newIndex) {
                        if (currentIndex > newIndex) {
                            return true;
                        }

                        if (currentIndex < newIndex) {
                            form.find(".body:eq(" + newIndex + ") label.error").remove();
                            form.find(".body:eq(" + newIndex + ") .error").removeClass("error");
                        }
                        form.validate().settings.ignore = ":disabled,:hidden";
                        return form.valid();
                    },
                    onStepChanged: function(event, currentIndex, priorIndex) {

                        if (currentIndex === 2 && priorIndex === 3) {
                            form.steps("previous");
                        }
                    },
                    onFinishing: function(event, currentIndex) {
                        form.validate().settings.ignore = ":disabled";
                        return form.valid();
                    },
                    onFinished: function(e) {
                        e.preventDefault();
                        var data = {
                            email: $('#email').val(),
                            nama: $('#nama').val(),
                            tempat_lahir: $('#tempat_lahir').val(),
                            tanggal_lahir: $('#tanggal_lahir').val(),
                            jenis_kelamin: $('#jenis_kelamin').val(),
                            status_kawin: $('#status_kawin').val(),
                            agama: $('#agama').val(),
                            desa: $('#desa').val(),
                            alamat: $('#alamat').val(),
                            password: $('#password').val(),
                            no_hp: $('#no_hp').val(),
                            email: $('#email').val(),
                            nik: $('#nik').val(),
                            id_asuransi: $('#id_asuransi').val(),
                            no_asuransi: $('#no_asuransi').val(),
                        }

                        $.ajax({
                            url: site_url + 'pendaftaran/login/register_akun',
                            type: "POST",
                            data: data,
                            dataType: 'json',
                            success: function(response) {
                                if (response.status === true) {
                                    window.location.href = response.redirect
                                } else {
                                    App.notify(response.message, 0);
                                }
                            }
                        });
                    }
                }).validate({
                    errorPlacement: function errorPlacement(error, element) {
                        element.before(error);
                    },
                    rules: {
                        confirm: {
                            equalTo: "#password"
                        }
                    }
                });
            });

            $(document).on('change', '#id_provinsi', function() {
                var id_provinsi = $(this).val();
                $.get('<?= site_url('pendaftaran/login/get_kabupaten/') ?>' + id_provinsi, function(response) {
                    $('#id_kab').html(response)
                });
            });

            $(document).on('change', '#id_kab', function() {
                var id_kab = $(this).val();
                $.get('<?= site_url('pendaftaran/login/get_kecamatan/') ?>' + id_kab, function(response) {
                    $('#id_kec').html(response)
                });
            });

            $(document).on('change', '#id_kec', function() {
                var id_kec = $(this).val();
                $.get('<?= site_url('pendaftaran/login/get_desa/') ?>' + id_kec, function(response) {
                    $('#id_desa').html(response)
                });
            });
        }
    }
</script>