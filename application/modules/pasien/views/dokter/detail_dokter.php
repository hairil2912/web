<style>
    .col-md-12 {
        height: 200px;
    }

    .modal-content {
        width: 399px;
        margin-left: 100px;
        margin-right: 100px;
        height: 450px;
    }
</style>
<div class="modal-dialog modal-1">
    <div class="modal-content">
        <div class="modal-header">
            <div class="pull-left">
                <h4 class="modal-title" id="myModalLabel"><i class="fa fa-info-circle" style="margin-right: 10px"></i> Profil Dokter</h4>
            </div>
            <div class="pull-right">
                <button type="button" class="btn btn-default" data-dismiss="modal">X</button>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="modal-body" style="font-size: 12px !important">
            <div class="row">
                <div class="col-md-12">
                    <!-- Profile Image -->
                    <!-- <div class="box box-primary"> -->
                    <div class="box-body box-profile">
                        <!-- <img class="profile-user-img img-responsive img-circle" src="../../dist/img/user4-128x128.jpg" alt="User profile picture"> -->
                        <img class="profile-user-img img-responsive img-circle" src="<?= base_url('assets/static-image/user.png'); ?>" alt="User profile picture">
                        <h3 class="profile-username text-center"><?= @$detail->nama_lengkap ?></h3>
                        <ul class="list-group list-group-unbordered">
                            <li class="list-group-item">
                                <b>Tempat, Tgl Lahir</b> <a class="pull-right"><?= @$detail->tmp_lhr ?>, <?= @$detail->tgl_lhr ?></a>
                            </li>
                            <li class="list-group-item">
                                <b>Spesialis</b> <a class="pull-right"><?= @$detail->nama_prodi ?></a>
                            </li>
                            <li class="list-group-item">
                                <b>Alamat</b> <a class="pull-right"><?= @$detail->alamat ?></a>
                            </li>
                            <li class="list-group-item">
                                <b>Email</b> <a class="pull-right"><?= @$detail->email ?></a>
                            </li>
                            <li class="list-group-item">
                                <b>No.HP</b> <a class="pull-right"><?= @$detail->no_hp ?></a>
                            </li>
                        </ul>
                    </div>
                    <!-- /.box-body -->
                    <!-- </div> -->
                </div>
            </div>
        </div>
    </div>
</div>