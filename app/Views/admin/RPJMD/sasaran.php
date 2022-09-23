<?= $this->extend('_layout/template'); ?>

<?= $this->section('stylesheet'); ?>
<link rel="stylesheet" href="<?= base_url('/toping/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') ?>">
<?= $this->endSection(); ?>

<?= $this->section('tombol'); ?>
<div style="width:90px;position: absolute;right: 0px;">
	<a href="<?= base_url('/admin/rpjmd/sasaran/sasaran_add'); ?>">
		<li class="btn btn-block btn-warning btn-sm" active><i class="nav-icon fa fa-plus"></i> Add</li>
	</a>
</div>
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<div class="card-body">
	<table id="example1" class="table table-bordered display nowrap">
		<thead>
			<tr>
				<th class="text-center" width="40px">Kode</th>
				<th>Tujuan / Sasaran / Sasaran Indikator</th>
				<?php foreach ($tahunA as $row) : ?>
					<th class="text-center" width="60px"><?= $row['tahun']; ?></th>
				<?php endforeach; ?>
				<th class="text-center" width="60px">Aksi</th>
			</tr>
		</thead>
		<tfoot>
			<tr>
				<th style="text-align: center;">Kode</th>
				<th>Tujuan / Sasaran / Sasaran Indikator</th>
				<?php foreach ($tahunA as $row) : ?>
					<th class="text-center" width="60px"><?= $row['tahun']; ?></th>
				<?php endforeach; ?>
				<th class="text-center" width="60px">Aksi</th>
			</tr>
		</tfoot>
		<tbody>
			<?php $nomor = 1;
			foreach ($tujuan as $row) : ?>
				<!-- Tujuan -->
				<tr style="background-color: blanchedalmond;">
					<td class="font-weight-bold"><?= $row['kode_tujuan']; ?></td>
					<td class="text-justify font-weight-bold">[TUJUAN] <?= $row['tujuan']; ?></td>
					<?php foreach ($tahunA as $th) : ?>
						<td></td>
					<?php endforeach; ?>
					<td></td>
				</tr>
				<?php $query = $db->table('tb_rpjmd_sasaran')
					->select('tb_rpjmd_sasaran.sasaran, tb_rpjmd_sasaran.kode_sasaran')
					->distinct('tb_rpjmd_sasaran.sasaran, tb_rpjmd_sasaran.kode_sasaran')
					->getWhere(['tujuan_n' => $row['tujuan']])->getResultArray();
				foreach ($query as $ros) : ?>
					<!-- Sasaran -->
					<tr style="background: azure;">
						<td class="align-top"><?= $ros['kode_sasaran']; ?></td>
						<td class="align-top" style="padding-left: 20px;">[SASARAN] <?= '<a href="/admin/rpjmd/sasaran/sasaran_indik_add?p=' . $ros['sasaran'] . '&k=' . $ros['kode_sasaran'] . '&m=' . $row['tujuan'] . '" title="Add Indikator Sasaran">' . $ros['sasaran'] . '</a>'; ?></td>
						<?php foreach ($tahunA as $th) : ?>
							<td></td>
						<?php endforeach; ?>
						<td class="text-center align-top">
							<a class="btn btn-info btn-circle btn-xs" href="<?= base_url() . '/admin/rpjmd/sasaran/sasaran_edit?p=' . $ros['sasaran'] . '&k=' . $ros['kode_sasaran'] . '&m=' . $row['tujuan']; ?>">
								<i class="nav-icon fas fa-pen-alt"></i>
							</a>
						</td>
					</tr>
					<?php $querz = $db->table('tb_rpjmd_sasaran')->getWhere(['sasaran' => $ros['sasaran'], 'kode_sasaran' => $ros['kode_sasaran']])->getResultArray();
					foreach ($querz as $rom) : ?>
						<tr>
							<td></td>
							<td class="align-top" style=" padding-left: 40px;"><?= $rom['indikator_sasaran']; ?></td>
							<td class="align-top"><?= $rom['t_2021'] . ' ' . $rom['satuan']; ?></td>
							<td class="align-top"><?= $rom['t_2022'] . ' ' . $rom['satuan']; ?></td>
							<td class="align-top"><?= $rom['t_2023'] . ' ' . $rom['satuan']; ?></td>
							<td class="align-top"><?= $rom['t_2024'] . ' ' . $rom['satuan']; ?></td>
							<td class="align-top"><?= $rom['t_2025'] . ' ' . $rom['satuan']; ?></td>
							<td class="align-top"><?= $rom['t_2026'] . ' ' . $rom['satuan']; ?></td>
							<td class="text-center align-top">
								<a class="btn btn-info btn-circle btn-xs" href="<?= base_url() . '/admin/rpjmd/sasaran/sasaran_indik_edit/' . $rom['id_sasaran']; ?>">
									<i class="nav-icon fas fa-pen-alt"></i>
								</a>
								<a class="btn btn-danger btn-circle btn-xs" onclick="if(confirm('Apakah anda yakin ingin menghapus data ini ??')){location.href='<?= base_url() . '/admin/rpjmd/sasaran/sasaran_hapus/' . $rom['id_sasaran']; ?>'}" href="#">
									<i class="nav-icon fas fa-trash-alt"></i>
								</a>
							</td>
						</tr>
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
			"scrollX": true,
			"scrollY": '65vh',
			"scrollCollapse": true,
			"paging": true,
			"responsive": true,
			"autoWidth": false,
			"ordering": false,
			"lengthMenu": [
				[20, 40, 60, 100, -1],
				[20, 40, 60, 100, 'All']
			],
			"columnsDefs": [{
				"width": "50%",
				"targets": 1
			}]
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