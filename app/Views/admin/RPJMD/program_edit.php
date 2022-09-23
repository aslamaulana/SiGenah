<?= $this->extend('_layout/template'); ?>

<?= $this->section('stylesheet'); ?>
<link rel="stylesheet" href="<?= base_url('/toping/plugins/select2/css/select2.min.css') ?>">
<link rel="stylesheet" href="<?= base_url('/toping/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') ?>">
<?= $this->endSection(); ?>

<?= $this->section('tombol'); ?>
<div>
	<a href="#" onclick="history.back(-1)">
		<li class="btn btn-block btn-info btn-sm" active><i class="nav-icon fa fa-chevron-left"></i> Kembali</li>
	</a>
</div>
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<div class="card-body">
	<table class="table table-bordered">
		<tr>
			<td class="col-md-2 font-weight-bold">Sasaran:</td>
			<td class="col-md-10"><?= $program['sasaran']; ?></td>
		</tr>
		<tr>
			<td class="col-md-2 font-weight-bold">Program:</td>
			<td class="col-md-10"><?= '[' . $program['kode'] . '] ' . $program['program']; ?></td>
		</tr>
		<tr>
			<td class="col-md-2 font-weight-bold">PD Penanggung Jawab:</td>
			<td class="col-md-10"><?= $opd2['name']; ?></td>
		</tr>
	</table><br><br>
	<form action="<?= base_url('/admin/rpjmd/program/program_update') ?>" method="POST">
		<?= csrf_field() ?>
		<input type="hidden" name="urusan_old" value="<?= $program['urusan']; ?>">
		<input type="hidden" name="bidang_old" value="<?= $program['bidang']; ?>">
		<input type="hidden" name="program_old" value="<?= $program['program']; ?>">
		<input type="hidden" name="sasaran_old" value="<?= $program['sasaran']; ?>">
		<input type="hidden" name="opd_old" value="<?= $program['opd']; ?>">
		<div class="row">
			<div class="col-md-2">
				<div class="form-group">
					<label>Sasaran</label>
				</div>
			</div>
			<div class="col-md-10">
				<div class="input-group">
					<select name="sasaran" class="form-control select2bs4 <?= ($validation->hasError('sasaran')) ? 'is-invalid' : ''; ?>" required>
						<option value="<?= $program['sasaran']; ?>"><?= $program['sasaran']; ?></option>
						<?php foreach ($sasaran as $row) : ?>
							<option value="<?= $row['sasaran']; ?>"><?= '[' . $row['kode_sasaran'] . '] ' . $row['sasaran']; ?></option>
						<?php endforeach; ?>
					</select>
					<div class="invalid-feedback">
						<?= $validation->getError('sasaran'); ?>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-2">
				<div class="form-group">
					<label>PD Penanggung Jawab</label>
				</div>
			</div>
			<div class="col-md-10">
				<div class="input-group">
					<select name="opd" class="form-control select2bs4 <?= ($validation->hasError('opd')) ? 'is-invalid' : ''; ?>" required>
						<option value="<?= $opd2['id']; ?>"><?= $opd2['name']; ?></option>
						<?php foreach ($opd as $row) : ?>
							<option value="<?= $row['id']; ?>"><?= $row['name']; ?></option>
						<?php endforeach; ?>
					</select>
					<div class="invalid-feedback">
						<?= $validation->getError('opd'); ?>
					</div>
				</div>
			</div>
		</div>
		<div class="card-footer">
			<button type="submit" class="btn btn-primary">Simpan</button>
		</div>
	</form>
</div>
<?= $this->endSection(); ?>

<?= $this->section('Javascript'); ?>
<script src="<?= base_url('/toping/plugins/select2/js/select2.full.min.js'); ?>"></script>
<script>
	$(function() {

		$('.select2bs4').select2({
			width: 'resolve',
			theme: 'bootstrap4',
			placeholder: 'Tidak Dipilih...'
		})
	});

	$(document).ready(function() {
		$('#urusan_id').change(function() {
			var id = $(this).val();
			$.ajax({
				url: "<?php echo base_url('admin/rpjmd/program/ambilbidang'); ?>",
				method: "POST",
				data: {
					id: id
				},
				async: true,
				dataType: 'json',
				success: function(data) {

					var html = '';
					var i;
					html = '<option value="">Pilih..</option>';
					for (i = 0; i < data.length; i++) {
						html += '<option value=' + data[i].id_bidang + '>' + '[' + data[i].id_bidang + '] ' + data[i].bidang + '</option>';
					}
					$('#bidang_id').html(html);

				}
			});
			return false;
		});

		$('#bidang_id').change(function() {
			var id = $(this).val();
			$.ajax({
				url: "<?php echo base_url('admin/rpjmd/program/ambilprogram'); ?>",
				method: "POST",
				data: {
					id: id
				},
				async: true,
				dataType: 'json',
				success: function(data) {

					var html = '';
					var i;
					html = '<option value="">Pilih..</option>';
					for (i = 0; i < data.length; i++) {
						html += '<option value=' + data[i].id_program + '>' + '[' + data[i].id_program + '] ' + data[i].program + '</option>';
					}
					$('#program_id').html(html);

				}
			});
			return false;
		});
	});
</script>
<?= $this->endSection(); ?>