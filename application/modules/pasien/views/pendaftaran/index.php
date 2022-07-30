<style>
    span.select2.select2-container.select2-container--default {
        width: 100% !important;
    }
</style>
<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <p></p>
                <div class="box box-danger">
                    <div class="box-header with-border">
                        <h3 class="box-title"> Pendaftaran Berobat</h3>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="box box-danger color-body" style="min-height: 620px;">
                                    <div class="box-header with-border color-header">
                                        <h3 class="box-title"><i class="fa fa-edit"></i> Form Pendaftaran </h3>
                                    </div>
                                    <form class="forms-sample" action="<?= site_url('pasien/pendaftaran/daftar'); ?>" method="POST" id="from_daftar">
                                        <div class="box-body">
                                            <input type="hidden" name="id_dokter">
                                            <div class="form-group">
                                                <label for="">Tanggal <span class="text-danger">*</span></label>
                                                <input type="text" autocomplete="off" class="form-control" placeholder="Tanggal" name="tgl_berobat" id="tgl_berobat" value="">
                                            </div>
                                            <div class="form-group">
                                                <label for="">Cara Bayar <span class="text-danger">*</span></label>
                                                <select class="form-control" id="id_asuransi" name="id_asuransi">
                                                    <?php foreach ($asuransi as $a) : ?>
                                                        <option value=""></option>
                                                        <option <?= $a->id_asuransi ?> value="<?= $a->id_asuransi ?>"><?= $a->nama_asuransi ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <?php if ($config->is_rumkit == '0') : ?>
                                                <div class="form-group">
                                                    <label for="">Dokter <span class="text-danger">*</span></label>
                                                    <select class="form-control" id="id_dokter" name="id_dokter"></select>
                                                </div>
                                            <?php else : ?>
                                                <div class="form-group">
                                                    <label for="">Poli Klinik <span class="text-danger">*</span></label>
                                                    <select class="form-control" id="id_ruangan" name="id_ruangan">
                                                        <option value=""></option>
                                                        <?php foreach ($poli as $p) :
                                                            if ($p->is_praktek == '1') :
                                                        ?>
                                                                <option <?= $p->id_ruangan ?> value="<?= $p->id_ruangan ?>"><?= $p->nama_ruangan ?></option>
                                                        <?php endif;
                                                        endforeach; ?>
                                                    </select>
                                                </div>
                                                <div class="form-group" id="check_ranap" style="display: none;">
                                                    <div class="form-check form-check-success inap">
                                                        <label class="form-check-label">
                                                            <input type="checkbox" name="pasca_ranap" value="1" class="form-check-input"> Kontrol Ulang Pasca Rawat Inap <i class="input-helper"></i></label>
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                            <div class="form-group" id="keluhan_pasien">
                                                <label for="">Keluhan</label>
                                                <textarea class="form-control" id="keluhan" name="keluhan" placeholder="ketik keluhan kk disini" rows="4"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-success">Mendaftar</button>
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
</div>
<script>
    document.onreadystatechange = () => {
        if (document.readyState === "complete") {
            var App = new Main;

            App.save('#from_daftar', function() {}, function(response) {
                console.log(response);
                if (response.status === true) {
                    $.get(site_url + 'pasien/pendaftaran/success', function(html) {
                        $('#myModal').html(html);
                        $.each(response.data, function(index, value) {
                            $('#' + index).text(value);
                        });

                        $('#myModal').modal('show');
                    });
                }
            });

            $("#tgl_berobat").datepicker({
                format: 'dd/mm/yyyy',
                autoclose: true
            }).datepicker("setDate", new Date());

            $("#id_asuransi").select2({
                placeholder: "Pilih Cara Bayar",
                allowClear: true
            });

            $('#id_dokter').select2({
                placeholder: 'Pilih Dokter',
                allowClear: true
            });

            $('#id_ruangan').select2({
                placeholder: 'Pilih Poliklinik',
                allowClear: true,
            });

            $(document).on('change', '#id_asuransi', function() {
                var id_asuransi = $(this).val();
                if (id_asuransi == '101') {
                    $.get('<?= site_url('pasien/pendaftaran/dokter_spesialis_bpjs/') ?>' + id_asuransi, function(response) {
                        $('#id_dokter').html(response)
                    });
                } else {
                    $.get('<?= site_url('pasien/pendaftaran/dokter_spesialis/') ?>' + id_asuransi, function(response) {
                        $('#id_dokter').html(response)
                    });
                }
            });

            $(document).on('change', '#id_ruangan', function() {
                if ($(this).val() != "0") {
                    $('#check_ranap').show();
                } else {
                    $('#check_ranap').css('display', 'none');
                }
            });
        }
    }
</script>