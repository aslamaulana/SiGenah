<?= $this->extend('_layout/template'); ?>
<?= $this->section('content'); ?>
<div class="card-body">
	<table class="table table-bordered">
		<tr>
			<td class="col-md-2">Visi:</td>
			<td class="col-md-10"><?= $visi['visi']; ?></td>
		</tr>
	</table><br>
	<form action="<?= base_url('/admin/rpjmd/visi/misi_create') ?>" method="POST">
		<?= csrf_field() ?>
		<div class="row">
			<div class="col-md-2">
				<div class="form-group">
					<label>Kode Misi</label>
				</div>
			</div>
			<div class="col-md-10">
				<div class="form-group">
					<input type="text" name="kode_misi" class="form-control" value="<?= old('kode_misi'); ?>" maxlength="12" require>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-2">
				<div class="form-group">
					<label>Misi</label>
				</div>
			</div>
			<div class="col-md-10">
				<div class="form-group">
					<input type="hidden" name="visi" value="<?= $visi['visi']; ?>">
					<input type="text" name="misi" class="form-control <?= ($validation->hasError('misi')) ? 'is-invalid' : ''; ?>" maxlength="300" require>
					<span class="text-danger"><?= $validation->getError('misi'); ?></span>
				</div>
			</div>
		</div>
		<div class="card-footer">
			<button type="submit" class="btn btn-primary">Simpan</button>
		</div>
	</form>
</div>
<?= $this->endSection(); ?>