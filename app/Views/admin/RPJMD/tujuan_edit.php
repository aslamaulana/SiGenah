<?= $this->extend('_layout/template'); ?>

<?= $this->section('stylesheet'); ?>
<link rel="stylesheet" href="<?= base_url('/toping/plugins/select2/css/select2.min.css') ?>">
<link rel="stylesheet" href="<?= base_url('/toping/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') ?>">
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<div class="card-body">
	<form action="<?= base_url('/admin/rpjmd/tujuan/tujuan_update') ?>" method="POST">
		<?= csrf_field() ?>
		<input type="hidden" name="kode_tujuan_old" value="<?= $tujuan['kode_tujuan']; ?>">
		<input type="hidden" name="misi_old" value="<?= $tujuan['misi_n']; ?>">
		<input type="hidden" name="tujuan_old" value="<?= $tujuan['tujuan']; ?>">

		<div class="row">
			<div class="col-md-2">
				<div class="form-group">
					<label>Visi</label>
				</div>
			</div>
			<div class="col-md-10">
				<div class="input-group">
					<select name="visi" id="visi" class="form-control select2bs4 <?= ($validation->hasError('visi')) ? 'is-invalid' : ''; ?>">
						<option value="">Tidak Dipilih...</option>
						<?php foreach ($visi as $row) : ?>
							<option value="<?= $row['visi']; ?>"><?= '[ ' . $row['kode_visi'] . ' ] ' . $row['visi']; ?></option>
						<?php endforeach; ?>
					</select>
					<span class="text-danger"><?= $validation->getError('visi'); ?></span>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-2">
				<div class="form-group">
					<label>Misi <medium class="text-danger">*</medium></label>
				</div>
			</div>
			<div class="col-md-10">
				<div class="input-group">
					<select name="misi" id="misi" class="form-control select2bs4 <?= ($validation->hasError('misi')) ? 'is-invalid' : ''; ?>" required>
						<option value="<?= $tujuan['misi_n']; ?>"><?= $tujuan['misi_n']; ?></option>
					</select>
					<span class="text-danger"><?= $validation->getError('visi'); ?></span>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-2">
				<div class="form-group">
					<label>Kode Tujuan <medium class="text-danger">*</medium></label>
				</div>
			</div>
			<div class="col-md-10">
				<div class="input-group">
					<input type="text" name="kode_tujuan" value="<?= $tujuan['kode_tujuan']; ?>" class="form-control" maxlength="12" require>
					<span class="text-danger"><?= $validation->getError('kode_tujuan'); ?></span>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-2">
				<div class="form-group">
					<label>Tujuan <medium class="text-danger">*</medium></label>
				</div>
			</div>
			<div class="col-md-10">
				<div class="input-group">
					<textarea name="tujuan" class="form-control <?= ($validation->hasError('tujuan')) ? 'is-invalid' : ''; ?>" required><?= $tujuan['tujuan']; ?></textarea>
					<span class="text-danger"><?= $validation->getError('tujuan'); ?></span>
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
		$('#visi').change(function() {
			var id = $(this).val();
			$.ajax({
				url: "<?php echo base_url('admin/rpjmd/tujuan/ambilmisi'); ?>",
				method: "POST",
				data: {
					visi: id
				},
				async: true,
				dataType: 'json',
				success: function(data) {

					var html = '';
					var i;
					html = '<option value="">Pilih..</option>';
					for (i = 0; i < data.length; i++) {
						html += '<option value="' + data[i].misi + '">' + '[ ' + data[i].kode_misi + ' ] ' + data[i].misi + '</option>';
					}
					$('#misi').html(html);

				}
			});
			return false;
		});
	});
</script>
<?= $this->endSection(); ?>