<style>
	.rs-our-qualified-doctor .item .team-inner:hover .normal-text .person-name a, .rs-our-qualified-doctor .item .team-inner:hover .normal-text .designation, .rs-our-qualified-doctor .item .team-inner:hover .normal-text .social-icon li i {
		color: black !important;
	}
</style>
<?php if ($dokters != null) :?>
	<div class="rs-our-qualified-doctor sec-bg pt-122 pb-100 md-pb-55 md-pt-50">
		<div class="container">
			<div class="sec-title text-center pb-20 md-pb-0">
				<h5 class="title-small3 secondary-color">BERIKUT ADALAH DATA</h5>
				<h3 class="title-small2 secondary-color">DOKTER PROFESIONAL KAMI</h3>
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
				data-ipad-device2="2" 
				data-ipad-device-nav2="false" 
				data-ipad-device-dots2="false" 
				data-md-device="4" 
				data-md-device-nav="false" 
				data-md-device-dots="false">
				<?php foreach (@$dokters as $dokter) : ?>
					<div class="item" >
						<div class="team-inner" style="height: 455px">
							<div class="images-part">
								<?php if(is_null(@$dokter->foto)) :?>
									<?php if ($dokter->id_jk == 1) :?>
										<img style="height: 250px" src="<?= base_url('assets/static-image/male_dokter.jpg'); ?>"alt="">
									<?php else :?>
										<img style="height: 250px" src="<?= base_url('assets/static-image/female_dokter.jpg'); ?>"alt="">
									<?php endif; ?>
								<?php else: ?>
									<img style="height: 250px" src="<?= $ip ?><?= @$dokter->foto ?>" alt="">
								<?php endif; ?>
							</div>
							<div class="normal-text text-center">
								<span class="person-name" style="font-size: 14px;"><?= @$dokter->nama_dokter ?></a></span>
								<span class="designation" style="font-size: 13px; color:black"><?= @$dokter->nama_prodi ?></span>
								<div class="social-icon mb-10">
									<ul>
										<li style="color:black;"><i class="fa fa-facebook"></i></li>
										<li style="color:black;"><i class="fa fa-google-plus"></i></li>
										<li style="color:black;"><i class="fa fa-twitter"></i></li>
										<li style="color:black;"><i class="fa fa-linkedin"></i></li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
<?php endif; ?>