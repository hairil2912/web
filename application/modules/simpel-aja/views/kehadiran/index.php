<style>
    .profile-user-img {
        margin: 19px auto;
        width: 617px !important;
        padding: 3px;
        /* border: 3px solid; */
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
                            <?php if (@$rwt->status == true && $rwt->multiple == false) :?>
                                    <div class="alert alert-success alert-dismissible" role="alert"> <button style="color: #fff; opacity: 1;" type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
                                        <h4 style="margin-top: 0px;">INFO</h4>
                                        <p>Download Barcode untuk konfirmasi kehadiran berobat di <span class="text-danger"><b><?= $profilRs->rs_nama ?></b></span></p>
                                    </div>
                                    <div class="box box-primary">
                                        <div class="box-body box-profile">
                                            <h4 style="text-align:center; font-weight:bold;">NOMOR TIKET BEROBAT</h4>
                                            <h5 style="text-align:center;">Tanggal : <?= date('d-m-Y') ?> </h5>
                                            <h1 style="text-align:center; font-weight:bold"><?= @$rwt->no_tiket ?></h1>
                                            <img class="profile-user-img img-responsive" src="<?= $barcode ?>" alt="User profile picture">
                                            <h4 style="text-align:center;">Berobat Poliklinik/Dokter</h4>
                                            <h4 style="text-align:center; font-weight:bold;"><?= @$rwt->nama_ruangan ?></h4>
                                            <h4 class="text-danger" style="text-align:center; font-weight:bold;"><?= @$rwt->nama_dokter ?></h4>
                                            <br>
                                            <h5 style="text-align:center; font-weight:bold;">NO URUT DIDOKTER : <?= @$rwt->no_urut ?></h5>
                                            <p style="text-align: center; font-weight: bold">Status Konfirmasi/Lapor Hadir :</p>
                                            <p style="text-align: center; font-weight: bold;"><?= @$isconfirm->is_confirm == 0 ? '"Belum Konfirmasi Hadir"' : '"Sudah Konfirmasi Hadir"' ?></p>
                                            <a href="<?= $barcode ?>" download="barcode.png" class="btn btn-success btn-block"><b>Download</b></a>
                                        </div>
                                    </div>
                            <?php elseif ($rwt->status == false && $rwt->multiple == true) :?>
                                <div class="alert alert-success alert-dismissible" role="alert"> <button style="color: #fff; opacity: 1;" type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
                                    <h4 style="margin-top: 0px;">INFO</h4>
                                    <p>Klik nama Poli Klinik untuk melihat <b>barcode</b> konfirmasi hadir..!!</p>
                                </div>
                                <ul class="timeline timeline-inverse">
                                    <?php foreach (@$rwt->data as $r) :?>
                                        <li>
                                            <i class="fa fa-history bg-aqua"></i>
                                            <div class="timeline-item">
                                                <h3 class="timeline-header">
                                                    <a target="_blank" href="<?= site_url('simpel-aja/kehadiran/detail/' . $r->no_tiket_full); ?>"><?= @$r->nama_ruangan ?></a>
                                                    <br>
                                                    <span class="time"><?= @$r->nama_dokter ?></span><br>
                                                    <span class="time"><?= date('d/m/Y', strtotime(@$r->tgl_berobat)) ?></span><br>
                                                </h3>
                                            </div>
                                        </li>
                                        
                                    <?php endforeach; ?>
                                </ul>
                            <?php elseif (@$rwt->status == false && $rwt->multiple == false) :?>
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