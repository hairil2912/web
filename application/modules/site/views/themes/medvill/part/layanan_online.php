<style>
    .serviecs-item-part {
        height: 282px;
    }

    .rs-icon-slider-part.part3 .rs-services-wrap .serviecs-item-part .services-desc {
        padding-left: 90px !important;
    }

    .rs-icon-slider-part.part3.style2 .rs-services-wrap .serviecs-item-part .services-desc {
        padding-left: 0px !important;
    }

    .rs-icon-slider-part.part3.style2 .rs-services-wrap .serviecs-item-part .icon-part img {
        width: 55px;
        margin-top: -10px !important;
    }
</style>
<div class="rs-icon-slider-part part3 style2">
    <div class="container">
        <div class="row no-gutters">
            <div class="col-lg-3  md-mb-30">
                <div class="rs-services-wrap">
                    <div class="serviecs-item-part">
                        <div class="services-desc">
                            <div class="icon-part">
                                <img src="<?= base_url('assets/newsite/images/services/home-7/icon/h7-1.png') ?>" alt="">
                            </div>
                            <h3 class="title-part">
                                <a target="_blank" href="<?= site_url('pendaftaran/login'); ?>">DAFTAR BEROBAT</a>
                            </h3>
                            <br>
                            <?php if ($ip == 'http://103.141.148.136/') : ?>
                                <p class="dese-part">
                                    <b>SIMPEL AJA</b> Sistem Pendaftaran Online Rawat Jalan.
                                </p>
                            <?php else : ?>
                                <p class="dese-part">
                                    <b>KLIK PASIEN</b> Sistem Layanan Pendaftaran Berobat Rawat Jalan.
                                </p>
                            <?php endif; ?>
                            <a class="link" target="_blank" href="<?= site_url('pendaftaran/login'); ?>"><b>Klik Disini !</b></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 md-mb-30">
                <div class="rs-services-wrap">
                    <div class="serviecs-item-part">
                        <div class="services-desc">
                            <div class="icon-part">
                                <img height="500" src="<?= base_url('assets/newsite/images/services/home-7/icon/mesin_antrian.png') ?>" alt="">
                            </div>
                            <h3 class="title-part">
                                <a target="_blank" href="<?= site_url('antrian') ?>">CEK ATRIAN</a>
                            </h3>
                            <br>
                            <p class="dese-part">Mau lihat antrian pasien berobat menurut Dokter/Poli ?</p>
                            <a class="link" target="_blank" href="<?= site_url('antrian'); ?>"><b>Klik Disini !</b></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 md-mb-30">
                <div class="rs-services-wrap">
                    <div class="serviecs-item-part">

                        <div class="services-desc">
                            <div class="icon-part">
                                <img src="<?= base_url('assets/newsite/images/services/home-7/icon/h7-3.png') ?>" alt="">
                            </div>
                            <h3 class="title-part">
                                <a target="_blank" href="<?= site_url('kamar') ?>"> CEK KAMAR</a>
                            </h3>
                            <br>
                            <p class="dese-part">Mau Cek Ketersediaan Tempat Tidur Rawat Inap ?</p>
                            <a class="link" target="_blank" href="<?= site_url('kamar'); ?>"><b>Klik Disni !</b></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3  md-mb-30">
                <div class="rs-services-wrap">
                    <div class="serviecs-item-part">

                        <div class="services-desc">
                            <div class="icon-part">
                                <img src="<?= base_url('assets/newsite/images/services/home-7/icon/h7-3.png') ?>" alt="">
                            </div>
                            <h3 class="title-part">
                                <a target="_blank" href="<?= site_url('poli') ?>"> CEK DOKTER</a>
                            </h3>
                            <br>
                            <p class="dese-part">Mau cek dokter atau status layanan Poliklinik ?</p>
                            <a class="link" target="_blank" href="<?= site_url('poli'); ?>"><b>Klik Disini !</b></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>