<?= $this->extend('_layout/template'); ?>

<?= $this->section('stylesheet'); ?>
<link rel="stylesheet" href="<?= base_url('/toping/plugins/select2/css/select2.min.css') ?>">
<link rel="stylesheet" href="<?= base_url('/toping/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') ?>">
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<div class="card-body">
	<form action="<?= base_url('/admin/rpjmd/sasaran/sasaran_update') ?>" method="POST">
		<?= csrf_field() ?>
		<input type="hidden" name="kode_sasaran_old" value="<?= $sasaran['kode_sasaran']; ?>">
		<input type="hidden" name="tujuan_old" value="<?= $sasaran['tujuan_n']; ?>">
		<input type="hidden" name="sasaran_old" value="<?= $sasaran['sasaran']; ?>">

		<div class="row">
			<div class="col-md-2">
				<div class="form-group">
					<label>Tujuan</label>
				</div>
			</div>
			<div class="col-md-10">
				<div class="input-group">
					<select name="tujuan" id="tujuan" class="form-control select2bs4 <?= ($validation->hasError('tujuan')) ? 'is-invalid' : ''; ?>">
						<option value="<?= $sasaran['tujuan_n']; ?>"><?= $sasaran['tujuan_n']; ?></option>
						<?php foreach ($tujuan as $row) : ?>
							<option value="<?= $row['tujuan']; ?>"><?= '[ ' . $row['kode_tujuan'] . ' ] ' . $row['tujuan']; ?></option>
						<?php endforeach; ?>
					</select>
					<span class="text-danger"><?= $validation->getError('tujuan'); ?></span>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-2">
				<div class="form-group">
					<label>Kode Sasaran <medium class="text-danger">*</medium></label>
				</div>
			</div>
			<div class="col-md-10">
				<div class="input-group">
					<input type="text" name="kode_sasaran" value="<?= $sasaran['kode_sasaran']; ?>" class="form-control" maxlength="12" require>
					<span class="text-danger"><?= $validation->getError('kode_sasaran'); ?></span>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-2">
				<div class="form-group">
					<label>Sasaran <medium class="text-danger">*</medium></label>
				</div>
			</div>
			<div class="col-md-10">
				<div class="input-group">
					<textarea name="sasaran" class="form-control <?= ($validation->hasError('sasaran')) ? 'is-invalid' : ''; ?>" required><?= $sasaran['sasaran']; ?></textarea>
					<span class="text-danger"><?= $validation->getError('sasaran'); ?></span>
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
<?= $this->endSection(); ?>