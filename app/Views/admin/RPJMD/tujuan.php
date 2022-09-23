<?= $this->extend('_layout/template'); ?>

<?= $this->section('stylesheet'); ?>
<link rel="stylesheet" href="<?= base_url('/toping/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') ?>">
<?= $this->endSection(); ?>

<?= $this->section('tombol'); ?>
<div style="width:90px;position: absolute;right: 0px;">
	<a href="<?= base_url('/admin/rpjmd/tujuan/tujuan_add'); ?>">
		<li class="btn btn-block btn-warning btn-sm" active><i class="nav-icon fa fa-plus"></i> Add</li>
	</a>
</div>
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<div class="card-body">
	<table id="example1" class="table table-bordered">
		<thead>
			<tr>
				<th class="text-center" width="40px">Kode</th>
				<th>Visi / Misi / Tujuan / Tujuan Indikator</th>
				<?php foreach ($tahunA as $row) : ?>
					<th class="text-center" width="60px"><?= $row['tahun']; ?></th>
				<?php endforeach; ?>
				<th class="text-center" width="60px">Aksi</th>
			</tr>
		</thead>
		<tfoot>
			<tr>
				<th style="text-align: center;">Kode</th>
				<th>Visi / Misi / Tujuan / Tujuan Indikator</th>
				<?php foreach ($tahunA as $row) : ?>
					<th class="text-center" width="60px"><?= $row['tahun']; ?></th>
				<?php endforeach; ?>
				<th class="text-center" width="60px">Aksi</th>
			</tr>
		</tfoot>
		<tbody>
			<?php $nomor = 1;
			foreach ($visi as $row) : ?>
				<!-- Visi -->
				<tr style="background-color: blanchedalmond;">
					<td class="font-weight-bold"><?= $row['kode_visi']; ?></td>
					<td class="text-justify font-weight-bold">[Visi] <?= $row['visi']; ?></td>
					<?php foreach ($tahunA as $th) : ?>
						<td></td>
					<?php endforeach; ?>
					<td></td>
				</tr>
				<?php $querx = $db->table('tb_rpjmd_tujuan')
					->distinct('tb_misi.kode_misi')
					->distinct('tb_misi.misi')
					->select('tb_misi.kode_misi')
					->select('tb_misi.misi')
					->join('tb_misi', 'tb_rpjmd_tujuan.misi_n = tb_misi.misi', 'LEFT')
					->getWhere(['tb_misi.visi' => $row['visi']])->getResultArray();
				foreach ($querx as $rol) : ?>
					<!-- Misi -->
					<tr style="background: azure;">
						<td class="font-weight-bold"><?= $rol['kode_misi']; ?></td>
						<td class="text-justify font-weight-bold">[MISI] <?= $rol['misi']; ?></td>
						<?php foreach ($tahunA as $th) : ?>
							<td></td>
						<?php endforeach; ?>
						<td></td>
					</tr>
					<?php $query = $db->table('tb_rpjmd_tujuan')
						->select('tb_rpjmd_tujuan.tujuan, tb_rpjmd_tujuan.kode_tujuan')
						->distinct('tb_rpjmd_tujuan.tujuan, tb_rpjmd_tujuan.kode_tujuan')
						->getWhere(['misi_n' => $rol['misi']])->getResultArray();
					foreach ($query as $ros) : ?>
						<!-- Tujuan -->
						<tr>
							<td class="align-top"><?= $ros['kode_tujuan']; ?></td>
							<td class="align-top" style="padding-left: 20px;">[TUJUAN] <?= '<a href="/admin/rpjmd/tujuan/tujuan_indik_add?p=' . $ros['tujuan'] . '&k=' . $ros['kode_tujuan'] . '&m=' . $rol['misi'] . '" title="Add Indikator Tujuan">' . $ros['tujuan'] . '</a>'; ?></td>
							<?php foreach ($tahunA as $th) : ?>
								<td></td>
							<?php endforeach; ?>
							<td class="text-center align-top">
								<a class="btn btn-info btn-circle btn-xs" href="<?= base_url() . '/admin/rpjmd/tujuan/tujuan_edit?p=' . $ros['tujuan'] . '&k=' . $ros['kode_tujuan'] . '&m=' . $rol['misi']; ?>">
									<i class="nav-icon fas fa-pen-alt"></i>
								</a>
							</td>
						</tr>
						<?php $querz = $db->table('tb_rpjmd_tujuan')->getWhere(['tujuan' => $ros['tujuan'], 'kode_tujuan' => $ros['kode_tujuan']])->getResultArray();
						foreach ($querz as $rom) : ?>
							<tr>
								<td></td>
								<td class="align-top" style=" padding-left: 40px;"><?= $rom['indikator_tujuan']; ?></td>
								<td class="align-top"><?= $rom['t_2021'] . ' ' . $rom['satuan']; ?></td>
								<td class="align-top"><?= $rom['t_2022'] . ' ' . $rom['satuan']; ?></td>
								<td class="align-top"><?= $rom['t_2023'] . ' ' . $rom['satuan']; ?></td>
								<td class="align-top"><?= $rom['t_2024'] . ' ' . $rom['satuan']; ?></td>
								<td class="align-top"><?= $rom['t_2025'] . ' ' . $rom['satuan']; ?></td>
								<td class="align-top"><?= $rom['t_2026'] . ' ' . $rom['satuan']; ?></td>
								<td class="text-center align-top">
									<a class="btn btn-info btn-circle btn-xs" href="<?= base_url() . '/admin/rpjmd/tujuan/tujuan_indik_edit/' . $rom['id_tujuan']; ?>">
										<i class="nav-icon fas fa-pen-alt"></i>
									</a>
									<a class="btn btn-danger btn-circle btn-xs" onclick="if(confirm('Apakah anda yakin ingin menghapus data ini ??')){location.href='<?= base_url() . '/admin/rpjmd/tujuan/tujuan_hapus/' . $rom['id_tujuan']; ?>'}" href="#">
										<i class="nav-icon fas fa-trash-alt"></i>
									</a>
								</td>
							</tr>
						<?php endforeach; ?>
					<?php endforeach; ?>
				<?php endforeach; ?>
			<?php endforeach; ?>
		</tbody>
	</table>
</div>
<?= $this->endSection(); ?>

<?= $this->section('Javascript'); ?>
<!-- DataTables  & Plugins -->
<script src="<?= base_url('/toping/plugins/datatables/jquery.dataTables.min.js') ?>"></script>
<script src="<?= base_url('/toping/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') ?>"></script>

<script>
	$(function() {
		bsCustomFileInput.init();
	});
	$(function() {
		$("#example1").DataTable({
			"responsive": true,
			"autoWidth": false,
			"ordering": false,
			"paging": false,
		});
		$('#example2').DataTable({
			"paging": true,
			"lengthChange": false,
			"searching": false,
			"ordering": true,
			"info": true,
			"autoWidth": false,
			"responsive": true,
		});
	});
</script>
<?= $this->endSection(); ?>