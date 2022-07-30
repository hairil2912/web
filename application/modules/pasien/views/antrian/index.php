<style>
    .form-group {
        margin-bottom: 8px;
    }

    span.select2.select2-container {
        width: 100% !important
    }

    .show {
        display: block;
    }

    .hide {
        display: none;
    }

    input#total {
        text-align: center;
        background-color: #ffffff00;
        border: #ffffff00;
        font-size: 30px;
        color: #3c763d;
    }

    input#menunggu {
        text-align: center;
        background-color: #ffffff00;
        border: #ffffff00;
        font-size: 30px;
        color: #3c763d;
    }

    input#dipanggil {
        text-align: center;
        background-color: #ffffff00;
        border: #ffffff00;
        font-size: 30px;
        color: #3c763d;
    }

    input#no_tiket {
        text-align: center;
        background-color: #ffffff00;
        border: #ffffff00;
        font-size: 30px;
        color: #3c763d;
    }

    input#no_urut {
        text-align: center;
        background-color: #ffffff00;
        border: #ffffff00;
        font-size: 30px;
        color: #3c763d;
    }

    input#estimasiDipanggilJam {
        text-align: center;
        background-color: #ffffff00;
        border: #ffffff00;
        font-size: 30px;
    }

    .box.data-pasien {
        height: 600px;
    }

    .text-success {
        color: #3c763d;
        font-size: 30px;
    }
</style>
<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-danger">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-users"></i> Antrian</h3>
                    </div>
                    <div class="box-body" style="height:650px;">
                        <div class="">
                            <ul class="nav nav-tabs">
                                <?php if ($config->is_rumkit  == 0) : ?>
                                    <li role="presentation" class="active">
                                        <a href="#dokter" data-toggle="tab" aria-controls="dokter" href="#"><i class="fa fa-users"></i> Dokter</a>
                                    </li>
                                <?php else : ?>
                                    <li role="presentation" class="active">
                                        <a href="#poli" data-toggle="tab" aria-controls="poli" href="#"><i class="fa fa-users"></i> Poliklinik</a>
                                    </li>
                                <?php endif; ?>
                                <li role="presentation">
                                    <a href="#apotik" data-toggle="tab" aria-controls="apotik" href="#"><i class="fa fa-users"></i> Apotik</a>
                                </li>
                            </ul>
                            <div class="tab-content no-padding">
                                <?php if ($config->is_rumkit == 0) : ?>
                                    <div class="tab-pane active" role="tabpanel" id="dokter">
                                        <div class="box-body">
                                            <br>
                                            <div class="alert alert-success alert-dismissible" role="alert">
                                                <button style="color: #fff; opacity: 1;" type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                <h4 style="margin-top: 0px;"><i class="fa fa-th"></i> Informasi Antrian Dokter</h4>
                                                <p>Silahkan Pilih Dokter dibawah untuk melihat antrian </p>
                                            </div>
                                            <form class="forms-sample" action="<?= site_url(''); ?>">
                                                <div class="col-sm-12" style="margin-bottom:80px">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="">Dokter</label>
                                                            <select name="id_dokter" id="id_dokter" name="id_dokter" class="form-control">
                                                                <?php foreach ($dokter as $d) : ?>
                                                                    <option value=""></option>
                                                                    <option value="<?= $d->id_user ?>"><?= $d->nama_dokter ?> || <?= $d->nama_prodi ?></option>
                                                                <?php endforeach; ?>
                                                            </select>
                                                            <!-- <select class="form-control" id="id_ruangan" name="id_ruangan">
                                                                <?php foreach ($poli as $a) : ?>
                                                                    <option value=""></option>
                                                                    <option <?= $a->id_ruangan ?> value="<?= $a->id_ruangan ?>"><?= $a->nama_ruangan ?></option>
                                                                <?php endforeach; ?>
                                                            </select> -->
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="">Tanggal</label>
                                                            <input type="text" autocomplete="off" class="form-control" placeholder="Tanggal" name="tgl_berobat" id="tgl_berobat" value="">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <button type="submit" id="cari_antiran" class="btn btn-success btn-sm">Lihat Antrian</button>
                                                    </div>
                                                </div>
                                            </form>
                                            <div style="display: none;" id="terdaftar">
                                                <div class="col-sm-4">
                                                    <div class="text-muted well well-sm no-shadow" style="margin-top: -69px; text-align:center; height: 150px">
                                                        <p></p>
                                                        <h3>Nomor Tiket</h3>
                                                        <input class="form-control" text-align="center" id="no_tiket" readonly />
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="text-muted well well-sm no-shadow" style="margin-top: -69px; text-align:center; height: 150px">
                                                        <p></p>
                                                        <h3>Nomor Urut</h3>
                                                        <input class="form-control" text-align="center" id="no_urut" readonly />
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="text-muted well well-sm no-shadow" style="margin-top: -69px; text-align:center; height: 150px">
                                                        <p></p>
                                                        <h3>Jam Perkiraan Dipanggil</h3>
                                                        <p class="text-success" style="font-size:30px" id="estimasiDipanggilJam"></p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div style="display: none;" id="tidak_terdaftar">
                                                <div class="col-sm-4">
                                                    <div class="text-muted well well-sm no-shadow" style="margin-top: -69px; text-align:center; height: 150px">
                                                        <p></p>
                                                        <h3>Total Antrian</h3>
                                                        <input class="form-control" text-align="center" id="total" readonly />
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="text-muted well well-sm no-shadow" style="margin-top: -69px; text-align:center; height: 150px">
                                                        <p></p>
                                                        <h3>Total Antrian Belum Dipanggil</h3>
                                                        <input class="form-control" text-align="center" id="menunggu" readonly />
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="text-muted well well-sm no-shadow" style="margin-top: -69px; text-align:center; height: 150px">
                                                        <p></p>
                                                        <h3>Total Antrian Sudah Dipanggil</h3>
                                                        <input class="form-control" text-align="center" id="dipanggil" readonly />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php else : ?>
                                    <div class="tab-pane active" role="tabpanel" id="poli">
                                        <div class="box-body">
                                            <br>
                                            <div class="alert alert-success alert-dismissible" role="alert">
                                                <button style="color: #fff; opacity: 1;" type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                <h4 style="margin-top: 0px;"><i class="fa fa-th"></i> Informasi Antrian Dokter</h4>
                                                <p>Silahkan Pilih Dokter dibawah untuk melihat antrian </p>
                                            </div>
                                            <form class="forms-sample" action="<?= site_url(''); ?>">
                                                <div class="col-sm-12" style="margin-bottom:80px">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="">Poiklnik</label>
                                                            <select class="form-control" id="id_ruangan" name="id_ruangan">
                                                                <?php foreach ($poli as $a) : ?>
                                                                    <option value=""></option>
                                                                    <option <?= $a->id_ruangan ?> value="<?= $a->id_ruangan ?>"><?= $a->nama_ruangan ?></option>
                                                                <?php endforeach; ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="">Tanggal</label>
                                                            <input type="text" autocomplete="off" class="form-control" placeholder="Tanggal" name="tgl_berobat" id="tgl_berobat" value="">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <button type="submit" id="cari" class="btn btn-success btn-sm">Lihat Antrian</button>
                                                    </div>
                                                </div>
                                            </form>
                                            <div style="display: none;" id="terdaftar">
                                                <div class="col-sm-4">
                                                    <div class="text-muted well well-sm no-shadow" style="margin-top: -69px; text-align:center; height: 150px">
                                                        <p></p>
                                                        <h3>Nomor Tiket</h3>
                                                        <input class="form-control" text-align="center" id="no_tiket" readonly />
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="text-muted well well-sm no-shadow" style="margin-top: -69px; text-align:center; height: 150px">
                                                        <p></p>
                                                        <h3>Nomor Urut</h3>
                                                        <input class="form-control" text-align="center" id="no_urut" readonly />
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="text-muted well well-sm no-shadow" style="margin-top: -69px; text-align:center; height: 150px">
                                                        <p></p>
                                                        <h3>Jam Perkiraan Dipanggil</h3>
                                                        <p class="text-success" style="font-size:30px" id="estimasiDipanggilJam"></p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div style="display: none;" id="tidak_terdaftar">
                                                <div class="col-sm-4">
                                                    <div class="text-muted well well-sm no-shadow" style="margin-top: -69px; text-align:center; height: 150px">
                                                        <p></p>
                                                        <h3>Total Antrian</h3>
                                                        <input class="form-control" text-align="center" id="total" readonly />
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="text-muted well well-sm no-shadow" style="margin-top: -69px; text-align:center; height: 150px">
                                                        <p></p>
                                                        <h3>Total Antrian Belum Dipanggil</h3>
                                                        <input class="form-control" text-align="center" id="menunggu" readonly />
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="text-muted well well-sm no-shadow" style="margin-top: -69px; text-align:center; height: 150px">
                                                        <p></p>
                                                        <h3>Total Antrian Sudah Dipanggil</h3>
                                                        <input class="form-control" text-align="center" id="dipanggil" readonly />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                <div class="tab-pane" role="tabpanel" id="apotik">
                                    <div class="box-body">
                                        <br>
                                        <div class="alert alert-success alert-dismissible" role="alert">
                                            <button style="color: #fff; opacity: 1;" type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h4 style="margin-top: 0px;"><i class="fa fa-th"></i> Informasi Antrian Apotik tanggal <?= date('d-m-Y'); ?></h4>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="text-muted well well-sm no-shadow" style="margin-top: 10px; text-align:center; height: 150px">
                                                <p></p>
                                                <h3>Total Antrian</h3>
                                                <h3 class="text-success"><?= @$apotik->total ?> Pasien</h3>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="text-muted well well-sm no-shadow" style="margin-top: 10px; text-align:center; height: 150px">
                                                <p></p>
                                                <h3>Antrian Belum Dipanggil</h3>
                                                <h3 class="text-success"><?= @$apotik->menunggu ?> Pasien</h3>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="text-muted well well-sm no-shadow" style="margin-top: 10px; text-align:center; height: 150px">
                                                <p></p>
                                                <h3>Antrian Sudah Dipanggil</h3>
                                                <h3 class="text-success"><?= @$apotik->dipanggil ?> Pasien</h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<div class="control-sidebar-bg"></div>
<script>
    document.onreadystatechange = () => {
        if (document.readyState === "complete") {
            var App = new Main;

            $("#id_dokter").select2({
                placeholder: "Pilih Dokter",
                allowClear: true
            });

            $("#id_ruangan").select2({
                placeholder: "Cari PoliKlinik",
                allowClear: true
            });

            $("#tgl_berobat").datepicker({
                format: 'dd/mm/yyyy',
                autoclose: true
            }).datepicker("setDate", new Date());

            $(document).on('click', '#cari_antiran', function(e) {
                e.preventDefault();
                var terpilih = $('#id_dokter').find("option:selected").val();
                var tgl_berobat = $('#tgl_berobat').val().split('/').join('-');
                $.post('<?= site_url('pasien/antrian/antrian_dokter'); ?>', {
                        id_dokter: terpilih,
                        tgl_berobat: tgl_berobat
                    },
                    function(hsl) {

                        if (hsl.no_tiket) {
                            $('#terdaftar').show();
                            $('#tidak_terdaftar').hide();
                        } else {
                            $('#terdaftar').hide();
                            $('#tidak_terdaftar').show();
                        }
                        $('#no_tiket').val(hsl.no_tiket);
                        $('#no_urut').val(hsl.no_urut);
                        $('#estimasiDipanggilJam').text(hsl.estimasiDipanggilJam);
                        console.log(hsl);
                        $('#total').val(hsl.total);
                        $('#menunggu').val(hsl.menunggu);
                        $('#dipanggil').val(hsl.dipanggil);
                    }, 'json');
            });


            $(document).on('click', '#cari', function(e) {
                e.preventDefault();

                var terpilih = $('#id_ruangan').find("option:selected").val();
                var tgl_berobat = $('#tgl_berobat').val().split('/').join('-');
                $.post('<?= site_url('pasien/antrian/antrian_poli'); ?>', {
                        id_ruangan: terpilih,
                        tgl_berobat: tgl_berobat
                    },
                    function(hsl) {

                        if (hsl.no_tiket) {
                            $('#terdaftar').show();
                            $('#tidak_terdaftar').hide();
                        } else {
                            $('#terdaftar').hide();
                            $('#tidak_terdaftar').show();
                        }
                        $('#no_tiket').val(hsl.no_tiket);
                        $('#no_urut').val(hsl.no_urut);
                        $('#estimasiDipanggilJam').text(hsl.estimasiDipanggilJam);
                        console.log(hsl);
                        $('#total').val(hsl.total);
                        $('#menunggu').val(hsl.menunggu);
                        $('#dipanggil').val(hsl.dipanggil);
                    }, 'json');
            });

        }

        function getTimeRemaining(endtime) {
            var now = new Date().getTime();
            var t = endtime - now;
            var seconds = Math.floor((t / 1000) % 60);
            var minutes = Math.floor((t / 1000 / 60) % 60);
            var hours = Math.floor((t / (1000 * 60 * 60)) % 24);
            var days = Math.floor(t / (1000 * 60 * 60 * 24));
            return {
                'total': t,
                'days': days,
                'hours': hours,
                'minutes': minutes,
                'seconds': seconds
            };
        }

        function initializeClock(clock, endtime) {
            var daysSpan = clock.querySelector('.days');
            var hoursSpan = clock.querySelector('.hours');
            var minutesSpan = clock.querySelector('.minutes');
            var secondsSpan = clock.querySelector('.seconds');

            function updateClock() {
                var t = getTimeRemaining(endtime);

                minutesSpan.innerHTML = ('0' + t.minutes).slice(-2);
                secondsSpan.innerHTML = ('0' + t.seconds).slice(-2);

                if (t.total <= 0) {
                    clearInterval(timeinterval);
                    clock.innerHTML = "<?= date('H:i', strtotime(@$loket->estimasiDipanggilJam)) ?>"
                }
            }

            updateClock();
            var timeinterval = setInterval(updateClock, 1000);
        }

        var clockdiv = document.querySelectorAll('.clockdiv');
        Array.from(clockdiv).forEach(function(clock) {
            var show = clock.getAttribute("show-info");

            var deadline = new Date(show).getTime();
            initializeClock(clock, deadline);
        });
    }
</script>