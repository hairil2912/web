<style>
    .breadcrumbs-inner-part .breadcrumbs-inner-bread {
        padding: 65px 0 120px;
    }

    .item-services {
        padding: 70px 35px 45px 35px;
        border-bottom-width: 4px;
        transition: all 0.3s ease 0s;
        box-shadow: 0px 3px 36px rgba(0, 0, 0, 0.04);
        background: #fff;
        border-radius: 7px;
        position: relative !important;
    }

    .item-services .item {
        text-align: center;
    }

    .alert-success {
        color: #ffffff;
        border-color: #ffffff;
        margin-left: -14px;
        margin-right: -14px;
    }

    .rs-inner-department-part2 .inner-sec-no {
        margin-left: -14px !important;
        margin-right: -14px !important;
        border-radius: 10px !important;
    }

    .rs-inner-department-part2 .inner-sec-no .desc-department {
        padding: 22px 40px 8px;
        margin-left: -16px;
        margin-right: -16px;
    }
    .search-data-contain-part .main-part {
        background: #fff;
        padding: 20px;
        position: relative;
        margin-top: 0px !important;
        margin-bottom: -14px !important;
        border-radius: 10px;
        box-shadow: 10px 17px 38px 0 rgba(0, 0, 0, 0.1);
    }

    .search-data-contain-part {
        margin-left: -12px;
        margin-right: -12px;
    }

</style>
<div class="breadcrumbs-inner-part img3">
    <div class="container">
        <div class="breadcrumbs-inner-bread text-center">
            <h1 class="title-part"> Antrian</h1>
        </div>
    </div>
</div>
<div id="rs-single-shop" class="rs-single-shop">
    <div class="container">
        <div class="tab-area">
            <ul class="nav nav-tabs">
                <li><a class="active" href="#one" data-toggle="tab">Poli</a></li>
                <li><a href="#two" data-toggle="tab" class="">Apotik</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="one">
                    <div class="col-lg-12 col-md-12">
                        <div class="alert alert-success alert-dismissible" role="alert">
                            <h4 style="color: #ffffff; margin: 10px 0px 10px; !important"><i class="fa fa-th"></i> Informasi Antrian Poliklinik Tanggal <?= date('d/m/Y')?></h4>
                        </div>
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
                                                            <th style="text-align: left;">Nama Ruangan</th>
                                                            <th style="text-align:center">Total Pasien</th>
                                                            <th style="text-align:center">Dilayani</th>
                                                            <th style="text-align:center">Sisa Antrian</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="mybody">
                                                        <?php if ($poli == null) :?>
                                                            <tr>
                                                                <td style="text-align: center;" colspan="5">Tidak ada data Antian Poliklinik</td>
                                                            </tr>
                                                            <?php else :?>
                                                                <?php $no = 1;  foreach ($poli as $p) :
                                                                    $a = $p->nama_ruangan;
                                                                    $b = $p->total;
                                                                    $c = $p->dipanggil;
                                                                    $d = $p->menunggu; ?>
                                                                    <tr>
                                                                        <td><?= $no ?></td>
                                                                        <td style="text-align: left;"><a style="color:black;"><?= @$p->nama_ruangan ?></a></td>
                                                                        <td style="color:blue; text-align:center"><?= @$p->total ?></td>
                                                                        <td style="color:green; text-align:center;"><?= @$p->menunggu ?></td>
                                                                        <td style="color:red; text-align:center;"><?= @$p->dipanggil ?></td>
                                                                    </tr>
                                                                <?php $no++; endforeach; ?>
                                                            <?php endif; ?>
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
                <div class="tab-pane" id="two">
                    <div class="col-lg-12 col-md-12">
                        <div class="alert alert-success alert-dismissible" role="alert">
                            <h4 style="color: #ffffff; margin: 10px 0px 10px; !important"><i class="fa fa-th"></i> Informasi Antrian Apotik Tanggal <?= date('d/m/Y')?></h4>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="search-data-contain-part">
                                    <div class="main-part">
                                        <div class="col-sm-12">
                                            <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Cari No. Tiket / Nama Pasien">
                                        </div>
                                    </div>
                                </div>
                                <br>
                            </div>
                        </div>
                        <div class="rs-inner-department-part2 pb-80 md-pb-50">
                            <div class="row">
                                <div class="col-lg-12 col-md-6 md-mb-30">
                                    <div class="inner-sec-no">
                                        <div class="desc-department">
                                            <div style="overflow-x:auto;">
                                                <table class="table table-bordered table-hovered table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th style="width:10% !important; text-align:left;"> No. Tiket</th>
                                                            <th style="width: 30%; text-align:left;">Nama Pasien</th>
                                                            <th style="width: 30%; text-align:left;">Dokter</th>
                                                            <th style="width: 10%; text-align:left;">Cara Bayar</th>
                                                            <th style="text-align:center; width: 25%">Status</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="mybodyapotik">
                                                    <?php if ($apotik == null) :?>
                                                        <tr>
                                                            <td id="no" style="text-align:center;" colspan="5">Tidak ada data Antrian Apotik</td>
                                                        </tr>
                                                        <?php else :?>
                                                            <?php foreach ($apotik as $apotik) :?>
                                                                <tr>
                                                                    <td style="text-align: center;"><a style="color: black;"><?= $apotik->no_tiket; ?></a></td>
                                                                    <td style="text-align: left;"><a style="color: black;"><?= $apotik->nama_pasien; ?></a></td>
                                                                    <td style="text-align: left;"><?= $apotik->nama_dokter; ?></td>
                                                                    <td style="text-align: center;"><?= $apotik->cara_bayar; ?></td>
                                                                    <td style="text-align: left;"><?= $apotik->sts; ?></td>
                                                                </tr>
                                                            <?php endforeach; ?>
                                                        <?php endif; ?>
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
            </div>
        </div>
    </div>
</div>

<script>
    function myFunction() {
        var input, filter, tbody, tr, a, i, txtValue;
        input = document.getElementById('myInput');
        filter = input.value.toUpperCase();
        tbody = document.getElementById("mybodyapotik");
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