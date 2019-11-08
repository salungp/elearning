<div class="container pt-3 pb-3">
	<hr /><h2>Upload video</h2><hr />
	<p style="color: #888;">Masukkan file video</p>

	<?php echo $this->session->flashdata('message'); ?>
	<?php echo @$error ? '<div class="alert alert-danger">'.@$error.'</div>' : ''; ?>

	<div class="row">
		<div class="col-md-6">
			<form action="<?php echo base_url('video/upload/'.$id); ?>" method="POST" enctype="multipart/form-data">
				<label class="d-block mb-3">
					<b>Video</b>
					<input type="file" name="link_video" class="form-control" required>
				</label>

				<button type="submit" class="btn btn-success">Upload</button>
			</form>
		</div>
	</div>
</div>