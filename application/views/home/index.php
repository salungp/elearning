<?php $user = $this->db->get_where('users', ['id' => $this->session->userdata('user_id')])->row_array(); ?>
<div class="container pt-3 pb-3">
	<hr /><h2>Selamat datang <?php echo $user['name']; ?></h2><hr />

	<?php if ($user['role_id'] == 1) : ?>
		<h4 class="mt-4">Data video</h4>
		<?php echo $this->session->flashdata('message'); ?>

		<?php if (count($video) < 1) : ?>
			<h6 style="color: #777;">Belum ada video</h6>
		<?php endif; ?>

		<ul class="list-group">
			<?php foreach ($video as $key) : ?>
			  	<li class="list-group-item d-flex align-items-center" style="position: relative;">
			    	<?php echo $key['title']; ?>
			    	<span style="display: inline-block;width: 5px;height: 5px;border-radius: 50%;background: #333;margin: 0 10px;"></span>
			    	<?php echo date('D M Y', strtotime($key['created_at'])); ?>
			    	<div class="button-wrapper" style="position: absolute;right: 20px;">
				    	<a href="<?php echo base_url('edit_video/'.$key['id']); ?>" class="badge badge-primary badge-pill">Edit</a>
				    	<a href="<?php echo base_url('delete_video/'.$key['id']); ?>" class="badge badge-danger badge-pill" onclick="return confirm('Yakin mau dihapus?');">Delete</a>
			    	</div>
			  	</li>
		 	<?php endforeach; ?>
		</ul>
	<?php endif; ?>
</div>