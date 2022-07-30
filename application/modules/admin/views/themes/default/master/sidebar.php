<div class="app-body">
	<div class="sidebar">
		<nav class="sidebar-nav">
			<ul class="nav">
				<li class="nav-title">
					Navigation
				</li>

				<li class="nav-item">
					<a class="nav-link" href="<?= site_url('admin') ?>"><i class="fa fa-dashboard"></i> Dashboard</a>
				</li>
				<li class="nav-item nav-dropdown">
					<a class="nav-link nav-dropdown-toggle" href="#"><i class="fa fa-pencil"></i> Postingan</a>
					<ul class="nav-dropdown-items">
						<li class="nav-item">
							<a class="nav-link" href="<?= site_url('admin/post/all') ?>"><i class="fa fa-arrow-right"></i> Semua Postingan</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="<?= site_url('admin/post/create') ?>"><i class="fa fa-arrow-right"></i> Tambah Postingan</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="<?= site_url('admin/post/category') ?>"><i class="fa fa-arrow-right"></i> Kategori</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="<?= site_url('admin/post/tag') ?>"><i class="fa fa-arrow-right"></i> Tag</a>
						</li>
					</ul>
				</li>

				<li class="nav-item nav-dropdown">
					<a class="nav-link nav-dropdown-toggle" href="#"><i class="fa fa-clone"></i> Halaman</a>
					<ul class="nav-dropdown-items">
						<li class="nav-item">
							<a class="nav-link" href="<?= site_url('admin/page/all') ?>"><i class="fa fa-arrow-right"></i> Semua Halaman</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="<?= site_url('admin/page/create') ?>"><i class="fa fa-arrow-right"></i> Tambah Halaman</a>
						</li>
					</ul>
				</li>

				<li class="nav-item nav-dropdown">
					<a class="nav-link nav-dropdown-toggle" href="#"><i class="fa fa-info"></i> Pengumuman</a>
					<ul class="nav-dropdown-items">
						<li class="nav-item">
							<a class="nav-link" href="<?= site_url('admin/pengumuman/all') ?>"><i class="fa fa-arrow-right"></i> Semua Pengumuman</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="<?= site_url('admin/pengumuman/create') ?>"><i class="fa fa-arrow-right"></i> Tambah Pengumuman</a>
						</li>
					</ul>
				</li>

				<li class="nav-item nav-dropdown">
					<a class="nav-link nav-dropdown-toggle" href="#"><i class="fa fa-server"></i> Fasilitas/Layanan</a>
					<ul class="nav-dropdown-items">
						<li class="nav-item">
							<a class="nav-link" href="<?= site_url('admin/service/all') ?>"><i class="fa fa-arrow-right"></i> Semua Fasilitas/Layanan</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="<?= site_url('admin/service/create') ?>"><i class="fa fa-arrow-right"></i> Tambah Baru</a>
						</li>
					</ul>
				</li>

				<li class="nav-item nav-dropdown">
					<a class="nav-link nav-dropdown-toggle" href="#"><i class="fa fa-list-alt"></i> Kegiatan</a>
					<ul class="nav-dropdown-items">
						<li class="nav-item">
							<a class="nav-link" href="<?= site_url('admin/event/all') ?>"><i class="fa fa-arrow-right"></i> Semua Kegiatan</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="<?= site_url('admin/event/create') ?>"><i class="fa fa-arrow-right"></i> Tambah Baru</a>
						</li>
					</ul>
				</li>

				<li class="nav-item nav-dropdown">
					<a class="nav-link nav-dropdown-toggle" href="#"><i class="fa fa-image"></i> Slides</a>
					<ul class="nav-dropdown-items">
						<li class="nav-item">
							<a class="nav-link" href="<?= site_url('admin/slide/all') ?>"><i class="fa fa-arrow-right"></i> Semua Slide</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="<?= site_url('admin/slide/create') ?>"><i class="fa fa-arrow-right"></i> Tambah Baru</a>
						</li>
					</ul>
				</li>

				<li class="nav-item nav-dropdown">
					<a class="nav-link nav-dropdown-toggle" href="#"><i class="fa fa-dedent"></i> Testimoni</a>
					<ul class="nav-dropdown-items">
						<li class="nav-item">
							<a class="nav-link" href="<?= site_url('admin/testimoni/all') ?>"><i class="fa fa-arrow-right"></i> Semua Testimoni</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="<?= site_url('admin/testimoni/create') ?>"><i class="fa fa-arrow-right"></i> Tambah Testimoni</a>
						</li>
					</ul>
				</li>

				<li class="nav-item nav-dropdown">
					<a class="nav-link nav-dropdown-toggle" href="#"><i class="fa fa-stethoscope"></i> Spesialis</a>
					<ul class="nav-dropdown-items">
						<li class="nav-item">
							<a class="nav-link" href="<?= site_url('admin/spesialis/all') ?>"><i class="fa fa-arrow-right"></i> Semua Spesialis</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="<?= site_url('admin/spesialis/create') ?>"><i class="fa fa-arrow-right"></i> Tambah Spesialis</a>
						</li>
					</ul>
				</li>

				<li class="nav-item nav-dropdown">
					<a class="nav-link nav-dropdown-toggle" href="#"><i class="fa fa-file-image-o"></i> Banner</a>
					<ul class="nav-dropdown-items">
						<li class="nav-item">
							<a class="nav-link" href="<?= site_url('admin/banner/all') ?>"><i class="fa fa-arrow-right"></i> Semua Banner</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="<?= site_url('admin/banner/create') ?>"><i class="fa fa-arrow-right"></i> Tambah Banner</a>
						</li>
					</ul>
				</li>

				<li class="nav-item nav-dropdown">
					<a class="nav-link nav-dropdown-toggle" href="#"><i class="fa fa-users"></i> Partner</a>
					<ul class="nav-dropdown-items">
						<li class="nav-item">
							<a class="nav-link" href="<?= site_url('admin/partner/all') ?>"><i class="fa fa-arrow-right"></i> Semua Parnert</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="<?= site_url('admin/partner/create') ?>"><i class="fa fa-arrow-right"></i> Tambah Partner</a>
						</li>
					</ul>
				</li>

				<li class="nav-item nav-dropdown">
					<a class="nav-link nav-dropdown-toggle" href="#"><i class="fa fa-film"></i> Media</a>
					<ul class="nav-dropdown-items">
						<li class="nav-item">
							<a class="nav-link" href="<?= site_url('admin/media/gallery') ?>"><i class="fa fa-arrow-right"></i> Gallery</a>
						</li>
					</ul>
				</li>
				<?php if ($this->session->user->level == 0) : ?>

					<li class="nav-item nav-dropdown">
						<a class="nav-link nav-dropdown-toggle" href="#"><i class="fa fa-tasks"></i> Appearance</a>
						<ul class="nav-dropdown-items">
							<li class="nav-item">
								<a class="nav-link" href="<?= site_url('admin/appearance/menu') ?>"><i class="fa fa-arrow-right"></i> Menu</a>
							</li>
						</ul>
					</li>
					<li class="nav-item nav-dropdown">
						<a class="nav-link nav-dropdown-toggle" href="#"><i class="fa fa-user"></i> Pengguna</a>
						<ul class="nav-dropdown-items">
							<li class="nav-item">
								<a class="nav-link" href="<?= site_url('admin/user/all') ?>"><i class="fa fa-arrow-right"></i> Semua Pengguna</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="<?= site_url('admin/user/create') ?>"><i class="fa fa-arrow-right"></i> Tambah Pengguna</a>
							</li>
						</ul>
					</li>
					<li class="nav-item nav-dropdown">
						<a class="nav-link nav-dropdown-toggle" href="#"><i class="fa fa-cog"></i> Pengaturan</a>
						<ul class="nav-dropdown-items">
							<li class="nav-item">
								<a class="nav-link" href="<?= site_url('admin/setting/general') ?>"><i class="fa fa-arrow-right"></i> Umum</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="<?= site_url('admin/setting/socialmedia') ?>"><i class="fa fa-arrow-right"></i> Media Sosial</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="<?= site_url('admin/setting/link') ?>"><i class="fa fa-arrow-right"></i> Link Terkait</a>
							</li>
						</ul>
					</li>
				<?php endif; ?>
			</ul>
		</nav>
		<button class="sidebar-minimizer brand-minimizer" type="button"></button>
	</div>