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
	<form action="<?= base_url('/admin/rpjmd/program/program_create') ?>" method="POST">
		<?= csrf_field() ?>
		<div class="row">
			<div class="col-md-2">
				<div class="form-group">
					<label>Sasaran</label>
				</div>
			</div>
			<div class="col-md-10">
				<div class="input-group">
					<select name="sasaran" class="form-control select2bs4 <?= ($validation->hasError('sasaran')) ? 'is-invalid' : ''; ?>" required>
						<option value="">Tidak Dipilih...</option>
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
					<label>Urusan</label>
				</div>
			</div>
			<div class="col-md-10">
				<div class="input-group">
					<select name="urusan" id="urusan_id" class="form-control select2bs4 <?= ($validation->hasError('urusan')) ? 'is-invalid' : ''; ?>" required>
						<option value="">Tidak Dipilih...</option>
						<?php foreach ($urusan as $row) : ?>
							<option value="<?= $row['urusan']; ?>"><?= '[' . $row['id_urusan'] . '] ' . $row['urusan']; ?></option>
						<?php endforeach; ?>
					</select>
					<div class="invalid-feedback">
						<?= $validation->getError('urusan'); ?>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-2">
				<div class="form-group">
					<label>Bidang</label>
				</div>
			</div>
			<div class="col-md-10">
				<div class="input-group">
					<select name="bidang" id="bidang_id" class="form-control select2bs4 <?= ($validation->hasError('bidang')) ? 'is-invalid' : ''; ?>" required> </select>
					<div class="invalid-feedback">
						<?= $validation->getError('bidang'); ?>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-2">
				<div class="form-group">
					<label>Program</label>
				</div>
			</div>
			<div class="col-md-10">
				<div class="input-group">
					<select name="program" id="program_id" class="form-control select2bs4 <?= ($validation->hasError('program')) ? 'is-invalid' : ''; ?>" required> </select>
					<div class="invalid-feedback">
						<?= $validation->getError('program'); ?>
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
						<option value="">Tidak Dipilih...</option>
						<?php foreach ($opd as $row) : ?>
							<option value="<?= $row['id']; ?>"><?= $row['name']; ?></option>
						<?php endforeach; ?>
					</select>
					<div class="invalid-feedback">
						<?= $validation->getError('opd'); ?>
					</div>
				</div>
			</div>
		</div><br>
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label>Indikator Program <medium class="text-danger">*</medium></label>
					<textarea name="indikator_program" class="form-control" placeholder="indikator sasaran" maxlength="300" rows="4" required><?= old('indikator_program'); ?></textarea>
					<span class="text-danger"><?= $validation->getError('indikator_program'); ?></span>
				</div>
				<div class="form-group">
					<label>Satuan <medium class="text-danger">*</medium></label>
					<select name="satuan" class="form-control select2bs4 <?= ($validation->hasError('satuan')) ? 'is-invalid' : ''; ?>" required>
						<option value="">Tidak Dipilih...</option>
						<?php foreach ($satuan as $row) : ?>
							<option value="<?= $row['satuan']; ?>"><?= $row['satuan']; ?></option>
						<?php endforeach; ?>
					</select>
					<span class="text-danger"><?= $validation->getError('satuan'); ?></span>
				</div>
			</div>
			<div class="col-md-3">
				<div class="form-group">
					<label>Target 2021</label>
					<input type="text" value="<?= old('t_2021'); ?>" class="form-control" name="t_2021" maxlength="20" required>
				</div>
				<div class="form-group">
					<label>Target 2022</label>
					<input type="text" value="<?= old('t_2022'); ?>" class="form-control" name="t_2022" maxlength="20" required>
				</div>
				<div class="form-group">
					<label>Target 2023</label>
					<input type="text" value="<?= old('t_2023'); ?>" class="form-control" name="t_2023" maxlength="20" required>
				</div>
				<div class="form-group">
					<label>Target 2024</label>
					<input type="text" value="<?= old('t_2024'); ?>" class="form-control" name="t_2024" maxlength="20" required>
				</div>
				<div class="form-group">
					<label>Target 2025</label>
					<input type="text" value="<?= old('t_2025'); ?>" class="form-control" name="t_2025" maxlength="20" required>
				</div>
				<div class="form-group">
					<label>Target 2026</label>
					<input type="text" value="<?= old('t_2026'); ?>" class="form-control" name="t_2026" maxlength="20" required>
				</div>
			</div>
			<div class="col-md-3">
				<div class="form-group">
					<label>Target RP 2021</label>
					<input type="number" value="<?= old('rp_2021'); ?>" class="form-control" name="rp_2021" maxlength="20" required>
				</div>
				<div class="form-group">
					<label>Target RP 2022</label>
					<input type="number" value="<?= old('rp_2022'); ?>" class="form-control" name="rp_2022" maxlength="20" required>
				</div>
				<div class="form-group">
					<label>Target RP 2023</label>
					<input type="number" value="<?= old('rp_2023'); ?>" class="form-control" name="rp_2023" maxlength="20" required>
				</div>
				<div class="form-group">
					<label>Target RP 2024</label>
					<input type="number" value="<?= old('rp_2024'); ?>" class="form-control" name="rp_2024" maxlength="20" required>
				</div>
				<div class="form-group">
					<label>Target RP 2025</label>
					<input type="number" value="<?= old('rp_2025'); ?>" class="form-control" name="rp_2025" maxlength="20" required>
				</div>
				<div class="form-group">
					<label>Target RP 2026</label>
					<input type="number" value="<?= old('rp_2026'); ?>" class="form-control" name="rp_2026" maxlength="20" required>
				</div>
			</div>
			<div class="col-md-12">
				<medium class="text-success">*/ Jika target kosong isikan dengan tanda strip [-]</medium>
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
					urusan: id
				},
				async: true,
				dataType: 'json',
				success: function(data) {

					var html = '';
					var i;
					html = '<option value="">Pilih..</option>';
					for (i = 0; i < data.length; i++) {
						html += '<option value="' + data[i].bidang + '">' + '[' + data[i].id_bidang + '] ' + data[i].bidang + '</option>';
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
					bidang: id
				},
				async: true,
				dataType: 'json',
				success: function(data) {

					var html = '';
					var i;
					html = '<option value="">Pilih..</option>';
					for (i = 0; i < data.length; i++) {
						html += '<option value="' + data[i].program + '">' + '[' + data[i].id_program + '] ' + data[i].program + '</option>';
					}
					$('#program_id').html(html);

				}
			});
			return false;
		});
	});
</script>
<?= $this->endSection(); ?>