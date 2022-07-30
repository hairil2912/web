<style>
    .breadcrumbs-inner-part .breadcrumbs-inner-bread {
        padding: 65px 0 120px;
    }
</style>
<div class="breadcrumbs-inner-part img3">
    <div class="container">
        <div class="breadcrumbs-inner-bread text-center">
            <h1 class="title-part"><?= @$detail->nama_lengkap ?></h1>
        </div>
    </div>
</div>

<div class="rs-portfolio-Detail part3 pt-130 pb-130 md-pt-72 md-pb-80">
    <div class="container">
        <div class="row">
            
            <div class="col-lg-4 col-md-12">
                <div class="inner-images mb-40 md-mb-30" style="height: 95% !important;">
                    <?php if (is_null(@$detail->foto)) : ?>
                        <!-- <img src="<?= base_url('assets/static-image/dokter.jpg'); ?>" alt=""> -->
                        <?php if ($detail->id_jk == 1) :?>
                            <img  src="<?= base_url('assets/static-image/male_dokter.jpg'); ?>"alt="">
                        <?php else :?>
                            <img  src="<?= base_url('assets/static-image/female_dokter.jpg'); ?>"alt="">
                        <?php endif; ?>
                    <?php else : ?>
                        <img src="<?= @$ip; ?><?= $detail->foto ?>" alt="">
                    <?php endif; ?>
                    <div class="ps-informations">
                        <h2 class="single-title"><?= @$detail->nama_lengkap ?></h2>
                        <ul>
                            <li class="single-title2">
                                <span><i class="fa fa-user-md"> </i></span>
                                <b><?= @$detail->nama_prodi ?></b></li>
                            <li class="flaticon-part">
                                <span><i class="fa fa-envelope"> </i></span>
                                <a href="mailto:support@rstheme.com"><?= @$detail->email ?></a>
                            </li>
                            <li class="flaticon-part">
                                <span><i class="fa fa-phone"> </i></span>
                                <a href="tel:998877665544"><?= @$detail->no_hp ?></a>
                            </li>
                        </ul>
                    </div>
                    <div class="ps-information2">
                        <ul class="social-icon">
                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                            <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 pr-45 col-md-12 md-pl-15 md-pr-15">
                <div class="inner-images mb-40 md-mb-30" style="height: 95% !important;"> 
                    <div>
                        <span><h3><i class="fa  fa-calendar"></i> Jadwal Praktek</h3></span>
                    </div>
                    <table class="table table-bordered table-hovered table-striped"> 
                        <thead>
                            <tr>
                                <th>Hari</th>
                                <th>Jam</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($jadwal as $j) :?>
                                <?php if (@namahari(date('Y-m-d')) == $j->hari) :?>
                                    <tr>
                                        <td style="color:green; font-weight:bold;"><?= @$j->hari; ?></td>
                                        <td style="color:green; font-weight:bold;"><?= @$j->jam; ?> #hari ini</td>
                                    </tr>
                                    <?php else :?>
                                    <tr>
                                        <td><?= @$j->hari; ?></td>
                                        <td><?= @$j->jam; ?></td>
                                    </tr>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <div class="alert alert-success alert-dismissible" role="alert"> 
                        <h4 style="margin: 7px 0 5px !important; color: #ffffff;"><i class="fa fa-info"></i> Info</h4> 
                        <h6 style="color:#ffffff"><span style="font-size: 20px; font-weight:bold;"><u><?= @$jumlah->jml_pasien; ?></u></span> Pasien mendaftar hari ini..!!!</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>