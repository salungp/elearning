<div class="container pt-3 pb-3">
	<hr /><h2>Video</h2><hr />
	<form action="<?php echo base_url('cari_video'); ?>" method="GET" class="mb-4">
		<div class="row">
			<div class="col-md-6">
				<div class="input-group">
					<input type="text" name="key" class="form-control" placeholder="Cari video" style="border-top-right-radius: 0;border-bottom-right-radius: 0;">
					<button type="submit" class="btn btn-success" style="border-top-left-radius: 0;border-bottom-left-radius: 0;">Cari</button>
				</div>
			</div>
		</div>
		<div class="mt-2">Total video : <?php echo count($data); ?></div>
	</form>

	<?php if (count($data) < 1 && !@$cari) : ?>
		<h3 style="color: #888;">Video masih kosong!</h3>
	<?php elseif (count($data) < 1 && @$cari) : ?>
		<h3 style="color: #888;">Tidak ada hasil dari '<strong><?php echo @$cari; ?></strong>'</h3>
	<?php endif; ?>

	<div class="row">
		<?php foreach ($data as $key) : ?>
			<?php $author = $this->db->get_where('users', ['id' => $key['author']])->row_array(); ?>
			<div class="col-md-4 col-xs-6">
				<a class="video-item" href="<?php echo base_url('watch/'.$key['slug']); ?>">
					<div class="thumb">
						<img src="<?php echo base_url($key['link_thumbnail']); ?>" alt="Thumbnail video" />
					</div>
					<div class="video-description">
						<div class="date-video"><?php echo date('D M Y', strtotime($key['created_at'])); ?></div>
						<h3><?php echo strlen($key['title']) > 31 ? substr($key['title'], 0, 32).'...' : $key['title']; ?></h3>
						<div class="video-author"><?php echo $author['name']; ?></div>
					</div>
				</a>
			</div>
		<?php endforeach; ?>
	</div>
</div>