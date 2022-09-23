<?= $this->extend('_layout/template'); ?>

<?= $this->section('stylesheet'); ?>
<link rel="stylesheet" href="<?= base_url('/toping/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') ?>">
<?= $this->endSection(); ?>

<?= $this->section('tombol'); ?>
<div style="width:90px;position: absolute;right: 0px;">
	<a href="<?= base_url('/admin/rpjmd/arah_kebijakan/arah_kebijakan_add'); ?>">
		<li class="btn btn-block btn-warning btn-sm" active><i class="nav-icon fa fa-plus"></i> Add</li>
	</a>
</div>
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<div class="card-body">
	<table id="example1" class="table table-bordered table-responsive" style="height: 69vh;">
		<thead>
			<tr>
				<th class="text-center" width:40px>No</th>
				<th style="width: 90%;">Strategi / Arah Kebijakan</th>
				<th class="text-center" width:60px>Aksi</th>
			</tr>
		</thead>
		<tfoot>
			<tr>
				<th class="text-center">No</th>
				<th>Strategi / Arah Kebijakan</th>
				<th class="text-center">Aksi</th>
			</tr>
		</tfoot>
		<tbody>
			<?php $nomor = 1;
			foreach ($strategi as $row) : ?>
				<tr style="background-color: blanchedalmond;">
					<td class="text-center"><?= $nomor++; ?></td>
					<td class="align-top font-weight-bold text-justify">[STRATEGI] <?= $row['strategi']; ?></td>
					<td> </td>
				</tr>
				<?php $querz = $db->table('tb_arah_kebijakan')->getWhere(['strategi_id' => $row['id_strategi']])->getResultArray();
				foreach ($querz as $rol) : ?>
					<tr>
						<td></td>
						<td>&emsp;<?= $rol['arah_kebijakan']; ?></td>
						<td class="text-center"">
							<a class=" btn btn-info btn-circle btn-xs" href="<?= base_url() . '/admin/rpjmd/arah_kebijakan/arah_kebijakan_edit/' . $rol['id_arah_kebijakan']; ?>">
							<i class="nav-icon fas fa-pen-alt"></i>
							</a>
							<a class="btn btn-danger btn-circle btn-xs" onclick="if(confirm('Apakah anda yakin ingin menghapus data ini ??')){location.href='<?= base_url() . '/admin/rpjmd/arah_kebijakan/arah_kebijakan_hapus/' . $rol['id_arah_kebijakan']; ?>'}" href="#">
								<i class="nav-icon fas fa-trash-alt"></i>
							</a>
						</td>
					</tr>
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
			//"paging": false,
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