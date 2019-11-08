<div class="container pt-3 pb-3">
	<hr /><h3>Tambah tugas</h3><hr />

	<?php echo $this->session->flashdata('message'); ?>
	<?php echo @$error ? '<div class="alert alert-danger">'.@$error : ''; ?>

	<form action="<?php echo base_url('tugas/store'); ?>" method="POST" enctype="multipart/form-data">
		<label class="d-block mb-3">
			<span>Judul tugas</span>
			<input type="text" name="title" class="form-control">
			<?php echo form_error('title', '<small class="text-danger">', '</small>'); ?>
		</label>

		<label class="d-block mb-3">
			<span>Deskripsi tugas</span>
			<textarea name="description" class="form-control"></textarea>
		</label>

		<label class="d-block mb-3">
			<span>File</span>
			<input type="file" name="file" class="form-control" placeholder="Kalo ada">
		</label>

		<button type="submit" class="btn btn-success">Kirim</button>
	</form>
</div>