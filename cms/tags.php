<!DOCTYPE html>

<head>
<meta charset="UTF-8">
<title>Facciamo come...</title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<link href="http://fonts.googleapis.com/css?family=News+Cycle:400,700" rel="stylesheet" />
<link href="../css/default.css" rel="stylesheet" type="text/css" media="all" />
<link href="../css/fonts.css" rel="stylesheet" type="text/css" media="all" />

<?php

	$page = 'tags';

	require_once '../php/lib/meekrodb.2.2.class.php';
	require_once '../php/bootstrap.php';
	require_once('../php/helpers.php');
	require_once '../php/mod.tags.php';

	if (isset($_GET['delete']) and is_numeric($_GET['delete'])) call_user_func('Tags::delete_taggo', $_GET['delete']);
	if (Helpers::post('update')) Tags::update_tagghi();
	$tagghi = Tags::get_menu_tagghi();

?>

</head>
<body>

	<? include('header.php') ?>

	<div id="page" class="container cms">
		<p><a href="#" onclick="$('form#tagghi').submit()">Registra tutto</a></p>
		<form id="tagghi" action="#" method="post">
			<input name="update" value="1" type="hidden">
			<table width="100%" class="frasi instant-search">
				<thead>
					<tr>
						<th width="60">ID</th>
						<th>Tag</th>
						<th width="100">Templates</th>
						<th width="60">&nbsp;</th>
					</tr>
				</thead>
				<tbody>
					<? foreach ($tagghi as $taggo): ?>
						<tr>
							<td align="center"><?= $taggo['id'] ?></td>
							<td>
								<input type="text" name="taggo<?= $taggo['id'] ?>" style="width:98%" value="<?= htmlspecialchars($taggo['taggo']) ?>">
							</td>
							<td align="center"><?= $taggo['occorrenze'] ?></td>
							<td><a href="tags?delete=<?= $taggo['id'] ?>">Canc.</a></td>
						</tr>
					<? endforeach ?>
				</tbody>
				<input type="submit" style="visibility:hidden">
			</table>
		</form>
	</div>

	<script type="text/javascript" src="../js/jquery-1.11.0.min.js"></script>
	<script type="text/javascript" src="../js/jquery.instant-search.js"></script>

</body>
</html>