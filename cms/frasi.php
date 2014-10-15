<!DOCTYPE html>

<head>
<meta charset="UTF-8">
<title>Facciamo come...</title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<link href="http://fonts.googleapis.com/css?family=News+Cycle:400,700" rel="stylesheet" />
<link href="../css/default.css" rel="stylesheet" type="text/css" media="all" />
<link href="../css/fonts.css" rel="stylesheet" type="text/css" media="all" />
<link href="../css/colorbox.css" rel="stylesheet" type="text/css" media="all" />

<!-- <link href="https://netdna.bootstrapcdn.com/twitter-bootstrap/2.2.1/css/bootstrap.no-responsive.no-icons.min.css" rel="stylesheet"> -->
<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.0/themes/smoothness/jquery-ui.css" rel="stylesheet">
<link href="../css/inputosaurus.css" rel="stylesheet">

<?php

	$page = 'frasi';

	require_once '../php/lib/meekrodb.2.2.class.php';
	require_once '../php/bootstrap.php';
	require_once('../php/helpers.php');
	require_once '../php/mod.tags.php';
	require_once '../php/mod.cms.php';

	// INSERT, UPDATE
	if (Helpers::post('edit')) call_user_func('CMS::edit', Helpers::post('id'));
	
	// DELETE
	if (isset($_GET['delete']) and is_numeric($_GET['delete'])) call_user_func('CMS::delete', $_GET['delete']);

	$templates = CMS::get_templates();

?>

</head>
<body>

	<? include('header.php') ?>

	<div id="page" class="container cms">
		<p><a href="#" id="aggiungi-nuova">Aggiungi nuova</a></p>
		<p style="text-align:right"><input size="45" placeholder="Cerca" class="instant-search"></p>
		<table width="100%" class="frasi instant-search">
			<thead>
				<tr>
					<th width="30">ID</th>
					<th width="60">Attivo</th>
					<th align="left">Frase</th>
				</tr>
			</thead>
			<tbody>
				<? foreach ($templates as $template): ?>
					<tr>
						<td><a href="#" class="edit" template-id="<?= $template['id'] ?>"><?= $template['id'] ?></a></td>
						<td style="text-align:center"><?= ($template['attivo']) ? 'Sì' : '' ?></td>
						<td>
							<?= $template['frase'] ?><br>
							<span class="tagghi"><?= implode(' + ', $template['tagghi']) ?></span>
						</td>
					</tr>
				<? endforeach ?>
			</tbody>
		</table>
	</div>

	<script type="text/javascript" src="../js/jquery-1.11.0.min.js"></script>
	<script type="text/javascript" src="../js/jquery.colorbox.js"></script>
	<script type="text/javascript" src="../js/jquery.instant-search.js"></script>
	<script type="text/javascript" src="../js/cms.js"></script>

	<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.9.1/jquery-ui.min.js"></script>
	<script type="text/javascript" src="../js/inputosaurus.js"></script>

</body>
</html>