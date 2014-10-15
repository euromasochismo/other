<!DOCTYPE html>

<head>
<? include('includes/head.php') ?>

<?php

	$page = 'api';

	require_once 'php/lib/meekrodb.2.2.class.php';
	require_once 'php/bootstrap.php';
	require_once 'php/mod.api.php';

	$countries = API::country_list();
	$tagghi = API::tagghi_list();

?>

</head>
<body>
<? include('includes/header.php') ?>

<div id="api">

	<div class="container">

		<p>API v. 0.2 10/02/2014</p>

		<div class="title">
			<h3>Generazione frasi</h3>
		</div>

		<p>L'indirizzo:</p>
		<div class="code">
			http://facciamocome.org/generate
		</div>
		<p>restituisce un JSON in formato UTF8 con parametri random, del tipo:</p>
		<div class="code">
			{"phrase":"In Albania c'\u00e8 meno debito pubblico perch\u00e9 ci sono meno auto blu.","id":"47","color":"222222"}
		</div>
		<p>È possibile personalizzare i parametri nella URL come valori GET:</p>
		<table>
			<tr>
				<td width="150"><strong>template</strong></td>
				<td>(int) ID della frase</td>
			</tr>
			<tr>
				<td><strong>country</strong></td>
				<td>(int) ID del paese</td>
			</tr>
			<tr>
				<td><strong>tag</strong></td>
				<td>(int) ID del tag</td>
			</tr>
		</table>
		<p>&nbsp;</p>

		<p>Il <strong>template ID</strong> si può recuperare in diversi modi, ma il più semplice è scaricando il <a href="il-libro.php"></a>libro</a> con tutte le frasi precedute dal rispettivo ID. I <strong>country ID</strong> e i <strong>tag ID</strong> sono elencati alla fine di questa pagina.</p>

		<p><u>Attenzione:</u> Il template ID sovrascrive il tag ID nel caso in cui fossero (erroneamente) presenti entrambi nella stringa.</p>

		<p>Esempi di richieste sintatticamente valide:</p>
		<div class="code">
			http://facciamocome.org/generate?template=20<br>
			http://facciamocome.org/generate?country=12<br>
			http://facciamocome.org/generate?template=20&country=12<br>
			http://facciamocome.org/generate?country=192&tag=5
		</div>

		<p>I parametri non specificati sono estratti in modo pseudocasuale dal sistema.</p>

		<div class="title">
			<h3>Generazione immagini</h3>
		</div>

		<p>Il sistema registra le proprietà dell'ultima frase generata ad ogni richiesta. Pertanto, dopo ogni generazione (attraverso API o semplicemente da interfaccia grafica) è possibile chiamare l'indirizzo:</p>

		<div class="code">
			http://facciamocome.org/image
		</div>

		<p>per scaricare l'immagine sul disco rigido.</p>
		<p>La funzione image supporta due parametri opzionali:</p>

		<table>
			<tr>
				<td width="150"><strong>color</strong></td>
				<td>(hex) colore dello sfondo</td>
			</tr>
			<tr>
				<td><strong>filetype</strong></td>
				<td>(str) "png" (default) opp. "jpeg" (raccomandato per post su facebook)</td>
			</tr>
		</table>
		<p>&nbsp;</p>

		<p>Esempi di richieste sintatticamente valide:</p>
		<div class="code">
			http://facciamocome.org/image?color=b70094 // Sfondo viola<br>
			http://facciamocome.org/image?filetype=jpeg // Raccomandato su Facebook<br>
			http://facciamocome.org/image?color=f5dc30&filetype=png
		</div>

		<div class="title">
			<h3>Country & Tag IDs</h3>
		</div>

		<table style="font-size:0.8em">
			<tr>
				<!-- COUNTRY LIST -->
				<td width="300" style="vertical-align:top">
					<? foreach ($countries as $country): ?>
						<?= $country['nome'] ?> [<?= $country['id'] ?>]<br>
					<? endforeach ?>
				</td>
				<!-- TAG LIST -->
				<td style="vertical-align:top">
					<? foreach ($tagghi as $taggo): ?>
						<?= $taggo['taggo'] ?> [<?= $taggo['id'] ?>]<br>
					<? endforeach ?>
				</td>
			</tr>
		</table>

	</div>

</div>

<? include('includes/footer.php') ?>

<script type="text/javascript" src="js/jquery-1.11.0.min.js"></script>

</body>
</html>
