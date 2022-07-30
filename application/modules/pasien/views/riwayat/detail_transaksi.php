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
		</div>
		<div class="modal-body" style="font-size: 12px !important">
			<div class="row">
            </div>
            <div class="row">
                <div class="col-md-12">
                    <table>
                        <h5>Pendaftaran Rawat Jalan</h5>
                        <h5 style="color: #72afd2;font-weight: 600;" class="item-title"><?= @$riwayat->nama_ruangan ?></h5>
                        <tr>
                            <td>No Register</td>
                            <td>:</td>
                            <td><?= @$riwayat->no_register ?></td>
                        </tr>
                        <tr>
                            <td>Tanggal Mendaftar</td>
                            <td>:</td>
                            <td><?= @$riwayat->tgl_daftar ?></td>
                        </tr>
                        <tr>
                            <td>Tanggal Berobat</td>
                            <td>:</td>
                            <td><?= @$riwayat->tgl_berobat ?></td>
                        </tr>
                        <tr>
                            <td>Nomor Tiket</td>
                            <td>:</td>
                            <td><?= @$riwayat->no_tiket ?></td>
                        </tr>
                        <tr>
                            <td>Nomor Urut</td>
                            <td>:</td>
                            <td><?= @$riwayat->no_urut ?></td>
                        </tr>
                        <tr>
                            <td>Biaya Konsultasi Dan Administrasi</td>
                            <td>:</td>
                            <td><?= @$riwayat->total_bill ?></td>
                        </tr>
                        <tr>
                            <td>Status</td>
                            <td>:</td>
                            <td><?= @$riwayat->status ?></td>
                        </tr>
                    </table>
                </div>
            </div>
		</div>
	</div>
</div>
