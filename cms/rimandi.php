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
	
	$page = 'rimandi';

	require_once '../php/lib/meekrodb.2.2.class.php';
	require_once '../php/bootstrap.php';
	require_once('../php/helpers.php');
	require_once '../php/mod.tags.php';

	if (isset($_GET['action']) and $_GET['action'] == 'nuovo') Tags::add_rimando();
	if (isset($_GET['delete']) and is_numeric($_GET['delete'])) Tags::delete_rimando($_GET['delete']);
	if (Helpers::post('update')) Tags::update_rimandi();

	$tagghi = Tags::get_menu_tagghi();
	$rimandi = Tags::get_rimandi();

?>

</head>
<body>

	<? include('header.php') ?>

	<div id="page" class="container cms">
		<p>
			<a href="rimandi?action=nuovo">Aggiungi nuovo</a> | 
			<a href="#" onclick="$('form#rimandi').submit()">Registra tutto</a>
		</p>
		<form id="tagghi" action="rimandi" method="post">
			<input name="update" value="1" type="hidden">
			<table width="100%" class="frasi instant-search">
				<thead>
					<tr>
						<th width="60">ID</th>
						<th>Rimando</th>
						<th width="300">Tag</th>
						<th width="100">&nbsp;</th>
					</tr>
				</thead>
				<tbody>
					<? foreach ($rimandi as $rimando): ?>
						<tr>
							<td align="center"><?= $rimando['id'] ?></td>
							<td>
								<input type="text" name="taggo<?= $rimando['id'] ?>" style="width:98%" value="<?= htmlspecialchars($rimando['taggo']) ?>">
							</td>
							<td>
								<select name="rimando<?= $rimando['id'] ?>">
							      	<? foreach ($tagghi as $key => $taggo): ?>
							      		<option value="<?= $taggo['id'] ?>" <?= ($taggo['id'] == $rimando['rimando']) ? 'selected' : '' ?>><?= $taggo['taggo'] ?></option>
							  		<? endforeach ?>
							   </select>
							</td>
							<td>
								<a href="rimandi?delete=<?= $rimando['id'] ?>">Cancella</a>
							</td>
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