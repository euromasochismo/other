<!DOCTYPE html>

<head>
<meta charset="UTF-8">
<title>Facciamo come...</title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<link href="http://fonts.googleapis.com/css?family=News+Cycle:400,700" rel="stylesheet" />
<link href="css/default.css" rel="stylesheet" type="text/css" media="all" />
<link href="css/fonts.css" rel="stylesheet" type="text/css" media="all" />

<!--[if IE 6]><link href="default_ie6.css" rel="stylesheet" type="text/css" /><![endif]-->

<?php

	require_once 'php/lib/meekrodb.2.2.class.php';
	require_once 'php/bootstrap.php';
	require_once 'php/mod.cms.php';

	if (isset($_GET['action']) and in_array($_GET['action'], array('insert', 'update', 'delete'))) call_user_func('CMS::'.$_GET['action']);

	$templates = CMS::get_templates();

?>

</head>
<body>

<div id="page" class="container" style="display:none">
	<div class="table">
		<h4>Aggiungi nuova</h4>
		<form action="<?= $_SERVER['PHP_SELF'] ?>?action=insert" method="post">
			<input type="text" name="nuova" style="width:98%">
			<input type="submit" style="visibility:hidden">
		</form>
		<p>&nbsp;</p>
		<form action="<?= $_SERVER['PHP_SELF'] ?>?action=update" method="post">
			<input type="hidden" name="update" value="1">
			<table width="100%">
				<thead>
					<tr>
						<th width="30">ID</th>
						<th width="60">Attivo</th>
						<th align="left">Frase</th>
						<th width="160" align="left">Autore</th>
						<th width="100" align="left">Data</th>
						<th width="70">Attivo</th>
					</tr>
				</thead>
				<tbody>
					<? foreach ($templates as $template): ?>
					<tr>
						<td><?= $template['id'] ?></td>
						<td><input type="checkbox" name="attivo<?= $template['id'] ?>" <?= ($template['attivo']) ? 'checked' : '' ?> value="1"></td>
						<td align="left">
							<input type="text" name="frase<?= $template['id'] ?>" value="<?= htmlspecialchars($template['frase']) ?>" style="width:99%">
						</td>
						<td align="left">
							<input type="text" name="autore<?= $template['id'] ?>" value="<?= htmlspecialchars($template['autore']) ?>" style="width:99%">
						</td>
						<td align="left">
							<input type="text" name="quando<?= $template['id'] ?>" value="<?= htmlspecialchars($template['f_quando']) ?>" style="width:99%">
						</td>
						<td><a href="<?= $_SERVER['PHP_SELF'] ?>?action=delete&id=<?= $template['id'] ?>">Canc</a></td>
					</tr>
					<? endforeach ?>
				</tbody>
			</table>
			<input type="submit" style="visibility:hidden">
		</form>
	</div>
</div>

<div id="copyright" class="container">
	<p>Copyright (c) 2014 <a href="https://twitter.com/EuroMasochismo" target="_blank">Euro-Masochismo</a>. | Design inspired by <a href="http://www.freecsstemplates.org/" rel="nofollow">FreeCSSTemplates.org</a>.</p>
</div>

<script type="text/javascript" src="js/jquery-1.11.0.min.js"></script>
<script type="text/javascript" src="js/cms.js"></script>

</body>
</html>
