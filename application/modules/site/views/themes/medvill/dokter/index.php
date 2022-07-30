<style>
    .breadcrumbs-inner-part .breadcrumbs-inner-bread {
        padding: 65px 0 120px;
    }

    img.doc {
        max-width: 100%;
        height: 435px;
    }
</style>

<div class="breadcrumbs-inner-part img3">
    <div class="container">
        <div class="breadcrumbs-inner-bread text-center">
            <h1 class="title-part"> Dokter</h1>
        </div>
    </div>
</div>
<div class="rs-meet-with-doctor-part pt-130 pb-100 md-pt-80 md-pb-50">
    <div class="container">
        <div class="row">
            <?php foreach ($dokters as $dokter) :?>
                <div class="col-lg-4 col-md-6">
                    <div class="item">
                        <div class="team-inner">
                            <div class="img-part">
                                <?php if (is_null($dokter->foto)) : ?>
                                    <?php if ($dokter->id_jk == 1) :?>
                                        <img  class="doc" height="100%" width="100%" src="<?= base_url('assets/static-image/male_dokter.jpg'); ?>"alt="">
                                    <?php else :?>
                                        <img  class="doc" height="100%" width="100%" src="<?= base_url('assets/static-image/female_dokter.jpg'); ?>"alt="">
                                    <?php endif; ?>
                                <?php else : ?>
                                    <a href="#"><img class="doc" height="100%" width="100%" src="<?= @$ip ?><?= @$dokter->foto ?>" alt=""></a>
                                <?php endif; ?>
                                <div class="social-icon">
                                    <ul>
                                        <li>
                                            <a class="link" href="#"><i class="fa fa-facebook"></i></a>
                                            <a class="link" href="#"><i class="fa fa-google-plus"></i></a>
                                            <a class="link" href="#"><i class="fa fa-twitter"></i></a>
                                            <a class="link" href="#"><i class="fa fa-linkedin"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="team-content" style="height: 152px !important;">
                                <h3 class="team-name"><?= $dokter->nama_dokter ?></h3>							
                                <span class="team-title"><?= $dokter->nama_prodi ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach ;?>
        </div>
    </div>
</div>