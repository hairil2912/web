<style>
    .profile-user-img {
        margin: 19px auto;
        width: 617px !important;
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
                                    <a href="<?= $barcode ?>" download="barcode.png" class="btn btn-success btn-block"><b>Download</b></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>
</div>