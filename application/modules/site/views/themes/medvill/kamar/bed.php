<style>
    .breadcrumbs-inner-part .breadcrumbs-inner-bread {
        padding: 65px 0 120px;
    }
   
    .rs-quality-services-part .item-services:after {
        background: #738c5700 !important;
    }

    .center {
        display: block;
        margin-left: auto;
        margin-right: auto;
        height: 60px;
    }  

    .search-data-contain-part .main-part {
        margin-top: -95px !important;
    }
</style>
<div class="breadcrumbs-inner-part img3">
    <div class="container">
        <div class="breadcrumbs-inner-bread text-center">
            <h1 class="title-part"> Informasi Ketersediaan Bed</h1>
            <h2 style="color: white"><?= $nama_ruangan ?></h2>
        </div>
    </div>
</div>
<div class="search-data-contain-part" style="margin-bottom: 100px;">
    <div class="container">
        <div class="main-part">
            <div class="rs-quality-services-part">
                <div class="container">
                    <?php $no = 2; foreach ($bed as $b) :?>
                        <?php if ($no %2 === 0) :?>
                        <div class="row">
                            <?php if  ($b->sts_kondisi == 1) :?>
                                <?php if ($b->sts_bed == 0) :?>
                                    <div class="col-sm-5">
                                        <div class="row">
                                            <div class="col-sm-7" style="margin-right: -32px;">
                                                <div class="item" style="box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.33); height: 90px;  border-radius: 0px !important; border: 1px solid #1e19197a !important">
                                                    <div class="item">
                                                        <div class="content-part">
                                                            <img class="icon-img center" style="margin-top: 0px !important;" width="60px !importantl"  src="<?= base_url('assets/static-image/bed.jpeg') ?>" alt="">
                                                            <h6 class="tite" style="text-align: center; font-size:12px">Tersedia  (Kosong)</h6>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-5">
                                                <div class="item" style="box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.33); height: 90px; background: #81d594 !important; border-radius: 0px !important; border: 1px solid #1e19197a !important">
                                                    <div class="item">
                                                        <div class="content-part">
                                                            <h6 class="tite" style="text-align: center; margin-top: 19px !important;">No. BED</h6>
                                                            <h2 class="tite" style="text-align: center; margin-top: -28px !important;"><?= $b->no_bed?></h2>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php elseif ($b->sts_bed == 1): ?>
                                    <div class="col-sm-5">
                                        <div class="row">
                                            <div class="col-sm-7" style="margin-right: -32px;">
                                                <div class="item" style="box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.33); height: 90px;  border-radius: 0px !important; border: 1px solid #1e19197a !important">
                                                    <div class="item">
                                                        <div class="content-part">
                                                            <img class="icon-img center" style="margin-top: 0px !important;" width="60px !importantl"  src="<?= base_url('assets/static-image/bed.jpeg') ?>" alt="">
                                                            <h6 class="tite" style="text-align: center; font-size:12px">Ada Pasien</h6>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-5">
                                                <div class="item" style="box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.33); height: 90px; background: #f05a61 !important; border-radius: 0px !important; border: 1px solid #1e19197a !important">
                                                    <div class="item">
                                                        <div class="content-part">
                                                            <h6 class="tite" style="text-align: center; margin-top: 19px !important;">No. BED</h6>
                                                            <h2 class="tite" style="text-align: center; margin-top: -28px !important;"><?= $b->no_bed?></h2>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php elseif ($b->sts_bed == 2) :?>
                                    <div class="col-sm-5">
                                        <div class="row">
                                            <div class="col-sm-7" style="margin-right: -32px;">
                                                <div class="item" style="box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.33); height: 90px;  border-radius: 0px !important; border: 1px solid #1e19197a !important">
                                                    <div class="item">
                                                        <div class="content-part">
                                                            <img class="icon-img center" style="margin-top: 0px !important;" width="60px !importantl"  src="<?= base_url('assets/static-image/bed.jpeg') ?>" alt="">
                                                            <h6 class="tite" style="text-align: center; font-size:12px">Sedang Dibersihkan</h6>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-5">
                                                <div class="item" style="box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.33); height: 90px; background: #fdec7b !important; border-radius: 0px !important; border: 1px solid #1e19197a !important">
                                                    <div class="item">
                                                        <div class="content-part">
                                                            <h6 class="tite" style="text-align: center; margin-top: 19px !important;">No. BED</h6>
                                                            <h2 class="tite" style="text-align: center; margin-top: -28px !important;"><?= $b->no_bed?></h2>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            <?php else : ?>
                                <div class="col-sm-5">
                                    <div class="row">
                                        <div class="col-sm-7" style="margin-right: -32px;">
                                            <div class="item" style="box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.33); height: 90px;  border-radius: 0px !important; border: 1px solid #1e19197a !important">
                                                <div class="item">
                                                    <div class="content-part">
                                                        <img class="icon-img center" style="margin-top: 0px !important;" width="60px !importantl"  src="<?= base_url('assets/static-image/bed.jpeg') ?>" alt="">
                                                        <h6 class="tite" style="text-align: center; font-size:12px">Rusak</h6>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-5">
                                            <div class="item" style="box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.33); height: 90px; background: #828282 !important; border-radius: 0px !important; border: 1px solid #1e19197a !important">
                                                <div class="item">
                                                    <div class="content-part">
                                                        <h6 class="tite" style="text-align: center; margin-top: 19px !important;">No. BED</h6>
                                                        <h2 class="tite" style="text-align: center; margin-top: -28px !important;"><?= $b->no_bed ?></h2>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <!--  -->
                            <div class="col-sm-2" style="margin-right: 0px;">
                                <img class="icon-img center" style="margin-top: 0px !important;" width="60px !importantl"  src="<?= base_url('assets/static-image/arrow.png') ?>" alt="">
                            </div>
                            <!--  -->
                        <?php else : ?>
                            <?php if ($b->sts_kondisi == 1) :?>
                                <?php if ($b->sts_bed == 0) :?>
                                    <div class="col-sm-5">
                                        <div class="row">
                                            <div class="col-sm-5" style="margin-left: 0px; margin-right: -31px;">
                                                <div class="item" style="box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.33); height: 90px; background: #81d594 !important; border-radius: 0px !important; border: 1px solid #1e19197a !important">
                                                    <div class="item">
                                                        <div class="content-part">
                                                            <h6 class="tite" style="text-align: center; margin-top: 19px !important;">No. BED</h6>
                                                            <h2 class="tite" style="text-align: center; margin-top: -28px !important;"><?= $b->no_bed?></h2>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-7" style="margin-right: -0px;">
                                                <div class="item" style="box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.33); height: 90px;  border-radius: 0px !important; border: 1px solid #1e19197a !important">
                                                    <div class="item">
                                                        <div class="content-part">
                                                            <img class="icon-img center" style="margin-top: 0px !important;" width="60px !importantl"  src="<?= base_url('assets/static-image/bed.jpeg') ?>" alt="">
                                                            <h6 class="tite" style="text-align: center; font-size:12px">Tersedia  (Kosong)</h6>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php elseif ($b->sts_bed == 1): ?>
                                    <div class="col-sm-5">
                                        <div class="row">
                                            <div class="col-sm-5" style="margin-left: 0px; margin-right: -31px;">
                                                <div class="item" style="box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.33); height: 90px; background: #f65c63 !important; border-radius: 0px !important; border: 1px solid #1e19197a !important">
                                                    <div class="item">
                                                        <div class="content-part">
                                                            <h6 class="tite" style="text-align: center; margin-top: 19px !important;">No. BED</h6>
                                                            <h2 class="tite" style="text-align: center; margin-top: -28px !important;"><?= $b->no_bed?></h2>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-7" style="margin-right: -0px;">
                                                <div class="item" style="box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.33); height: 90px;  border-radius: 0px !important; border: 1px solid #1e19197a !important">
                                                    <div class="item">
                                                        <div class="content-part">
                                                            <img class="icon-img center" style="margin-top: 0px !important;" width="60px !importantl"  src="<?= base_url('assets/static-image/bed.jpeg') ?>" alt="">
                                                            <h6 class="tite" style="text-align: center; font-size:12px">Ada Pasien</h6>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php elseif ($sts_bed == 2) :?>
                                    <div class="col-sm-5">
                                        <div class="row">
                                            <div class="col-sm-5" style="margin-left: 0px; margin-right: -31px;">
                                                <div class="item" style="box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.33); height: 90px; background: #fdec7b !important; border-radius: 0px !important; border: 1px solid #1e19197a !important">
                                                    <div class="item">
                                                        <div class="content-part">
                                                            <h6 class="tite" style="text-align: center; margin-top: 19px !important;">No. BED</h6>
                                                            <h2 class="tite" style="text-align: center; margin-top: -28px !important;"><?= $b->no_bed?></h2>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-7" style="margin-right: -0px;">
                                                <div class="item" style="box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.33); height: 90px;  border-radius: 0px !important; border: 1px solid #1e19197a !important">
                                                    <div class="item">
                                                        <div class="content-part">
                                                            <img class="icon-img center" style="margin-top: 0px !important;" width="60px !importantl"  src="<?= base_url('assets/static-image/bed.jpeg') ?>" alt="">
                                                            <h6 class="tite" style="text-align: center; font-size:12px">Sedang Dibersihkan</h6>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            <?php else :?>
                                <div class="col-sm-5">
                                    <div class="row">
                                        <div class="col-sm-5" style="margin-left: 0px; margin-right: -31px;">
                                            <div class="item" style="box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.33); height: 90px; background: #828282 !important; border-radius: 0px !important; border: 1px solid #1e19197a !important">
                                                <div class="item">
                                                    <div class="content-part">
                                                        <h6 class="tite" style="text-align: center; margin-top: 19px !important;">No. BED</h6>
                                                        <h2 class="tite" style="text-align: center; margin-top: -28px !important;"><?= $b->no_bed?></h2>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-7" style="margin-right: -0px;">
                                            <div class="item" style="box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.33); height: 90px;  border-radius: 0px !important; border: 1px solid #1e19197a !important">
                                                <div class="item">
                                                    <div class="content-part">
                                                        <img class="icon-img center" style="margin-top: 0px !important;" width="60px !importantl"  src="<?= base_url('assets/static-image/bed.jpeg') ?>" alt="">
                                                        <h6 class="tite" style="text-align: center; font-size:12px">Rusak</h6>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                        <?php endif; ?>
                        <br>
                    <?php $no ++; endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>