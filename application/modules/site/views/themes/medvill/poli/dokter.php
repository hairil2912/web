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
<!--breadcrumbs-inner-part start-->
<div class="breadcrumbs-inner-part img3">
    <div class="container">
        <div class="breadcrumbs-inner-bread text-center">
            <h1 class="title-part">Informasi Dokter</h1>
            <h2 style="color: white"><?= @$poli->nama_ruangan; ?></h2>
        </div>
    </div>
</div>
<!--breadcrumbs-inner-part start-->

<div class="col-md-12">
    <div class="search-data-contain-part">
        <div class="container">
            <div class="main-part">
                <div class="row rs-vertical-middle">
                    <div class="col-md-12">
                        <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Cari Dokter">
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
                                            <th width="100px">Foto</th>
                                            <th style="text-align: left; width:70%">Nama Dokter</th>
                                            <th width="150px" style="text-align:center">#</th>
                                        </tr>
                                    </thead>
                                    <tbody id="mybody">
                                        <?php if (!empty($dokter)) : ?>
                                            <?php $no = 1;
                                            foreach ($dokter as $d) : ?>
                                                <tr>
                                                    <td><?= $no ?></td>
                                                    <?php if(is_null($d->foto)) :?>
                                                        <td>
                                                            <?php if ($d->id_jk == 1) :?>
                                                                <img class="dok" style="width:75px !important; height:73px !important;"  src="<?= base_url('assets/static-image/male_dokter.jpg'); ?>"alt="">
                                                            <?php else :?>
                                                                <img class="dok" style="width:75px !important; height:73px !important;"  src="<?= base_url('assets/static-image/female_dokter.jpg'); ?>"alt="">
                                                            <?php endif; ?>
                                                        </td>
                                                    <?php else: ?>
                                                        <td>
                                                            <img class="dok" style="width:75px !important; height:73px !important;" src="<?= @$ip ?><?= @$d->foto ?>" alt=""></a>
                                                        </td>
                                                    <?php endif; ?>
                                                    <td style="text-align: left;">
                                                        <a href="#" style="color:black;"><?= @$d->nama_dokter ?></a>
                                                        <p style="font-size: 12px;"><?= @$d->nama_prodi ?></p>
                                                    </td>
                                                    <td style="text-align:center;">
                                                        <a href="<?= site_url('site/poli/detail_dokter/' . encrypt(@$d->id_user)) ?>">
                                                            <button class="btn btn-success">Detail Dokter</button>
                                                        </a>
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