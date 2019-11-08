<?php $author = $this->db->get_where('users', ['id' => $video['author']])->row_array(); ?>
<div class="container pt-3 pb-3">
	<div class="row">
		<div class="col-md-8">
			<div class="video-wrapper">
				<div class="video">
					<video controls autoplay="on">
						<source src="<?php echo base_url('users/videos/'.$video['link_video']); ?>" type="video/mp4">
					</video>
				</div>
				<div class="date-video"><?php echo date('D M Y', strtotime($video['created_at'])); ?></div>
				<h3><?php echo $video['title']; ?></h3>
				<hr />
					<div class="profile">
						<div class="profile-picture">
							
						</div>
						<h4 style="color: #777"><?php echo $author['name']; ?></h4>
					</div>
				<hr />
				<h5>Deskripsi</h5>
				<p class="pl-3" style="color: #666"><?php echo $video['description']; ?></p>
			</div>
		</div>
		<div class="col-md-4">
			<?php foreach ($data as $key) : ?>
				<?php $author_single = $this->db->get_where('users', ['id' => $key['author']])->row_array(); ?>
				<a class="video-list" href="<?php echo base_url('watch/'.$key['slug']); ?>">
					<div class="thumbnail">
						<img src="<?php echo base_url($key['link_thumbnail']); ?>" alt="Thumbnail video" />
					</div>
					<div class="text">
						<small><?php echo date('D M Y', strtotime($key['created_at'])); ?></small>
						<h3><?php echo $key['title']; ?></h3>
						<div class="video-author"><?php echo $author_single['name']; ?></div>
					</div>
				</a>
			<?php endforeach; ?>
		</div>
	</div>
</div>