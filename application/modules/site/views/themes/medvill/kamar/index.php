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
        </div>
    </div>
</div>
<div class="col-md-12">
    <div class="search-data-contain-part">
        <div class="container">
            <div class="main-part">
                <div class="row rs-vertical-middle">
                    <div class="col-md-12">
                        <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Cari Kelas">
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
                                            <th style="text-align: left;">Nama Ruangan</th>
                                            <th style="text-align:center">Total Bed</th>
                                            <th style="text-align:center">Terpakai</th>
                                            <th style="text-align:center">Kosong</th>
                                            <th style="text-align:center">#</th>
                                        </tr>
                                    </thead>
                                    <tbody id="mybody">
                                        <?php $no = 1;
                                        foreach ($kamar as $k) :
                                            $a = $k->terpakai;
                                            $b = $k->kosong;
                                            $c = $a + $b; ?>
                                            <tr>
                                                <td><?= $no ?></td>
                                                <td style="text-align: left;"><a style="color:black;"><?= @$k->nama_ruangan ?></a></td>
                                                <td style="color:blue; text-align:center"><?= @$c ?></td>
                                                <td style="color:red; text-align:center;"><?= @$k->terpakai ?></td>
                                                <td style="color:green; text-align:center;"><?= @$k->kosong ?></td>
                                                <td style="text-align:center;">
                                                    <a href="<?= site_url('site/kamar/detail/' . encrypt(@$k->id_ruangan)) ?>">
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