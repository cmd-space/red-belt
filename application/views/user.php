<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?= $alias ?></title>
	<link rel="stylesheet" href="/assets/stylesheets/style.css">
</head>
<body>
	<ul class='logout' id='user-anchor'>
		<li><a href="/welcomes/friends">Home</a></li>
		<li><a href="/welcomes/destroy">Logout</a></li>
	</ul>
	<h1><?= $alias ?>'s Profile</h1>
	<h3>Name: <?= $name ?></h3>
	<h3>Email Address: <?= $email ?></h3>
</body>
</html>