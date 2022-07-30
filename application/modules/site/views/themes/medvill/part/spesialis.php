<style>
    .item-services {
        height: 100%;
    }
</style>
<!--rs-quality-services-part start-->
<div class="rs-quality-services-part">
    <div class="container">
        <div class="sec-title text-center pb-90">
            <div class="desc">
                KAMI MEMILIKI BEBERAPA SPESIALIS
            </div>
            <h2 class="title pb-15">SPESIALIS YANG TERSEDIA</h2>
        </div>
        <div class="row">
            <?php $chunck_spesialis = array_chunk($spesialis, 3); ?>
            <?php if (isset($chunck_spesialis[0])) : ?>
                <?php foreach ($chunck_spesialis[0] as $s) : ?>
                    <div class="col-lg-4 mb-78 col-md-6">
                        <div class="item-services">
                            <div class="item">
                                <div class="icon-part">
                                    <img src="<?= base_url('assets/uploads/' . $s->img) ?>" alt="">
                                </div>
                                <div class="content-part">
                                    <h3 class="title"><a href="<?= site_url('detail/' . $s->slug) ?>"><?= $s->title ?></a></h3>
                                    <p class="desc-part">
                                        <?= substr(strip_tags($s->content), 0, 50) ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
            <?php if (isset($chunck_spesialis[1])) : ?>
                <?php foreach ($chunck_spesialis[1] as $s) : ?>
                    <div class="col-lg-4 mb-78 col-md-6">
                        <div class="item-services">
                            <div class="item">
                                <div class="icon-part">
                                    <img src="<?= base_url('assets/uploads/' . $s->img) ?>" alt="">
                                </div>
                                <div class="content-part">
                                    <h3 class="title"><a href="<?= site_url('detail/' . $s->slug) ?>"><?= $s->title ?></a></h3>
                                    <p class="desc-part">
                                        <?= substr(strip_tags($s->content), 0, 50) ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
            <?php if (isset($chunck_spesialis[2])) : ?>
                <?php foreach ($chunck_spesialis[2] as $s) : ?>
                    <div class="col-lg-4 mb-78 col-md-6">
                        <div class="item-services">
                            <div class="item">
                                <div class="icon-part">
                                    <img src="<?= base_url('assets/uploads/' . $s->img) ?>" alt="">
                                </div>
                                <div class="content-part">
                                    <h3 class="title"><a href="<?= site_url('detail/' . $s->slug) ?>"><?= $s->title ?></a></h3>
                                    <p class="desc-part">
                                        <?= substr(strip_tags($s->content), 0, 50) ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</div>
<!--rs-quality-services-part end-->