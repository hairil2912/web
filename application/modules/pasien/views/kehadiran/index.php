<style>
    .profile-user-img {
        margin: 19px auto;
        width: 626px;
        padding: 3px;
    }
</style>

<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-danger">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-calendar-o"></i> Konfirmasi Kehadiran</h3>
                        <div class="box-tools pull-right">
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="col-sm-12">
                            <?php if (!empty($riwayat_berobat)) : ?>
                                <?php if ($jmlh_berobat == 1) : ?>
                                    <div class="alert alert-success alert-dismissible" role="alert"> <button style="color: #fff; opacity: 1;" type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
                                        <h4 style="margin-top: 0px;">INFO</h4>
                                        <p>Download Barcode untuk konfirmasi kehadiran berobat di <span class="text-danger"><b><?= $profilRs->rs_nama ?></b></span></p>
                                    </div>
                                    <div class="box box-primary">
                                        <div class="box-body box-profile">
                                            <img class="profile-user-img img-responsive" src="<?= $barcode ?>" alt="User profile picture">
                                            <p style="text-align: center; font-weight: bold;"><?= $isconfirm->is_confirm == 0 ? 'Belum Konfirmasi' : 'Sudah Konfirmasi' ?></p>
                                            <a href="<?= $barcode ?>" download="barcode.png" class="btn btn-success btn-block"><b>Download</b></a>
                                        </div>
                                    </div>
                                <?php else : ?>
                                    <div class="alert alert-success alert-dismissible" role="alert"> <button style="color: #fff; opacity: 1;" type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
                                        <h4 style="margin-top: 0px;">INFO</h4>
                                        <p>Klik nama dokter untuk melihat <b>barcode</b> konfirmasi hadir..!!</p>
                                    </div>
                                    <ul class="timeline timeline-inverse">
                                        <?php foreach ($riwayat_berobat as $r) : ?>
                                            <li>
                                                <i class="fa fa-history bg-aqua"></i>
                                                <div class="timeline-item">
                                                    <span class="time">Rp.<?= @$r->total_bill ?><br><?= @$r->status ?></span>
                                                    <h3 class="timeline-header">
                                                        <a target="_blank" href="<?= site_url('pasien/kehadiran/detail/' . $r->no_register); ?>"><?= @$r->nama_ruangan ?></a>
                                                        <br>
                                                        <span class="time"><?= date('d/m/Y', strtotime(@$r->tgl_berobat)) ?></span><br>
                                                        <span class="time"><?= @$r->nama_asuransi ?></span>
                                                    </h3>
                                                </div>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                <?php endif; ?>
                            <?php else : ?>
                                <ul class="timeline timeline-inverse">
                                    <li>
                                        <i class="fa fa-history bg-danger" style="background:#ce4143; color:white;"></i>
                                        <div class="timeline-item text-center">
                                            <h4>Belum ada data pendtafran berobat</h4>
                                        </div>
                                    </li>
                                </ul>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
    </section>
</div>