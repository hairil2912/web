<style>
    .pb-130 {
        padding-bottom: -59px !important;
    }
</style>
<?php foreach ($banners as $banner) : ?>
    <!-- <div class="rs-medvill-medical-part" style="padding-top: 120px; padding-bottom: 100px; height: 550px; background-image:url(<?= base_url('assets/uploads/' . @$banner->guid) ?>)"> -->
    <div class="rs-medvill-medical-part" 
    style="
    padding-top: 144px; 
    padding-bottom: 100px; 
    width: 100%;
    height: 400px;
    background-size: 100% 100%;
    background-image:url(<?= base_url('assets/uploads/' . @$banner->guid) ?>)">
        <div class="container">
            <div class="row rs-vertical-middle">
                <div class="col-lg-5">
                </div>
                <div class="col-lg-7">
                    <div class="rs-services-part">
                        <span class="Title">Sambutan Direktur</span>
                        <div class="content-part">
                            <h3 class="best-part pb-25 md-pb-15">Selamat Datang Di <?= get_site_setting('site_name') ?></h3>
                            <div class="desc-part pb-15">
                                <?= @$banner->content ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>