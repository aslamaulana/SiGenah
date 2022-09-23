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
	<table id="example1" class="table table-bordered">
		<thead>
			<tr>
				<th class="text-center" width="60px">Kode</th>
				<th>Tujuan / Sasaran / Sasaran Indikator</th>
				<?php foreach ($tahunA as $row) : ?>
					<th class="text-center" width="60px"><?= $row['tahun']; ?></th>
				<?php endforeach; ?>
				<th class="text-center" width="50px">Aksi</th>
			</tr>
		</thead>
		<tfoot>
			<tr>
				<th class="text-center">Kode</th>
				<th>Tujuan / Sasaran / Sasaran Indikator</th>
				<?php foreach ($tahunA as $row) : ?>
					<th class="text-center" width="60px"><?= $row['tahun']; ?></th>
				<?php endforeach; ?>
				<th class="text-center">Aksi</th>
			</tr>
		</tfoot>
		<tbody>
			<?php $nomor = 1;
			foreach ($tujuan as $row) : ?>
				<tr style="background-color: blanchedalmond;">
					<td class="align-top font-weight-bold"><?= $row['kode_tujuan']; ?></td>
					<td class="text-justify font-weight-bold">[TUJUAN] <?= $row['tujuan']; ?></td>
					<?php foreach ($tahunA as $th) : ?>
						<td></td>
					<?php endforeach; ?>
					<td></td>
				</tr>
				<?php $query = $db->table('tb_sasaran')->getWhere(['tujuan_id' => $row['id_tujuan']])->getResultArray();
				foreach ($query as $ros) : ?>
					<tr>
						<td class="align-top"><?= $ros['kode_sasaran']; ?></td>
						<td class="align-top">[SASARAN] <?= '<a href="/admin/rpjmd/sasaran/sasaran_indik_add/' . $ros['id_sasaran'] . '/' . $ros['sasaran'] . '" title="Add Indikator sasaran">' . $ros['sasaran'] . '</a>'; ?></td>
						<?php foreach ($tahunA as $th) : ?>
							<td></td>
						<?php endforeach; ?>
						<td class="text-center align-top">
							<a class="btn btn-info btn-circle btn-xs" href="<?= base_url() . '/admin/rpjmd/sasaran/sasaran_edit/' . $ros['id_sasaran']; ?>">
								<i class="nav-icon fas fa-pen-alt"></i>
							</a>
							<a class="btn btn-danger btn-circle btn-xs" onclick="if(confirm('Apakah anda yakin ingin menghapus data ini ??')){location.href='<?= base_url() . '/admin/rpjmd/sasaran/sasaran_hapus/' . $ros['id_sasaran']; ?>'}" href="#">
								<i class="nav-icon fas fa-trash-alt"></i>
							</a>
						</td>
					</tr>
					<?php $querz = $db->table('tb_sasaran_indikator')->getWhere(['sasaran_id' => $ros['id_sasaran']])->getResultArray();
					foreach ($querz as $rom) : ?>
						<tr>
							<td></td>
							<td class="align-baseline" style="padding-left: 40px;"><?= $rom['sasaran_indikator']; ?></td>
							<?php $querl = $db->table('vw_sasaran_indik')->getWhere(['sasaran_indik_id' => $rom['id_sasaran_indik']])->getResultArray();
							foreach ($querl as $roy) : ?>
								<td><?= $roy['target'] . ' ' . $roy['satuan']; ?></td>
							<?php endforeach; ?>
							<td class="text-center align-top">
								<a class="btn btn-info btn-circle btn-xs" href="<?= base_url() . '/admin/rpjmd/sasaran/sasaran_indik_edit/' . $rom['id_sasaran_indik'] . '/' . $ros['id_sasaran']; ?>">
									<i class="nav-icon fas fa-pen-alt"></i>
								</a>
								<a class="btn btn-danger btn-circle btn-xs" onclick="if(confirm('Apakah anda yakin ingin menghapus data ini ??')){location.href='<?= base_url() . '/admin/rpjmd/sasaran/sasaran_indik_hapus/' . $rom['id_sasaran_indik']; ?>'}" href="#">
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