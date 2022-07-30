<div class="rs-our-services-part part2 pt-130 pb-127 md-pt-80 md-pb-60 bg8">
	<div class="container">
		<div class="sec-title text-center pb-50 md-pb-30">
			<div class="desc">
				DAFTAR FASILITAS
			</div>
			<h2 class="title pb-15">LAYANAN YANG KAMI SEDIAKAN</h2>
		</div>

		<div class="rs-carousel owl-carousel" 
			data-loop="true" data-items="4" 
			data-margin="30" data-autoplay="true" 
			data-autoplay-timeout="7000" data-smart-speed="800" 
			data-dots="true" data-nav="false" data-nav-speed="false" 
			data-center-mode="false" data-mobile-device="1" 
			data-mobile-device-nav="false" data-mobile-device-dots="false" 
			data-ipad-device="2" data-ipad-device-nav="false" data-ipad-device-dots="false" 
			data-ipad-device2="1" data-ipad-device-nav2="false" 
			data-ipad-device-dots2="false" data-md-device="4" data-md-device-nav="false" data-md-device-dots="true">
			<?php foreach ($services as $service) : ?>
				<div class="item">
					<div class="item-services">
						<div class="img-part">
							<img style="height: 170px;" src="<?= img_ori($service->img) ?>" alt="">
						</div>
						<div class="services-desc" style="height: 124px !important;">
							<h4 class="title-upper"><a href="<?= site_url('detail/' . $service->slug) ?>"><?= substr(strip_tags($service->title), 0, 23); ?></a></h4>
						</div>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</div>
