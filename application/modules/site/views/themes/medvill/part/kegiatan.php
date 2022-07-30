<!--rs-latest-part start-->
<div class="rs-latest-part pt-120 pb-100 md-pt-50 md-pb-52">
    <div class="container">
        <div class="sec-title text-center pb-50 md-pb-25">
            <h5 class="title-small3 secondary-color">INFORMASI</h5>
            <h3 class="title-small2 secondary-color">KEGIATAN RUMAH SAKIT</h3>
        </div>
        <div class="rs-carousel owl-carousel" 
            data-loop="true" data-items="4" 
            data-margin="30" 
            data-autoplay="true" 
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
            data-md-device-dots="false">
            <?php foreach ($events as $key => $post) : ?>
                <div class="item <?= $key === 2 ? 'last' : '' ?>">
                    <div class="blog-item">
                        <div class="img-part">
                            <img style="height: 165px;" src="<?= img_ori($post->img) ?>" alt="">
                        </div>
                        <div class="blog-full" style="height: 197px!important;">
                            <div class="blog-meta">
                                <h3 class="title"><a href="<?= site_url('detail/' . $post->slug) ?>"><?= substr(strip_tags($post->title), 0, 20); ?></a></h3>
                            </div>
                            <div class="blog-slider-meta">
                                <div class="blog-desc">
                                    <p>
                                        <?= substr(strip_tags($post->content), 0, 50); ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<!--rs-latest-part-part end-->