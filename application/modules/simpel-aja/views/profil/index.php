<style>
    span.select2.select2-container.select2-container--default {
        width: 100% !important;
    }
</style>

<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Biodata
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Biodata Pasien</li>
        </ol>
    </section>
    <section class="content">
        <?php $jk = (@$user->id_jk == 1 ? 'Laki-laki' : 'Perempuan');?>
        <div class="row">
            <div class="col-md-4">
                <div class="box box-danger" style="height:640px;">
                    <div class="box-body box-profile">
                        <?php if ($user->id_jk == '1') :?>
                            <img class="profile-user-img img-responsive img-circle" src="<?= base_url('assets/static-image/user.png'); ?>" alt="User profile picture">
                        <?php else: ?>
                            <img class="profile-user-img img-responsive img-circle" src="<?= base_url('assets/static-image/user-female.png'); ?>" alt="User profile picture">
                        <?php endif; ?>
                        <h3 class="profile-username text-center"><?= @$user->nama_lengkap ?></h3>
                        <p class="text-muted text-center">-</p>
                        <ul class="list-group list-group-unbordered">
                            <li class="list-group-item">
                                <b>Tempat/ Tgl Lahir</b> <a class="pull-right"><?= @$user->tmp_lhr ?>, <?= @$user->tgl_lhr ?></a>
                            </li>
                            <li class="list-group-item">
                                <b>Jenis Kelamin</b> <a class="pull-right"><?= @$jk ?></a>
                            </li>
                            <li class="list-group-item">
                                <b>Email</b> <a class="pull-right"><?= @$user->email?></a>
                            </li>
                            <li class="list-group-item">
                                <b>No Hp</b> <a class="pull-right"><?= @$user->no_hp?></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="box box-danger" style="height:640px;">
                    <div class="box-body">
                        <ul class="nav nav-tabs">
                            <li role="presentation" class="active">
                                <a href="#biodata" data-toggle="tab" aria-controls="biodata_pasien" href="#"><i class="fa fa-user"></i> Biodata</a>
                            </li>
                            <li role="presentation">
                                <a href="#pass" data-toggle="tab" aria-controls="pass" href="#"><i class="fa fa-key"></i> Password</a>
                            </li>
                        </ul>
                        <div class="tab-content no-padding">
                            <div class="tab-pane active" role="tabpanel" id="biodata">
                                <form class="forms-sample" action="<?= site_url('simpel-aja/profil/update'); ?>" method="POST" id="from_update">
                                    <input type="hidden" name="id_user" value="<?= @$user->id_user?>">
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label for="">Nama</label>
                                            <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" placeholder="Masukan Nama">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Jenis Kelamin</label>
                                            <select name="id_jk" id="id_jk" class="form-control">
                                                <option value=""></option>
                                                <option value="1">Laki-Laki</option>
                                                <option value="2">Perempuan</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Tgl Lahir</label>
                                            <input type="text" class="form-control" id="tgl_lhr" name="tgl_lhr" placeholder="Masukan Nama">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Tempat Lahir</label>
                                            <input type="text" class="form-control" id="tmp_lhr" name="tmp_lhr" placeholder="Masukan Tempat Lahir">
                                        </div>
                                        <div class="form-group">
                                            <label for="">ALamat</label>
                                            <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Masukan Alamat">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Email</label>
                                            <input type="text" class="form-control" id="email" name="email" placeholder="Masukan Email">
                                        </div>
                                        <div class="form-group">
                                            <label for="">No Hp</label>
                                            <input type="text" class="form-control" id="no_hp" name="no_hp" placeholder="Masukan No Hp">
                                        </div>
                                    </div>
                                    <div class="box-footer">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </form>
                            </div>
                            <div class="tab-pane" role="tabpanel" id="pass">
                                <form class="forms-sample" action="<?= site_url('simpel-aja/profil/ganti_pin'); ?>" method="POST" id="from_pin">
                                    <input type="hidden" name="id_user" value="<?= @$user->id_user?>">
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label for="">Pin Lama</label>
                                            <input type="text" class="form-control" id="pinLama" name="pinLama" placeholder="Masukan Pin Lama">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Pin Baru</label>
                                            <input type="text" class="form-control" id="pinBaru" name="pinBaru" placeholder="Masukan Pin Baru">
                                        </div>
                                    </div>
                                    <div class="box-footer">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
    document.onreadystatechange = () => {
        if (document.readyState === "complete") {
            var App = new Main;

            App.save('#from_update', function () {}, function (response) {
                if (response.status === true) {
                    setTimeout(function(){ 
                        window.location.replace("<?= site_url('simpel-aja/profil')?>");
                    }, 1000);
                }
            });

            App.save('#from_pin', function () {}, function (response) {
                if (response.status === true) {
                
                }
            });

            $("#id_jk").select2({
                placeholder: "Pilih Jenis Kelamin",
                allowClear: true
            });

            $("#tgl_lhr").datepicker({
                format: "dd/mm/yyyy",
                autoclose: true
            });
        }
    }
</script>