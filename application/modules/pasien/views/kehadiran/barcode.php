<style>
    .profile-user-img {
        margin: 19px auto;
        width: 626px;
        padding: 3px;
        /* border: 3px solid #d2d6de; */
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
                        </div>
                    </div>
                </div>
            </div>
    </section>
</div>