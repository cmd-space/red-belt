<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Login/Registration</title>
	<link rel="stylesheet" href="/assets/stylesheets/style.css">
</head>
<body>
	<h1>Welcome!</h1>
	<div id='register'>
		<h3>Register</h3>
<?php
	if($this->session->flashdata('register_errors')) {
		foreach($this->session->flashdata('register_errors') as $errors) {
			echo '<span class="errors">'.$errors.'</span>';
		}
	}
?>
		<form action="/welcomes/validate" method="post">
			<p><label for="name">Name: </label>
			<input type="text" name="name"></p>
			<p><label for="alias">Alias: </label>
			<input type="text" name="alias"></p>
			<p><label for="email">Email: </label>
			<input type="text" name='email'></p>
			<p><label for="password">Password: </label>
			<input type="password" name='password'></p>
			<p>*Password should be at least 8 characters</p>
			<p><label for="confirm_password">Confirm PW: </label>
			<input type="password" name='confirm_password'></p>
			<p><label for="birth">Date of Birth (MM/DD/YYYY): </label>
			<input type="text" name="birth"></p>
			<input type="hidden" name="register" value="yes">
			<input type="submit" value="Register">
		</form>
	</div>
	<div id='login'>
		<h3>Login</h3>
<?php
	if($this->session->flashdata('login_errors')) {
		foreach($this->session->flashdata('login_errors') as $errors) {
			echo '<span class="errors">'.$errors.'</span>';
		}
	}
?>
		<form action="/welcomes/validate" method="post">
			<p><label for="email">Email: </label>
			<input type="text" name="email"></p>
			<p><label for="password">Password: </label>
			<input type="password" name="password"></p>
			<input type="hidden" name="login" value="yes">
			<input type="submit" value="Login">
		</form>
	</div>
</body>
</html>