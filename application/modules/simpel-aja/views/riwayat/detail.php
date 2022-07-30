<div class="modal-dialog modal-35">
	<div class="modal-content">
		<div class="modal-header">
            <div class="pull-left">
                <h4 class="modal-title" id="myModalLabel"><i class="fa fa-info-circle" style="margin-right: 10px"></i> Detail</h4>
            </div>
            <div class="pull-right">
                <button type="button" class="btn btn-default" data-dismiss="modal">X</button>
            </div>
            <div class="clearfix"></div>
            <div class="pull-left">
                <h5><?= @$riwayat->nama_ruangan ?></h5>
            </div>
            <div class="pull-right">
                <h5><?= date('d/m/Y H:i', strtotime($riwayat->tgl_keluar ))?></h5>
                <h5>Cara Bayar : <?= @$riwayat->nama_asuransi ?></h5>
            </div>
		</div>
		<div class="modal-body" style="font-size: 12px !important">
			<div class="row">
                <div class="col-md-12">
                    <div class="col-md-4">
                        <div class="box-body box-profile">
                            <img class="profile-user-img img-responsive img-circle" src="<?= base_url('assets/static-image/user.png');?>" alt="User profile picture">
                        </div>
                    </div>
                    <div class="col-md-8">
                        <h4 style="font-weight: bold"><?= @$user->nama_lengkap ?></h4>
                        <h5 class="keluhan item-title">Keluhan: <?= @$riwayat->keluhan ?></h5>
                    </div>
                    <hr>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <table>
                        <h5 class="item-title">Detail Pemeriksaan</h5>
                        <tr>
                            <td>Tekanan Darah</td>
                            <td>:</td>
                            <td><?= @$riwayat->tekanan_darah ?></td>
                        </tr>
                        <tr>
                            <td>Denyut Nadi</td>
                            <td>:</td>
                            <td><?= @$riwayat->denyut_nadi ?></td>
                        </tr>
                        <tr>
                            <td>Pernafasan</td>
                            <td>:</td>
                            <td><?= @$riwayat->pernafasan ?></td>
                        </tr>
                        <tr>
                            <td>Suhu</td>
                            <td>:</td>
                            <td><?= @$riwayat->suhu ?></td>
                        </tr>
                    </table>
                    <div>
                        <h5 class="item-title">Alergi Obat</h5>
                        <p><?= @$riwayat->alergi_obat ?></p>
                    </div>
                    <div>
                        <h5 class="item-title">Pemeriksaan Fisik</h5>
                        <p><?= @$riwayat->pemeriksaan_fisik ?></p>
                    </div>
                    <div>
                        <h5 class="item-title">Diagnosa Primer</h5>
                        <p><?= @$diagnosa_primer->id_code ?> - <?= @$diagnosa_primer->ket_english ?></p>
                    </div>
                    <div>
                        <h5 class="item-title">Diagnosa Sekunder</h5>
                        <p><?= @$diagnosa_sekunder->sekunder ?></p>
                    </div>
                    <div>
                        <h5 class="item-title">Tindakan / Terapi</h5>
                        <p><?= @$rwt_tindakan->tindakan ?></p>
                    </div>
                    <div>
                        <h5 class="item-title">Detail Pemberian Obat</h5>
                    </div>
                    <div>
                        <table>
                            <?php $no = 1; foreach ($rwt_resep_racikan as $r) :?>
                            <tr>
                                <td>R/</td>
                                <td>Racikan <?= @$no; ?>: <?= $r->ket_racikan ?></td>
                                <td><?= $r->aturan_pakai ?></td>
                            </tr>
                            <?php $no++; endforeach; ?>
                        </table>
                        <table ble>
                            <?php foreach($rwt_resep as $k) :?>
                                <tr>
                                    <td>R/</td>
                                    <td><?= $k->nama_barang ?></td>
                                    <td><?= $k->qty ?> <?= $k->satuan ?></td>
                                    <td><?= $k->aturan_pakai ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </table>
                    </div>
                    <div>
                        <h5 class="item-title">Detail Pemeriksaan Penujang</h5>
                    </div>
                </div>
            </div>
		</div>
	</div>
</div>
