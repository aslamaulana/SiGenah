<?= $this->extend('_layout/template'); ?>

<?= $this->section('stylesheet'); ?>
<link rel="stylesheet" href="<?= base_url('/toping/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') ?>">
<link rel="stylesheet" href="<?= base_url('/toping/plugins/datatables-rowgroup/css/rowGroup.bootstrap4.min.js') ?>">
<?= $this->endSection(); ?>

<?= $this->section('tombol'); ?>
<?php if (menu('renstra')->kunci == 'tidak') { ?>
	<div style="width:90px;">
		<a href="<?= base_url('/user/renstra/opd_program/opd_program_add'); ?>">
			<li class="btn btn-block btn-warning btn-sm" active><i class="nav-icon fa fa-plus"></i> Add</li>
		</a>
	</div>
	<div>
		<a href="<?= base_url('/user/renstra/opd_program/import'); ?>">
			<li class="btn btn-block btn-success btn-sm" active><i class="nav-icon fa fa-file-excel"></i> Import</li>
		</a>
	</div>
<?php } else { ?>
	<div style="width:90px;">
		<a href="#">
			<li class="btn btn-block btn-danger btn-sm" active><i class="nav-icon fa fa-lock"></i></li>
		</a>
	</div>
<?php } ?>
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<div class="card-body">
	<table id="example1" class="table table-bordered display nowrap table-sm" cellspacing="0">
		<thead>
			<tr>
				<th rowspan="2">
					<div style="width: 700px;">Sasaran / Program / Program Indikator</div>
				</th>
				<th rowspan="2"></th>
				<th rowspan="2"></th>
				<th rowspan="2">
					<div style="width: 350px;">Sasaran Kegiatan</div>
				</th>
				<th rowspan="2"></th>
				<?php foreach ($tahunA as $row) : ?>
					<th colspan="2" class="text-center align-middle"><?= $row['tahun']; ?></th>
					<th rowspan="2"></th>
				<?php endforeach; ?>
				<th rowspan="2" class="text-center"> Aksi </th>
			</tr>
			<tr>
				<?php foreach ($tahunA as $row) : ?>
					<th class="text-center align-middle">
						<div style="width: 120px;">Target</div>
					</th>
					<th class="text-center align-middle">
						<div style="width: 150px;">Pagu</div>
					</th>
				<?php endforeach; ?>
			</tr>
		</thead>

		<tbody>
			<?php foreach ($opd_program as $rom) : ?>
				<tr>
					<td class="text-wrap">
						<div style="padding-left: 40px;"><?= $rom['opd_indikator_program']; ?></div>
					</td>
					<td>[SASARAN] <?= $rom['opd_sasaran_n']; ?></td>
					<td>
						<div style="padding-left: 20px;">[<?= $rom['id_program']; ?>] <?= '<a href="/user/renstra/opd_program/opd_program_indik_add?p=' . $rom['opd_program_n'] . '&a=' . $rom['opd_sasaran_n'] . '&m=' . $rom['opd_program_sasaran_n'] . '" title="Tambah Indikator Program">' . $rom['opd_program_n'] . '</a>'; ?></div>
					</td>
					<td></td>
					<td><?= $rom['opd_program_sasaran_n']; ?></td>
					<td class="align-top text-center"><?= $rom['t_2021'] . ' ' . $rom['satuan']; ?></td>
					<td></td>
					<td class="text-right">
						<?php $pagu1 = $db->table('vw_pagu_renstra_program')
							->selectsum('rp_2021')
							->getWhere(['vw_pagu_renstra_program.opd_program_n' => $rom['opd_program_n'], 'vw_pagu_renstra_program.perubahan' => $_SESSION['perubahan'], 'vw_pagu_renstra_program.opd_id' => user()->opd_id])->getRowArray();
						echo number_format($pagu1['rp_2021'], 0, ',', '.');
						?>
					</td>
					<td class="align-top text-center"><?= $rom['t_2022'] . ' ' . $rom['satuan']; ?></td>
					<td></td>
					<td class="text-right">
						<?php $pagu2 = $db->table('vw_pagu_renstra_program')
							->selectsum('rp_2022')
							->getWhere(['vw_pagu_renstra_program.opd_program_n' => $rom['opd_program_n'], 'vw_pagu_renstra_program.perubahan' => $_SESSION['perubahan'], 'vw_pagu_renstra_program.opd_id' => user()->opd_id])->getRowArray();
						echo number_format($pagu2['rp_2022'], 0, ',', '.');
						?>
					</td>
					<td class="align-top text-center"><?= $rom['t_2023'] . ' ' . $rom['satuan']; ?></td>
					<td></td>
					<td class="text-right">
						<?php $pagu3 = $db->table('vw_pagu_renstra_program')
							->selectsum('rp_2023')
							->getWhere(['vw_pagu_renstra_program.opd_program_n' => $rom['opd_program_n'], 'vw_pagu_renstra_program.perubahan' => $_SESSION['perubahan'], 'vw_pagu_renstra_program.opd_id' => user()->opd_id])->getRowArray();
						echo number_format($pagu3['rp_2023'], 0, ',', '.');
						?>
					</td>
					<td class="align-top text-center"><?= $rom['t_2024'] . ' ' . $rom['satuan']; ?></td>
					<td></td>
					<td class="text-right">
						<?php $pagu4 = $db->table('vw_pagu_renstra_program')
							->selectsum('rp_2024')
							->getWhere(['vw_pagu_renstra_program.opd_program_n' => $rom['opd_program_n'], 'vw_pagu_renstra_program.perubahan' => $_SESSION['perubahan'], 'vw_pagu_renstra_program.opd_id' => user()->opd_id])->getRowArray();
						echo number_format($pagu4['rp_2024'], 0, ',', '.');
						?>
					</td>
					<td class="align-top text-center"><?= $rom['t_2025'] . ' ' . $rom['satuan']; ?></td>
					<td></td>
					<td class="text-right">
						<?php $pagu5 = $db->table('vw_pagu_renstra_program')
							->selectsum('rp_2025')
							->getWhere(['vw_pagu_renstra_program.opd_program_n' => $rom['opd_program_n'], 'vw_pagu_renstra_program.perubahan' => $_SESSION['perubahan'], 'vw_pagu_renstra_program.opd_id' => user()->opd_id])->getRowArray();
						echo number_format($pagu5['rp_2025'], 0, ',', '.');
						?>
					</td>
					<td class="align-top text-center"><?= $rom['t_2026'] . ' ' . $rom['satuan']; ?></td>
					<td></td>
					<td class="text-right">
						<?php $pagu6 = $db->table('vw_pagu_renstra_program')
							->selectsum('rp_2026')
							->getWhere(['vw_pagu_renstra_program.opd_program_n' => $rom['opd_program_n'], 'vw_pagu_renstra_program.perubahan' => $_SESSION['perubahan'], 'vw_pagu_renstra_program.opd_id' => user()->opd_id])->getRowArray();
						echo number_format($pagu6['rp_2026'], 0, ',', '.');
						?>
					</td>
					<td style="text-align: center;">
						<?php if (menu('renstra')->kunci == 'tidak') { ?>
							<a class="btn btn-info btn-circle btn-xs" href="<?= base_url() . '/user/renstra/opd_program/opd_program_indik_edit/' . $rom['id_opd_program']; ?>">
								<i class="nav-icon fas fa-pen-alt"></i>
							</a>
							<a class="btn btn-danger btn-circle btn-xs" onclick="if(confirm('Apakah anda yakin ingin menghapus data ini ??')){location.href='<?= base_url() . '/user/renstra/opd_program/opd_program_indik_hapus/' . $rom['id_opd_program']; ?>'}" href="#">
								<i class="nav-icon fas fa-trash-alt"></i>
							</a>
						<?php } else { ?>
							<a class="btn btn-danger btn-circle btn-xs">
								<i class="nav-icon fas fa-lock"></i>
							</a>
						<?php } ?>
					</td>
					<td>
						<?php if (menu('renstra')->kunci == 'tidak') { ?>
							<a class="btn btn-info btn-circle btn-xs" href="<?= base_url() . '/user/renstra/opd_program/opd_program_edit?p=' . $rom['opd_program_n'] . '&a=' . $rom['opd_sasaran_n'] . '&m=' . $rom['opd_program_sasaran_n']; ?>">
								<i class="nav-icon fas fa-pen-alt"></i>
							</a>
						<?php } else { ?>
							<a class="btn btn-danger btn-circle btn-xs">
								<i class="nav-icon fas fa-lock"></i>
							</a>
						<?php } ?>
					</td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
</div>
<?= $this->endSection(); ?>

<?= $this->section('Javascript'); ?>
<!-- DataTables  & Plugins -->
<script src="<?= base_url('/toping/plugins/datatables/jquery.dataTables.min.js') ?>"></script>
<script src="<?= base_url('/toping/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') ?>"></script>
<script src="<?= base_url('/toping/plugins/datatables-rowgroup/js/dataTables.rowGroup.min.js') ?>"></script>
<script>
	$(function() {
		$("#example1").DataTable({
			"scrollX": true,
			"scrollY": '65vh',
			"scrollCollapse": true,
			"paging": true,
			"responsive": false,
			"autoWidth": false,
			"ordering": false,
			"lengthMenu": [
				[20, 40, 60, 100, -1],
				[20, 40, 60, 100, 'All']
			],
			columnDefs: [{
				visible: false,
				// targets: [1, 2, 3, 27]
				targets: [1, 2, 4, 7, 10, 13, 16, 19, 22, 24]
			}],
			order: [
				[1, 'asc'],
				[2, 'asc']
			],
			rowGroup: {
				startRender: function(rows, group) {

					if (rows.data().pluck(1)[0] == group) {
						return $('<tr class="font-weight-bold" style="background-color: blanchedalmond;" />')
							.append('<td class="align-top text-wrap font-weight-bold">' + group + '</td>')
							.append('<td></td>')
							.append('<td></td>')
							.append('<td></td>')
							.append('<td></td>')
							.append('<td></td>')
							.append('<td></td>')
							.append('<td></td>')
							.append('<td></td>')
							.append('<td></td>')
							.append('<td></td>')
							.append('<td></td>')
							.append('<td></td>')
							.append('<td></td>')
							.append('<td></td>');
					} else if (rows.data().pluck(2)[0] == group) {

						return $('<tr style="background: azure;" />')
							.append('<td class="align-top text-wrap">' + group + '</td>')
							.append('<td class="text-wrap align-top">' + rows.data().pluck(4)[0] + '</td>')
							.append('<td></td>')
							.append('<td class="align-top text-right">' + rows.data().pluck(7)[0] + '</td>')
							.append('<td></td>')
							.append('<td class="align-top text-right">' + rows.data().pluck(10)[0] + '</td>')
							.append('<td> </td>')
							.append('<td class="align-top text-right">' + rows.data().pluck(13)[0] + '</td>')
							.append('<td> </td>')
							.append('<td class="align-top text-right">' + rows.data().pluck(16)[0] + '</td>')
							.append('<td> </td>')
							.append('<td class="align-top text-right">' + rows.data().pluck(19)[0] + ' </td>')
							.append('<td> </td>')
							.append('<td class="align-top text-right">' + rows.data().pluck(22)[0] + ' </td>')
							.append('<td class="text-center align-top">' + rows.data().pluck(24)[0] + '</td>');
					}
				},
				dataSrc: [1, 2]
			}
		});
	});
</script>
<?= $this->endSection(); ?>