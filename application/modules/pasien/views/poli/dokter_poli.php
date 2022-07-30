<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <!-- <section class="content-header">
        <h1>
            Pasien
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Biodata Pasien</li>
        </ol>
    </section> -->

    <!-- Main content -->
    <section class="content">

        <div class="row">
            <div class="col-md-12">
                <div class="box box-danger">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-user-md"></i> Poliklinik</h3>
                        <div class="box-tools pull-right">
                            <a class="btn btn-danger btn-xs" href="<?= site_url('pasien/poli') ?>"><i class="fa fa-reply"></i> Kembali</a>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="">
                            <ul class="nav nav-tabs">
                                <li role="presentation" class="active">
                                    <a href="#dokter_jaga" data-toggle="tab" aria-controls="dokter_jaga" href="#"><i class="fa fa-users"></i> Dokter Jaga</a>
                                </li>
                                <li role="presentation">
                                    <a href="#fasilitas_poli" data-toggle="tab" aria-controls="fasilitas_poli" href="#"><i class="fa fa-users"></i> Fasilitas Poli</a>
                                </li>
                            </ul>
                            <div class="tab-content no-padding">
                                <div class="tab-pane active" role="tabpanel" id="dokter_jaga">
                                    <div class="box-body">
                                        <table class="table table-bordered table-hovered table-striped">
                                            <thead>
                                                <tr>
                                                    <th style="width:20px"> # </th>
                                                    <th>Nama Dokter</th>
                                                    <th style="width: 35px"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if (!empty($dokter)) : ?>
                                                    <?php $no = 1;
                                                    foreach ($dokter as $d) : ?>
                                                        <tr>
                                                            <td><?= $no ?></td>
                                                            <td><?= @$d->nama_dokter ?>
                                                                <p style="font-size: 12px"><?= @$d->nama_prodi ?></p>
                                                                <p style="color: gray">Jadwal Praktek</p>
                                                                <?php foreach ($d->jadwal as $i) : ?>
                                                                    <p><?= $i->hari ?> &nbsp;&nbsp;&nbsp;&nbsp; <?= $i->jam ?></p>
                                                                <?php endforeach; ?>
                                                            </td>
                                                            <td>
                                                                <a data-toggle="tooltip" id="detail" data-id="<?= @$d->id_user ?>" data-placement="top" title="Detail"><i class="fa fa-search"></i></a>
                                                            </td>
                                                        </tr>
                                                    <?php $no++;
                                                    endforeach; ?>
                                                <?php else : ?>
                                                    <tr>
                                                        <td style="text-align:center" colspan="3">Tidak ditemukan data yang sesuai</td>
                                                    </tr>
                                                <?php endif; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane" role="tabpanel" id="fasilitas_poli">
                                    <div class="box-body">
                                        <table class="table table-bordered table-hovered table-striped">
                                            <thead>
                                                <tr>
                                                    <th style="width:20px"> # </th>
                                                    <th>Fasilitas Poli</th>
                                                    <th style="width: 35px"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td style="text-align:center" colspan="3">Data Fasilitas Belum Ada</td>
                                                </tr>
                                            </tbody>
                                        </table>

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
                var id_user = $(this).attr('data-id');
                $.get(site_url + 'pasien/poli/detail_dokter/' + id_user, function(html) {
                    $('#myModal').html(html);
                    $('#myModal').modal('show');
                });
            });

            // $(document).on('click', '#detail_transaksi', function() {
            //     var no_register = $(this).attr('data-id');
            //     $.get(site_url + 'pasien/riwayat/detail_transaksi/' + no_register, function(html) {
            //         $('#myModal').html(html);
            //         $('#myModal').modal('show');
            //     });
            // });
        }
    }
</script>