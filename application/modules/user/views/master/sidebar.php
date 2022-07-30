<!-- Left Sidebar  -->
<div class="left-sidebar">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <li class="nav-devider"></li>
                <li class="nav-label">Navigasi</li>
                <li> <a href="<?= site_url('user/home') ?>" aria-expanded="false"><i class="fa fa-tachometer"></i><span class="hide-menu">Beranda <span class="label label-rouded label-primary pull-right">2</span></span></a>
                    
                </li>
                <li> <a href="<?= site_url('user/pendaftaran') ?>" aria-expanded="false"><i class="fa fa-envelope"></i><span class="hide-menu">Pendaftaran Berobat</span></a>
                   
                </li>
                <li> <a class="has-arrow  " href="#" aria-expanded="false"><i class="fa fa-bar-chart"></i><span class="hide-menu">Info Antrian</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="<?= site_url('user/antrian/loket'); ?>">Antrian Loket</a></li>
                        <li><a href="<?= site_url('user/antrian/poli'); ?>">Antrian Poli</a></li>
                        <li><a href="<?= site_url('user/antrian/apotik'); ?>">Antrian Apotik</a></li>
                    </ul>
                </li>
                <li> <a class="has-arrow  " href="#" aria-expanded="false"><i class="fa fa-suitcase"></i><span class="hide-menu">Riwayat <span class="label label-rouded label-warning pull-right">6</span></span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="<?= site_url('user/riwayat/kunjungan'); ?>">Riwayat Kunjungan</a></li>
                        <li><a href="<?= site_url('user/riwayat/diagnosa') ?>">Riwayat Diagnosa</a></li>
                        <li><a href="<?= site_url('user/riwayat/obat'); ?>">Riwayat Obat</a></li>
                    </ul>
                </li>
				<li> <a href="<?= site_url('user/lapor'); ?>" aria-expanded="false"><i class="fa fa-suitcase"></i><span class="hide-menu">Lapor Masalah <span class="label label-rouded label-danger pull-right">6</span></span></a>
                    
                </li>
                <li> <a href="<?= site_url('user/logout') ?>" aria-expanded="false"><i class="fa fa-map-marker"></i><span class="hide-menu">Keluar</span></a>
                    
                </li>
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</div>
<!-- End Left Sidebar  -->