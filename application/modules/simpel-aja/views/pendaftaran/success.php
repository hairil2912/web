<div class="modal-dialog modal-55">
    <div class="modal-content">
        <div class="modal-header">
            <div class="pull-left">
                <h4 class="modal-title" id="myModalLabel"><i class="fa fa-info-circle" style="margin-right: 10px"></i> Detail Pendaftaran Berobat</h4>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="modal-body" style="font-size: 12px !important">
            <div class="row">
                <div class="col-md-12">
                    <div class="box-body box-profile">
                        <img class="profile-user-img img-responsive img-circle" src="<?= base_url('assets/static-image/success-icon-2.png'); ?>" alt="User profile picture">
                        <h3 style="text-align:center">Yeay, Pendaftaran Berhasil!</h3>
                        <h4>Pendaftaran Rawat Jalan</h4>
                        <h4 id="nama_ruangan"></h4>
                    </div>
                    <div class="color-header box-header" style="text-align:center">
                        <h3 class="box-title">Informasi Pendaftaran</h3>
                    </div>
                    <div class="box box-danger color-body" style="text-align:center">
                        <div class="row">
                            <div>
                                <h4>No. Register</h4>
                                <h3 id="no_register"></h3>
                            </div>
                            <div>
                                <h4>No. Tiket</h4>
                                <h3 id="no_tiket"></h3>
                            </div>
                            <div>
                                <h4>No. Urut</h4>
                                <h3 id="no_urut"></h3>
                            </div>
                            <div>
                                <h4>Biaya Konsultasi</h4>
                                <h3 class="text-danger" id="nilai_bill"></h3>
                                <h6 class="text-danger">*Biaya tersebut belum termasuk biaya resep (Jika ada resep), Laboratorium, Radiologi, dan lain-lain.</h6>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <a href="<?= site_url('simpel-aja/antrian') ?>" class="btn btn-info btn-sm data-pasien-igd"><i class="fa fa-list"></i> Lihat Antrian</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>