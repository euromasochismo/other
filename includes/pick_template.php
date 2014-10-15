<?php

if (!(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest' ))) exit();

require_once '../php/lib/meekrodb.2.2.class.php';
require_once '../php/bootstrap.php';
require_once '../php/helpers.php';
require_once '../php/mod.api.php';
require_once '../php/mod.generate.php';

$templates = Generate::get_templates();

?>

<div id="picker">

	
	<table id="testata">
		<tr>
			<td><h3>Seleziona una frase</h3></td>
			<td align="right"><input type="text" class="instant-search" placeholder="Cerca..." id="campoCerca"></td>
		</tr>
	</table>
	<!-- <div>
		<h2 class="titolo" style="float:left">Seleziona una frase</h2>
		<input type="text" placeholder="Cerca..." style="float:right">
	</div> -->
	

	<table width="100%" id="lista" class="instant-search" itemType="Phrase">
		<tr>
			<td idItem=''><strong>Random</strong></td>
		</tr>
		<? foreach ($templates as $template): ?>
		<tr>
			<td idItem="<?= $template['id'] ?>"><?= $template['frase'] ?></td>
		</tr>
		<? endforeach ?>
	</table>

</div>

<script type="text/javascript" src="js/jquery.instant-search.js"></script>
<script type="text/javascript" src="js/picker.js"></script>

