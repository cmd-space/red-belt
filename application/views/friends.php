<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Friends</title>
	<link rel="stylesheet" href="/assets/stylesheets/style.css">
</head>
<body>
	<a href="/welcomes/destroy" class='logout'>Logout</a>
	<h1>Hello, <?= $name ?></h1>
	<h3>Here is the list of your friends:</h3>
	<div id='friends'>
		<table>
			<tr class='t-head'>
				<td>Alias</td>
				<td>Action</td>
			</tr>
<?php
	if(!empty($friends)) {
		foreach($friends as $friend) {
			
		}
	}
?>
		</table>
	</div>
	<h3>Other Users not on your friend's list:</h3>
	<div id='not-friends'>
		<table>
			<tr class='t-head'>
				<td>Alias</td>
				<td>Action</td>
			</tr>
<?php
	if(!empty($not_friends)) {
		foreach($not_friends as $not) {
			echo '<tr><td><a href="/welcomes/user/'.$not['id'].'">'.$not['alias'].'</a></td><td><button><a href="/welcomes/add_friend/'.$not['id'].'" class="button">Add as Friend</a></button></td></tr>';
		}
	}
?>
		</table>
	</div>
</body>
</html>