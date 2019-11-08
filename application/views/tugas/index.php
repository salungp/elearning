<div class="container pt-3 pb-3">
	<hr /><h2>Tugas</h2><hr />
	<p>List tugas yang menanti tolong segera kerjakan agar nilai tidak <strong>kosong!</strong>.</p>

	<?php if (count($data) < 1) : ?>
		<h6 style="color: #777;">Belum ada tugas</h6>
	<?php endif; ?>

	<div class="list-group">
	<?php foreach ($data as $key) : ?>
	<?php $author = $this->db->get_where('users', ['id' => $key['author']])->row_array(); ?>
	<div class="task-item">
		<p class="mb-1" style="color: #888;"><?php echo $author['name']; ?></p>
		<h5 class="mb-2"><?php echo $key['title']; ?></h5>
		<small style="font-size: 11px;color: #888;"><?php echo date('D M Y', strtotime($key['created_at'])); ?></small>
		<div><?php echo $key['description']; ?></div>
	</div>
	<?php endforeach; ?>
	</div>
</div>