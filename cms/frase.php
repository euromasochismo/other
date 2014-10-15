<?php

if (!(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest' ))) exit();

require_once '../php/lib/meekrodb.2.2.class.php';
require_once '../php/bootstrap.php';
require_once '../php/helpers.php';
require_once '../php/mod.tags.php';
require_once '../php/mod.cms.php';

$template = Cms::get_template($_GET['id']);
$tagghi = json_encode(Tags::get_list_tagghi());

?>

<div class="cms-edit">

	<form id="form-edit" method="post" action="frasi">
	<input type="hidden" name="edit" value="1">
	<input type="hidden" name="id" value="<?= $template['id'] ?>">

	<table id="modulo">
		<!-- FRASE -->
		<tr>
			<td width="100">Frase</td>
			<td>
				<textarea rows="3" style="width:800px" name="frase"><?= $template['frase'] ?></textarea>
			</td>
		</tr>
		<!-- ATTIVO -->
		<tr>
			<td>Attivo</td>
			<td>
				<input type="checkbox" name="attivo" <?= ($template['attivo']) ? 'checked' : '' ?> value="1">
			</td>
		</tr>
		<!-- AUTORE -->
		<tr>
			<td>Autore</td>
			<td>
				<input type="text" name="autore" style="width:800px" value="<?= htmlspecialchars($template['autore']) ?>">
			</td>
		</tr>
		<!-- DATA -->
		<tr>
			<td>Data</td>
			<td>
				<input type="text" name="quando" value="<?= htmlspecialchars($template['quando']) ?>">
			</td>
		</tr>
		<!-- TAGS -->
		<tr>
			<td>Tags</td>
			<td><input type="text" name="tagghi" value="<?= htmlspecialchars(implode(';', $template['tagghi'])) ?>" id="widget2" /></td>
		</tr>
	</table>

	<input type="submit" style="visibility:hidden">

	</form>

	<p style="text-align:right">
		<? if (is_numeric($template['id'])): ?><a href="frasi?delete=<?= $template['id'] ?>">Elimina</a><? endif ?>
		<a href="#" id="edit-salva" template-id="<?= $template['id'] ?>">Salva</a>
	</p>

</div>

<script type="text/javascript" src="../js/cms_edit.js"></script>

<script type="text/javascript">
	$("#widget2").inputosaurus({
		width : "500px",
		autoCompleteSource : <?= $tagghi ?>,
		activateFinalResult : true,
		outputDelimiter: ";",
		inputDelimiters: [";"],
		change : function(ev) {
			// $('#widget2_reflect').val(ev.target.value);
		}
	});
</script>

