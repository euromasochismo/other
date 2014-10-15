<?php

if (!(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest' ))) exit();

require_once '../php/lib/meekrodb.2.2.class.php';
require_once '../php/bootstrap.php';
require_once '../php/helpers.php';
require_once '../php/mod.api.php';

$countries = API::country_list();
echo $page;

?>

<div id="picker">
	
	<table id="testata">
		<tr>
			<td><h3>Seleziona un paese</h3></td>
			<td align="right"><input type="text" class="instant-search" placeholder="Cerca..." id="campoCerca"></td>
		</tr>
	</table>
	<!-- <div>
		<h2 class="titolo" style="float:left">Seleziona una frase</h2>
		<input type="text" placeholder="Cerca..." style="float:right">
	</div> -->
	

	<table width="100%" id="lista" class="instant-search" itemType="Country">
		<tr>
			<td idItem=''><strong>Random</strong></td>
		</tr>
		<? foreach ($countries as $country): ?>
		<tr>
			<td idItem="<?= $country['id'] ?>"><?= $country['nome'] ?></td>
		</tr>
		<? endforeach ?>
	</table>

</div>

<script type="text/javascript" src="js/jquery.instant-search.js"></script>
<script type="text/javascript" src="js/picker.js"></script>

