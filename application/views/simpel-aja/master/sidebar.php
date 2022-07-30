<?php
$data['user'] = json_decode($_COOKIE['user']);
$config = json_decode($_COOKIE['config']);
?>
<aside class="main-sidebar">
  <section class="sidebar">
    <div class="user-panel">
      <div class="pull-left image">
        <?php if ($user->id_jk == '1') : ?>
          <img src="<?= base_url('assets/static-image/user.png') ?>" class="img-circle" alt="User Image">
        <?php else : ?>
          <img src="<?= base_url('assets/static-image/user-female.png') ?>" class="img-circle" alt="User Image">
        <?php endif; ?>
      </div>

      <div class="pull-left info">
        <p><?= @$user->nama_lengkap ?></p>
        <a href="#"><i class="fa fa-circle" style="color:green;"></i> Online</a>
      </div>
    </div>
    <ul class="sidebar-menu" data-widget="tree">
      <li class="header">MAIN NAVIGATION</li>
      <li class="nav-item <?php echo ($this->uri->segment(2) == 'home' ? 'active open' : ''); ?>">
        <a class="nav-link" href="<?php echo site_url('simpel-aja/home'); ?>">
          <i class="fa fa-dashboard"></i> <span class="title">Beranda</span>
        </a>
      </li>
      <li class="nav-item <?php echo ($this->uri->segment(2) == 'pendaftaran' ? 'active open' : ''); ?>">
        <a class="nav-link" href="<?php echo site_url('simpel-aja/pendaftaran'); ?>">
          <i class="fa fa-calendar-o"></i> <span class="title">Daftar Berobat</span>
        </a>
      </li>
      <li class="nav-item <?php echo ($this->uri->segment(2) == 'kehadiran' ? 'active open' : ''); ?>">
        <a class="nav-link" href="<?php echo site_url('simpel-aja/kehadiran'); ?>">
          <i class="fa fa-calendar-o"></i><span class="title">Konfirmasi Kehadiran</span>
        </a>
      </li>
      <li class="nav-item <?php echo ($this->uri->segment(2) == 'antrian' ? 'active open' : ''); ?>">
        <a class="nav-link" href="<?php echo site_url('simpel-aja/antrian'); ?>">
          <i class="fa fa-users"></i><span class="title">Cek Antrian</span>
        </a>
      </li>
      <li class="nav-item <?php echo ($this->uri->segment(2) == 'riwayat' ? 'active open' : ''); ?>">
        <a class="nav-link" href="<?php echo site_url('simpel-aja/riwayat'); ?>">
          <i class="fa fa-calendar-times-o"></i><span class="title">Riwayat Berobat</span>
        </a>
      </li>
      <li class="nav-item <?php echo ($this->uri->segment(2) == 'poli' ? 'active open' : ''); ?>">
        <a class="nav-link" href="<?php echo site_url('simpel-aja/poli'); ?>">
          <i class="fa fa-medkit"></i><span class="title">Info Poliklinik</span>
        </a>
      </li>
      <li class="nav-item <?php echo ($this->uri->segment(2) == 'dokter' ? 'active open' : ''); ?>">
        <a class="nav-link" href="<?php echo site_url('simpel-aja/dokter'); ?>">
          <i class="fa fa-user-md"></i><span class="title">Info Dokter</span>
        </a>
      </li>
      <?php if ($config->is_rumkit == '1') : ?>
        <li class="nav-item <?php echo ($this->uri->segment(2) == 'kamar' ? 'active open' : ''); ?>">
          <a class="nav-link" href="<?php echo site_url('simpel-aja/kamar'); ?>">
            <i class="fa fa-bed"></i><span class="title">Info Kamar</span>
          </a>
        </li>
      <?php endif; ?>
      <li class="nav-item <?php echo ($this->uri->segment(2) == 'profil' ? 'active open' : ''); ?>">
        <a class="nav-link" href="<?php echo site_url('simpel-aja/profil'); ?>">
          <i class="fa fa-user"></i><span class="title">Biodata</span>
        </a>
      </li>
      <li>
        <a href="<?= site_url('pendaftaran/login/logout') ?>">
          <i class="fa fa-sign-out"></i> <span>Logout</span></a>
      </li>
    </ul>
  </section>
</aside>