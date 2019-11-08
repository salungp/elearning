<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Elearning - Register!</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/style.css'); ?>">
</head>
<body>
<div class="auth-wrapper">
	<div class="form-wrapper">
		<h2 class="text-center mb-4">Sign up</h2>
		<?php echo $this->session->flashdata('message'); ?>
		<form action="<?php echo base_url('register/'.md5(uniqid()).md5(uniqid())); ?>" method="POST">
			<label class="d-block mb-2">
				<span>Nama</span>
				<input type="text" name="name" class="form-control" value="<?php echo set_value('name'); ?>" />
				<?php echo form_error('name', '<small class="text-danger mt-1">', '</small>'); ?>
			</label>

			<label class="d-block mb-2">
				<span>Email</span>
				<input type="text" name="email" class="form-control" />
				<?php echo form_error('email', '<small class="text-danger mt-1">', '</small>'); ?>
			</label>

			<label class="d-block mb-2">
				<span>Kelas</span>
				<div class="input-group">
					<select name="kelas_tingkat" class="form-control">
						<option>X</option>
						<option>XI</option>
						<option>XII</option>
					</select>
					<select name="kelas_jurusan" class="form-control">
						<option>RPL</option>
						<option>BDP</option>
						<option>OTKP</option>
						<option>TBSM</option>
						<option>AKL</option>
					</select>
					<select name="kelas_no" class="form-control">
						<option>1</option>
						<option>2</option>
						<option>3</option>
					</select>
				</div>
			</label>

			<label class="d-block mb-3">
				<span>Password</span>
				<input type="password" name="password" class="form-control" />
				<?php echo form_error('password', '<small class="text-danger mt-1">', '</small>'); ?>
			</label>

			<button type="submit" class="btn btn-primary w-100">Sign up</button>
			<div class="after-button">
				<hr /> Or <hr />
			</div>
			<a href="<?php echo base_url('login_page'); ?>" class="btn btn-success w-100">Sign in</a>
		</form>
	</div>
</div>
</body>
</html>