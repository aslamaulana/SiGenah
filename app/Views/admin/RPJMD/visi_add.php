<?= $this->extend('_layout/template'); ?>

<?= $this->section('content'); ?>
<div class="card-body">
	<form action="<?= base_url('/admin/rpjmd/visi/visi_create') ?>" method="POST">
		<?= csrf_field() ?>
		<div class="row">
			<div class="col-md-2">
				<div class="form-group">
					<label>Kode Visi</label>
				</div>
			</div>
			<div class="col-md-10">
				<div class="form-group">
					<input type="text" name="kode_visi" class="form-control" value="<?= old('kode_visi'); ?>" maxlength="12" require>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-2">
				<div class="form-group">
					<label>Visi</label>
				</div>
			</div>
			<div class="col-md-10">
				<div class="form-group">
					<input type="text" name="visi" class="form-control <?= ($validation->hasError('visi')) ? 'is-invalid' : ''; ?>" maxlength="300" require>
					<span class="text-danger"><?= $validation->getError('visi'); ?></span>
				</div>
			</div>
		</div>
		<div class="card-footer">
			<button type="submit" class="btn btn-primary">Simpan</button>
		</div>
	</form>
</div>
<?= $this->endSection(); ?>