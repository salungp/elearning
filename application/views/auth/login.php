<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Elearning - Harap login terlebih dahulu!</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/style.css'); ?>">
</head>
<body>
<div class="auth-wrapper">
	<div class="form-wrapper">
		<h2 class="text-center mb-4">Sign in</h2>
		<?php echo $this->session->flashdata('message'); ?>
		<form action="<?php echo base_url('login/'.md5(uniqid()).md5(uniqid())); ?>" method="POST">
			<div class="input-group-custom mb-4">
				<input type="text" name="email" class="form-control username" placeholder="Email">
				<input type="password" name="password" class="form-control password" placeholder="Password">
			</div>
			<button type="submit" class="btn btn-primary w-100">Sign in</button>
			<div class="after-button">
				<hr /> Or <hr />
			</div>
			<a href="<?php echo base_url('register_page'); ?>" class="btn btn-success w-100">Sign up</a>
		</form>
	</div>
</div>
</body>
</html>