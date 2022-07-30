<style>
    .rs-latest-part {
        background: #ffffff;
    }

    img.a {
        max-width: 100%;
        height: 170px;
    }
    .blog-full {
        height: 300px !important;
    }

    .owl-nav {
        display: none;
    }

</style>

<?php if  ($pengumuman != null) :?>
<div class="rs-slick-part take-up pt-130 pb-100">
    <div class="container">
        <div style="box-shadow: 0 5px 20px rgba(34, 34, 34, 0.1);" class="rs-carousel owl-carousel owl-loaded owl-drag" data-loop="true" data-items="4" data-margin="30"
            data-autoplay="true" data-autoplay-timeout="5000" data-smart-speed="800" data-dots="false" data-nav="true"
            data-nav-speed="false" data-center-mode="false" data-mobile-device="1" data-mobile-device-nav="true"
            data-mobile-device-dots="false" data-ipad-device="1" data-ipad-device-nav="true"
            data-ipad-device-dots="false" data-ipad-device2="1" data-ipad-device-nav2="true"
            data-ipad-device-dots2="false" data-md-device="1" data-md-device-nav="true" data-md-device-dots="false">
            <div class="owl-stage-outer">
                <div class="owl-stage" style="transform: translate3d(-4200px, 0px, 0px); transition: all 0.8s ease 0s; width: 11200px;">
                    <?php foreach ($pengumuman as $p) :?>
                        <div class="owl-item" style=" padding-top: 22px; padding-bottom: 0px; background: <?= '#', get_site_setting('color')?> !important; box-shadow: 0 5px 20px rgba(34, 34, 34, 0.1); width: 1370px; margin-right: 30px;">
                            <div class="item">
                                <div class="team-content-part text-center">
                                    <div class="img-part">
                                        <h5 class="title-part">
                                        <a style="color: black;" href="<?= site_url('detail/' . $p->slug) ?>"><?= $p->title ?>  <br>
                                        <button class="btn btn-success btn-xs"><a style="color: white;" href="<?= site_url('detail/' . $p->slug) ?>">Selengkapnya</a></button>
                                        </h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php endif ;?>
<!--rs-latest-part start-->
<div class="rs-latest-part  pb-100  md-pb-52">
    <div class="container">
        <div class="sec-title text-center pb-50 md-pb-25">
        <br><br>
            <h3 class="title-small2 secondary-color">BERITA TERBARU</h3>
        </div>
        <div class="rs-carousel owl-carousel" data-loop="true" 
        data-items="4" data-margin="30" 
        data-autoplay="true" 
        data-autoplay-timeout="7000" 
        data-smart-speed="800" 
        data-dots="false" data-nav="false" 
        data-nav-speed="false" 
        data-center-mode="false" 
        data-mobile-device="1" 
        data-mobile-device-nav="false" 
        data-mobile-device-dots="false" 
        data-ipad-device="2" data-ipad-device-nav="false" data-ipad-device-dots="false" 
        data-ipad-device2="1" data-ipad-device-nav2="false" data-ipad-device-dots2="false" 
        data-md-device="4" data-md-device-nav="false" data-md-device-dots="false">
            <?php foreach (latest_news(null) as $post) : ?>
                <div class="item">
                    <div class="blog-item">
                        <div class="img-part">
                            <img class="a" src="<?= img_ori($post->img) ?>" alt="">
                        </div>
                        <div class="blog-full">
                            <div class="blog-meta">
                                <h3 class="title"><a href="<?= site_url('detail/' . $post->slug) ?>"><?= substr(strip_tags($post->title), 0, 20) ?></a></h3>
                            </div>
                            <div class="blog-slider-meta">
                                <div class="blog-content mb-10">
                                    <span class="post-date">
                                        <i class="flaticon-clock"></i>
                                        <?= date('d', strtotime($post->created_on)) ?> <?= date('M', strtotime($post->created_on)) ?> <?= date('Y', strtotime($post->created_on ))?>
                                    </span>
                                    <span class="post-author">
                                        <i class="flaticon-user-1"></i>
                                        <?= $post->author ?>
                                    </span>
                                </div>
                                <div class="blog-desc" style="height: 170px !important">
                                    <p>
                                        <?= render_post_excerpt($post->content) ?>...
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
<br>
<!--rs-latest-part-part end-->