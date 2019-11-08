<div class="container pt-3 pb-3">
	<hr /><h2>Upload video</h2><hr />
	<p style="color: #888;">Masukkan judul, deskripsi thumnaildan file videonya.</p>

	<?php echo $this->session->flashdata('message'); ?>
	<?php echo @$error ? '<div class="alert alert-danger">'.@$error.'</div>' : ''; ?>

	<div class="row">
		<div class="col-md-6">
			<form action="<?php echo base_url('video/store'); ?>" method="POST" enctype="multipart/form-data">
				<label class="d-block mb-3">
					<b>Judul</b>
					<input type="text" name="title" class="form-control">
					<?php echo form_error('title', '<small class="text-danger">', '</small>'); ?>
				</label>

				<label class="d-block mb-3">
					<b>Deskripsi</b>
					<textarea name="description" class="form-control"></textarea>
					<?php echo form_error('description', '<small class="text-danger">', '</small>'); ?>
				</label>

				<label class="d-block mb-3">
					<b>Thumbnail video</b>
					<input type="file" name="link_thumbnail" class="form-control" required>
				</label>

				<button type="submit" class="btn btn-success">Upload</button>
			</form>
		</div>
	</div>
</div>