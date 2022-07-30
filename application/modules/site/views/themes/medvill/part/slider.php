<div class="rs-slider home4slider">
    <div class="rs-carousel owl-carousel" 
        data-loop="true" 
        data-items="3" 
        data-margin="30" 
        data-autoplay="true" 
        data-autoplay-timeout="7000" 
        data-smart-speed="800" data-dots="false" 
        data-nav="false" data-nav-speed="false" 
        data-center-mode="false" data-mobile-device="1" 
        data-mobile-device-nav="false" data-mobile-device-dots="false" 
        data-ipad-device="1" data-ipad-device-nav="false" data-ipad-device-dots="false" 
        data-ipad-device2="1" data-ipad-device-nav2="false" 
        data-ipad-device-dots2="false" data-md-device="1" 
        data-md-device-nav="false" 
        data-md-device-dots="false"
        >
        <?php foreach ($slides as $slide) : ?>
            <div class="item">
                <div class="single-slide slide1" 
                    style=" 
                    width: 100%;
                    background-size: 100% 100%;
                    background-image:url(<?= base_url('assets/uploads/' . $slide->guid) ?>); ">
                    <div class="container">
                        <div class="desc-part">
                            <h3 style="color: #<?= $slide->text1_color ?>"><?= $slide->title ?></h3>
                            <h4 style="color: #<?= $slide->text2_color ?>"><?= $slide->content ?></h4>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>