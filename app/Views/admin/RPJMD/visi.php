<?= $this->extend('_layout/template'); ?>

<?= $this->section('tombol'); ?>
<div style="width:90px;position: absolute;right: 0px;">
	<a href="<?= base_url('/admin/rpjmd/visi/visi_add'); ?>">
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
				<th>Visi / Misi</th>
				<th class="text-center" width="80px">Aksi</th>
			</tr>
		</thead>
		<tfoot>
			<tr>
				<th class="text-center">Kode</th>
				<th>Visi / Misi</th>
				<th class="text-center">Aksi</th>
			</tr>
		</tfoot>
		<tbody>
			<?php $nomor = 1;
			foreach ($visi as $row) : ?>
				<tr style="background-color: blanchedalmond;">
					<td><?= $row['kode_visi']; ?></td>
					<td><b>[VISI]</b> <a href="<?= base_url() . '/admin/rpjmd/visi/misi_add/' . $row['id_visi']; ?>" title="add misi"><?= $row['visi']; ?></a></td>
					<td class="text-center">
						<a class="btn btn-info btn-circle btn-xs" href="<?= base_url() . '/admin/rpjmd/visi/visi_edit/' . $row['id_visi']; ?>">
							<i class="nav-icon fas fa-pen-alt"></i>
						</a>
						<a class="btn btn-danger btn-circle btn-xs" onclick="if(confirm('Apakah anda yakin ingin menghapus data ini ??')){location.href='<?= base_url() . '/admin/rpjmd/visi/visi_hapus/' . $row['id_visi']; ?>'}" href="#">
							<i class="nav-icon fas fa-trash-alt"></i>
						</a>
					</td>
				</tr>
				<?php $query = $db->table('tb_misi')->select('tb_misi.*')->getWhere(['visi' => $row['visi']])->getResultArray();
				foreach ($query as $rol) : ?>
					<tr>
						<td><?= $rol['kode_misi']; ?></td>
						<td style="padding-left: 40px;"><b>[MISI]</b> <?= $rol['misi']; ?></td>
						<td class="text-center align-top">
							<a class="btn btn-info btn-circle btn-xs" href="<?= base_url() . '/admin/rpjmd/visi/misi_edit/' . $rol['id_misi'] . '/' . $row['id_visi']; ?>">
								<i class="nav-icon fas fa-pen-alt"></i>
							</a>
							<a class="btn btn-danger btn-circle btn-xs" onclick="if(confirm('Apakah anda yakin ingin menghapus data ini ??')){location.href='<?= base_url() . '/admin/rpjmd/visi/misi_hapus/' . $rol['id_misi']; ?>'}" href="#">
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