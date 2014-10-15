<!DOCTYPE html>

<head>
<? include('includes/head.php') ?>

<?php
	
	$page = 'libro';

?>

</head>
<body>
<? include('includes/header.php') ?>

<div id="libro">

	<div class="container">

		<div class="title">
			<h3>Libro autogenerato</h3>
		</div>

		<table>
			<tr>
				<td width="280"><img src="images/copertina_libro.png" width="250"></td>
				<td style="vertical-align:top">
					<p>Il <strong>Prontuario di supercazzole esterofile e piddine</strong> è un presidio tecnico appositamente studiato per:</p>
					<ul class="elenco">
						<li>Opinionisti piddini in trasferta televisiva</li>
						<li>Giornalisti e autori in crisi di ispirazione</li>
						<li>Studenti delle facoltà di Economia e Scienze Politiche</li>
					</ul>
					<p>Il prontuario è generato in formato PDF pronto per la stampa. Contiene tutte le frasi presenti nel database al momento del download, con i nomi delle nazioni estratti in modo pseudocasuale.</p>
					<p>Ogni edizione è pertanto <strong>unica e numerata</strong>.</p>
					<p>Strumento indispensabile per chi ha fatto dell'autorazzismo una professione, ma anche simpatica idea regalo. <strong>Novità</strong>: da oggi con una <strong>prefazione di Piller&amp;Gümpel</strong>. Scaricalo: è gratis!</p>
				</td style="vertical-align:top">
			</tr>
		</table>

		<ul class="actions">
			<li><a href="libro/libro_generate" target="_blank" class="button generate">Scarica il libro</a></li>
		</ul>

	</div>
</div>

<? include('includes/footer.php') ?>

</body>
</html>
