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
                        <h3 class="box-title"><i class="fa fa-bed"></i> Data Kamar</h3>
                        <div class="box-tools pull-right">
                            <a type="button" class="btn btn-success btn-xs" data-toggle="control-sidebar"><i class="fa fa-search"></i> Cari Kamar</a>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="alert alert-success alert-dismissible" role="alert">
                            <button style="color: #fff; opacity: 1;" type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 style="margin-top: 0px;"><i class="fa fa-th"></i> Informasi Ketersediaan Kamar </h4>
                        </div>
                        <table class="table table-bordered table-hovered table-striped">
                            <thead>
                                <tr>
                                    <th width="5" style="width:20px"> # </th>
                                    <th>Nama Ruangan</th>
                                    <th style="text-align:center">Total Bed</th>
                                    <th style="text-align:center">Terpakai</th>
                                    <th style="text-align:center">Kosong</th>
                                </tr>
                            </thead>
                            <tbody id="mybody">
                                <?php
                                    $no = 1; foreach($kamar as $k): 
                                    $a = $k->terpakai;
                                    $b = $k->kosong;
                                    $c = $a + $b;
                                ?>
                                <tr>
                                    <td><?= $no ?></td>
                                    <td><a style="color:black;" href="#"><?= @$k->nama_ruangan ?></a></td>
                                    <td style="color:blue; text-align:center;"><?= @$c ?></td>
                                    <td style="color:red; text-align:center;"><?= @$k->terpakai ?></td>
                                    <td style="color:green; text-align:center;"><?= @$k->kosong ?></td>
                                </tr>
                                <?php $no++; endforeach; ?>
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

<aside class="control-sidebar control-sidebar-dark control-sidebar-tabs" id="sidebar-filter">
    <div class="row" style="padding: 15px;">
        <div class="col-md-12">
            <form terget="_blank" id="form-search" method="POST">
                <div class="form-group">
                    <label>Kamar</label>
                    <input type="text" id="myInput" onkeyup="myFunction()" class="form-control input-sm" placeholder="Masukkan Nama Ruangan">
                </div>
            </form>
        </div>
    </div>
</aside>
<!-- /.content-wrapper -->
<!-- Add the sidebar's background. This div must be placed
     immediately after the control sidebar -->
<div class="control-sidebar-bg"></div>


<script>
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