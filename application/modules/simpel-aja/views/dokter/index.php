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
                        <h3 class="box-title"><i class="fa fa-user-md"></i> Data Dokter</h3>
                        <div class="box-tools pull-right">
                            <a type="button" class="btn btn-success btn-xs" data-toggle="control-sidebar"><i class="fa fa-search"></i> Cari Dokter</a>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table class="table table-bordered table-hovered table-striped">
                            <thead>
                                <tr>
                                    <th width="5" style="width:20px"> # </th>
                                    <th>Nama Dokter</th>
                                    <th style="width: 35px"></th>
                                </tr>
                            </thead>
                            <tbody id="mybody">
                                <?php $no = 1;
                                foreach ($dokter as $d) : ?>
                                    <tr>
                                        <td><?= $no ?></td>
                                        <td><a style="color:black" href="#"><?= @$d->nama_dokter ?></a>
                                            <p><?= @$d->nama_prodi ?></p>
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
                            </tbody>
                        </table>
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

<aside class="control-sidebar control-sidebar-dark control-sidebar-tabs" id="sidebar-filter">
    <div class="row" style="padding: 15px;">
        <div class="col-md-12">
            <form terget="_blank" id="form-search" method="POST">
                <div class="form-group">
                    <label>Dokter</label>
                    <input type="text" id="myInput" onkeyup="myFunction()" class="form-control input-sm" placeholder="Masukkan Nama Dokter">
                </div>

                <!-- <div class="form-group">
                    <label> </label>
                    <button type="button" class="btn btn-sm btn-info" id="button-search"><i class="fa fa-search"></i> Cari Data</button>

                </div> -->
            </form>
        </div>
    </div>
</aside>

<!-- Add the sidebar's background. This div must be placed
     immediately after the control sidebar -->
<div class="control-sidebar-bg"></div>

<script>
    document.onreadystatechange = () => {
        if (document.readyState === "complete") {
            var App = new Main;

            $(document).on('click', '#detail', function() {
                var id_user = $(this).attr('data-id');
                $.get(site_url + 'simpel-aja/dokter/detail_dokter/' + id_user, function(html) {
                    $('#myModal').html(html);
                    $('#myModal').modal('show');
                });
            });
        }
    }

    function myFunction() {
        // Declare variables
        var input, filter, tbody, tr, a, i, txtValue;
        input = document.getElementById('myInput');
        filter = input.value.toUpperCase();
        tbody = document.getElementById("mybody");
        tr = tbody.getElementsByTagName('tr');

        // Loop through all list items, and hide those who don't match the search query
        for (i = 0; i < tr.length; i++) {
            a = tr[i].getElementsByTagName("a")[0];
            txtValue = a.textContent || a.innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                tr[i].style.display = "";
            } else {
                tr[i].style.display = "none";
            }
        }
    }
</script>