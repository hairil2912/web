<!-- Content Wrapper. Contains page content -->
<style>
    span.time {
        font-size: 14px;
        color: #3a4f58;
    }
</style>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <!-- Main content -->
    <section class="content">

        <div class="row">
            <div class="col-md-12">
                <div class="box box-danger">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-calendar-times-o"></i> Riwayat</h3>
                    </div>
                    <div class="box-body">
                        <div class="">
                            <ul class="nav nav-tabs">
                                <li role="presentation" class="active">
                                    <a href="#riwayat_transaksi" data-toggle="tab" aria-controls="riwayat_transaksi" href="#"><i class="fa fa-users"></i> Riwayat Transaksi</a>
                                </li>
                                <li role="presentation">
                                    <a href="#riwayat_berobat" data-toggle="tab" aria-controls="riwayat_berobat" href="#"><i class="fa fa-users"></i> Riwayat Berobat</a>
                                </li>
                            </ul>
                            <div class="tab-content no-padding">
                                <div class="tab-pane active" role="tabpanel" id="riwayat_transaksi">
                                    <div class="box-body">
                                        <br>
                                        <div class="alert alert-success alert-dismissible" role="alert">
                                            <button style="color: #fff; opacity: 1;" type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h4 style="margin-top: 0px;">Riwayat Transaksi</h4>
                                            <p>Informasi Riwayat Transaksi Berobat</p>
                                        </div>
                                        <?php if (!empty($riwatar_tr)) : ?>
                                            <ul class="timeline timeline-inverse">
                                                <?php foreach ($riwatar_tr as $r) : ?>
                                                    <li>
                                                        <i class="fa fa-history bg-aqua"></i>
                                                        <div class="timeline-item">
                                                            <span class="time">Rp.<?= @$r->total_bill ?><br><?= @$r->status ?></span>
                                                            <h3 class="timeline-header"><a id="detail_transaksi" data-id="<?= @$r->no_register ?>" href="#"><?= @$r->nama_ruangan ?></a><br>
                                                                <span class="time"><?= date('d/m/Y', strtotime(@$r->tgl_berobat)) ?></span><br>
                                                                <span class="time"><?= @$r->nama_asuransi ?></span>
                                                            </h3>
                                                        </div>
                                                    </li>
                                                <?php endforeach; ?>
                                            </ul>
                                        <?php else : ?>
                                            <ul class="timeline timeline-inverse">
                                                <li>
                                                    <i class="fa fa-history bg-danger" style="background:#ce4143; color:white;"></i>
                                                    <div class="timeline-item text-center">
                                                        <h4>Belum ada Riwayat Transaksi Berobat</h4>
                                                    </div>
                                                </li>
                                            </ul>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="tab-pane" role="tabpanel" id="riwayat_berobat">
                                    <div class="box-body">
                                        <br>
                                        <div class="alert alert-success alert-dismissible" role="alert">
                                            <button style="color: #fff; opacity: 1;" type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h4 style="margin-top: 0px;">Riwayat Kunjungan</h4>
                                            <p>Informasi Riwayat Kunjungan Berobat</p>
                                        </div>
                                        <?php if (!empty($riwayat)) : ?>
                                            <ul class="timeline timeline-inverse">
                                                <?php foreach ($riwayat as $r) : ?>
                                                    <li>
                                                        <i class="fa fa-history bg-aqua"></i>
                                                        <div class="timeline-item">
                                                            <!-- <span class="time">Rp.<?= @$r->total_bill ?><br><?= @$r->status ?></span>
                                                            <h3 class="timeline-header"><a id="detail_transaksi" data-id="<?= @$r->no_register ?>" href="#"><?= @$r->nama_ruangan ?></a><br>
                                                                <span class="time"><?= date('d/m/Y', strtotime(@$r->tgl_berobat)) ?></span><br>
                                                                <span class="time"><?= @$r->nama_asuransi ?></span>
                                                            </h3> -->
                                                            <span class="time">Rp.<?= @$r->total_bill ?></span>
                                                            <h3 class="timeline-header"><a id="detail" data-id="<?= @$r->no_register ?>" href="#"><?= @$r->nama_ruangan ?></a><br>
                                                                <span class="time"><?= date('d/m/Y', strtotime(@$r->tgl_berobat)) ?></span><br>
                                                                <span class="time"><?= @$r->nama_asuransi ?></span><br>
                                                            </h3>
                                                            <!-- <div class="timeline-footer">
                                                                <a class="btn btn-primary btn-xs" id="detail" data-id="<?= @$r->no_register ?>">Lihat Detail</a>
                                                            </div> -->
                                                        </div>
                                                    </li>
                                                <?php endforeach; ?>
                                            </ul>
                                        <?php else : ?>
                                            <ul class="timeline timeline-inverse">
                                                <li>
                                                    <i class="fa fa-history bg-danger" style="background:#ce4143; color:white;"></i>
                                                    <div class="timeline-item text-center">
                                                        <h4>Belum ada Riwayat Kunjungan</h4>
                                                    </div>
                                                </li>
                                            </ul>
                                        <?php endif; ?>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- ./box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- Add the sidebar's background. This div must be placed
     immediately after the control sidebar -->
<div class="control-sidebar-bg"></div>

<script>
    document.onreadystatechange = () => {
        if (document.readyState === "complete") {
            var App = new Main;

            $(document).on('click', '#detail', function() {
                var no_register = $(this).attr('data-id');
                $.get(site_url + 'pasien/riwayat/detail/' + no_register, function(html) {
                    $('#myModal').html(html);
                    $('#myModal').modal('show');
                });
            });

            $(document).on('click', '#detail_transaksi', function() {
                var no_register = $(this).attr('data-id');
                $.get(site_url + 'pasien/riwayat/detail_transaksi/' + no_register, function(html) {
                    $('#myModal').html(html);
                    $('#myModal').modal('show');
                });
            });
        }
    }
</script>