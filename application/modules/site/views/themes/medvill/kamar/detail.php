<style>
    .breadcrumbs-inner-part .breadcrumbs-inner-bread {
        padding: 65px 0 120px;
    }
    .search-data-contain-part .main-part {
        background: #fff;
        padding: 20px;
        position: relative;
        margin-top: -50px !important;
        margin-bottom: -14px !important;
        border-radius: 10px;
        box-shadow: 10px 17px 38px 0 rgba(0, 0, 0, 0.1);
    }
    .rs-inner-department-part2 .inner-sec-no {
        margin-left: 0 !important;
        margin-right: 0 !important;
        border-radius: 10px !important;
    }
</style>
<div class="breadcrumbs-inner-part img3">
    <div class="container">
        <div class="breadcrumbs-inner-bread text-center">
            <h1 class="title-part"> Informasi Ketersediaan Kamar</h1>
            <h2 style="color: white"><?= $kelas ?></h2>
        </div>
    </div>
</div>
<div class="col-md-12">
    <div class="search-data-contain-part">
        <div class="container">
            <div class="main-part">
                <div class="row rs-vertical-middle">
                    <div class="col-md-12">
                        <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Cari Kamar">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<br>
<div class="col-lg-12 col-md-12">
    <div class="container">
        <div class="rs-inner-department-part2 pb-80 md-pb-50">
            <div class="row">
                <div class="col-lg-12 col-md-6 md-mb-30">
                    <div class="inner-sec-no">
                        <div class="desc-department">
                            <div style="overflow-x:auto;">
                                <table class="table table-bordered table-hovered table-striped">
                                    <thead>
                                        <tr>
                                            <th width="5" style="width:20px"> # </th>
                                            <th style="text-align: left;">Jenis Rawatan</th>
                                            <th style="text-align: left;">Nama Kamar</th>
                                            <th style="text-align:center">Jumlah Bed</th>
                                            <th style="text-align: center;">#</th>
                                        </tr>
                                    </thead>
                                    <tbody id="mybody">
                                        <?php $no = 1;
                                        foreach ($ruangan as $r) :
                                            $a = $r->nama_grup_rawatan;
                                            $b = $r->nama_ruangan;
                                            $c = $r->total_bed;
                                        ?>
                                            <tr>
                                                <td><?= $no ?></td>
                                                <td style="text-align: left;"><a style="color:black;"><?= @$a?></a></td>
                                                <td style="text-align: left;"><?= @$b ?></td>
                                                <td style="text-align:center; color:blue;"><?= @$c ?></td>
                                                <td style="text-align:center;">
                                                    <a href="<?= site_url('site/kamar/bed/' . encrypt(@$r->id_ruangan)) ?>">
                                                        <button class="btn btn-success btn-sm">Detail</button>
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php $no++;
                                        endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function myFunction() {
        var input, filter, tbody, tr, a, i, txtValue;
        input = document.getElementById('myInput');
        filter = input.value.toUpperCase();
        tbody = document.getElementById("mybody");
        tr = tbody.getElementsByTagName('tr');

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