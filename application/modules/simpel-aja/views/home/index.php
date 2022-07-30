<style>
	.small-box.bg-blue {
		background-color: white !important;
		color: #0097a7 !important;
		border-left: 7px solid #0097a7;
	}
	a.small-box-footer {
		/* background: rgba(255,255,255,0.8) !important; */
		color: #0097a7 !important;
	}
	.portlet.light {
		padding: 12px 20px 15px;
		background-color: #fff;
	}

	.portlet.light>.portlet-title {
		padding: 0;
		min-height: 48px;
	}
	.portlet>.portlet-title {
		border-bottom: 1px solid #eee;
	}
	.portlet-title {
		margin-left: 10px;
		margin-top: 12px;
		margin-bottom: -11px;
	}

</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
            Dashboard
		</h1>
	</section>
	<!-- Main content -->
	
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="row">
					<div class="box-body inner">
						<div class="alert alert-success alert-dismissible" role="alert">
							<button style="color: #fff; opacity: 1;" type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<h4 style="margin-top: 0px;"><?= @$profilRs->rs_nama ?></h4>
							<p>Hai, <b><?= @$user->nama_lengkap ?></b> Bagaimana kesehatannya hari ini?</p>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<div class="box box-danger" style="min-height: 400px;">
							<div class="portlet-title">
								<div class="caption font-red">
									<span class="caption-subject bold uppercase" style="color:#0097a7; font-size:17px;">
											<b>BIODATA</b>
									</span>
									<span class="caption-helper">Pasien</span>
								</div>
							</div>
							<hr>
							<div class="box-body">
								<div class="info-pasien">
									<div class="row">
										<div class="col-md-4">
											<center>
												<?php if($user->id_jk == '1') :?>
													<img style="max-width: 75%; margin-top: 10px;" class="img-responsive" src="<?= base_url('assets/static-image/user.png') ?>" alt="User profile picture">
												<?php else: ?>
													<img style="max-width: 75%; margin-top: 10px;" class="img-responsive" src="<?= base_url('assets/static-image/user-female.png') ?>" alt="User profile picture">
												<?php endif; ?>
											</center>
										</div>
										<?php $jk = (@$user->id_jk == 1) ? 'Laki-laki' : 'Perempuan'; ?>
										<div class="col-md-6 biodata">
											<h3 style="font-weight: bold"><?= @$user->nama_lengkap ?></h3>
											<p style="font-weight: bold"><span><?= @$jk ?></span>, Lahir Tanggal : <span><?= @$user->tgl_lhr ?></span></p>
											<p>Email: <span><?= @$user->email ?></span>, No Hp: <span><?= @$user->no_hp ?></span></p>
											<p>Alamat: <span><?= @$user->alamat ?></span></p>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="box box-danger" style="min-height: 400px;">
							<div class="portlet-title">
								<div class="caption font-red">
									<span class="caption-subject bold uppercase" style="color:#ce4143; font-size:17px;">
											<b>RIWAYAT</b>
									</span>
									<span class="caption-helper">Kunjungan</span>
								</div>
							</div>
							<hr>
							<div class="box-body box-profile">
								<?php if(!empty($riwayat)) :?>
									<ul class="timeline timeline-inverse">
										<?php foreach ($riwayat as $r) :?>
										<li>
											<i class="fa fa-history bg-aqua"></i>
											<div class="timeline-item">
												<span class="time"><i class="fa fa-clock-o"></i> <?= date('d/m/Y', strtotime(@$r->tgl_berobat)) ?></span>
												<h3 class="timeline-header no-border"><?= @$r->nama_ruangan?></h3>
											</div>
										</li>
										<?php endforeach; ?>
									</ul>
								<?php else: ?>
									<ul class="timeline timeline-inverse">
										<li>
											<i class="fa fa-history bg-danger" style="background:#ce4143; color:white;"></i>
											<div class="timeline-item text-center">
												<h5>Belum ada Riwayat Kunjungan</h5>
											</div>
										</li>
									</ul>
								<?php endif; ?>
							</div>
						</div>
					</div>

				</div>
			</div>
		</div>
	</section>
	<!-- /.content -->
</div>