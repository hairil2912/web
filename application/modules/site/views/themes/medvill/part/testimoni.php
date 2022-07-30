<!-- rs-our-patients-part3 start-->
<div class="rs-our-patients-part3 part4 pt-125 pb-125 md-pt-50 md-pb-80">
    <div class="container">
        <div class="sec-title text-center pb-50 md-pb-25">
            <h3 class="title-small2 secondary-color">TESTMONI</h3>
        </div>
        <div class="rs-carousel owl-carousel" 
            data-loop="true" data-items="4" 
            data-margin="30" data-autoplay="false" 
            data-autoplay-timeout="7000" 
            data-smart-speed="800" 
            data-dots="false" 
            data-nav="false" 
            data-nav-speed="false" 
            data-center-mode="false" 
            data-mobile-device="1" 
            data-mobile-device-nav="false" 
            data-mobile-device-dots="false" 
            data-ipad-device="2" 
            data-ipad-device-nav="false" 
            data-ipad-device-dots="false" 
            data-ipad-device2="1" 
            data-ipad-device-nav2="false" 
            data-ipad-device-dots2="false" 
            data-md-device="4" 
            data-md-device-nav="false" 
            data-md-device-dots="true">
            <?php foreach ($testimonials as $testimoni) : ?>
                <div class="item" style="height: 400px;">
                    <div class="img-part text-center">
                        <?php if (empty($testimoni->img)) : ?>
                            <img src="<?= site_url('assets/static-image/user.png') ?>" alt="">
                        <?php else : ?>
                            <img src="<?= site_url('assets/uploads/' . $testimoni->img) ?>" alt="">
                        <?php endif; ?>
                    </div>
                    <div class="content-part">
                        <div class="desc-part">
                            <p><?= $testimoni->content ?></p>
                        </div>
                        <div class="cl-author text-center">
                            <ul>
                                <li class="name"><?= $testimoni->title ?></li>
                            </ul>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <br>
        <div class="col-lg-12 text-center mt-50">
            <h3 style="text-transform: capitalize;"><strong class="color-blue">Apa</strong> kata mereka? <a style="font-size: 10px;font-weight: normal;" href="#" id="isi_testimoni">Isi Testimoni</a></h3>
        </div>

    </div>
</div>
<!--rs-our-patients-part3 end -->