<?php $user = $this->db->get_where('users', ['id' => $this->session->userdata('user_id')])->row_array(); ?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container" style="position: relative;">
    <a class="navbar-brand" href="<?php echo base_url(); ?>">Elearning</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="<?php echo base_url('tugas'); ?>">Tugas</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo base_url('video'); ?>">Video</a>
        </li>
        <li class="nav-item" style="position: absolute;right: 0;">
          <a class="nav-link" href="<?php echo base_url('logout'); ?>">Keluar</a>
        </li>
        <?php if ($user['role_id'] == 1) : ?>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url('add_video'); ?>">Upload video</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url('add_task'); ?>">Tambah tugas</a>
          </li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>