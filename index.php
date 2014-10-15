<!DOCTYPE html>

<head>
<? include('includes/head.php') ?>

<?php

	$page = 'generatore';

	require_once 'php/lib/meekrodb.2.2.class.php';
	require_once 'php/bootstrap.php';
	require_once 'php/mod.tags.php';
	require_once 'php/mod.generate.php';

	$generazioni = Generate::get_registro();
	$tagghi = Tags::get_menu_tagghi();

?>

</head>
<body>

<? include('includes/header.php') ?>

<div id="featured">
	<div class="container">

		<div class="title">
			<h2></h2>
		</div>
		<div style="text-align:center">
			<a href="image.php"><img src="images/download-48.png" title="Scarica sul PC" alt="Scarica sul PC"></a><!-- &nbsp;&nbsp;&nbsp;
			<a href="#"><img src="images/twitter-48.png"></a> -->
		</div>

		<!-- SHARE -->
		<div id="share">
			<a href="#" id="facebook" target="_blank"><img src="images/fb_condividi.png"></a> 
			<span id="tweet"></span>
		</div>
		
	</div>
	<ul class="actions">
		<li><a href="#" class="button generate">Click per generare</a></li>
		<div class="styled-select">
		   <select id="pickTaggoId">
		      	<option value="" selected="selected">Qualsiasi argomento</option>
		      	<? foreach ($tagghi as $key => $taggo): ?>
		      		<option value="<?= $taggo['id'] ?>"><?= $taggo['taggo'] ?> (<?= $taggo['occorrenze'] ?>)</option>
		  		<? endforeach ?>
		   </select>
		</div>
	</ul>

	<? if (isset($_GET['mode']) and $_GET['mode'] == 'custom'): ?>

		<h3>Personalizza</h3>

		<div class="container">

			<div class="personalizza">
				<table width="100%">
					<tr>
						<td width="160">Seleziona una <strong>frase</strong></td>
						<td>
							<input id="pickPhrase" type="text" value="Random" readonly="readonly">
							<input type="hidden" id="pickPhraseId">
						</td>
					</tr>
					<tr>
						<td>Seleziona un <strong>paese</strong></td>
						<td>
							<input id="pickCountry" type="text" value="Random" readonly="readonly">
							<input type="hidden" id="pickCountryId">
						</td>
					</tr>
					<tr>
						<td></td>
						<td>Dopo avere impostato i parametri, premere il tasto "Click per generare".</td>
					</tr>
				</table>
			</div>

		<? else: ?>

			<div class="container">

				<p>Sei italiano? Credi nell'Europa? Hai frequentato un prestigioso ateneo milanese? O meglio ancora, ti sei formato sugli editoriali di Eugenio? Nessuno meglio di te può sapere che la terribile crisi economica e sociale che sta attanagliando il nostro paese ha <strong>un solo colpevole</strong>: <strong>noi, gli italiani</strong>. Egoisti, corrotti, improduttivi. Per 20 anni abbiamo votato Berlusconi vivendo di rendita e accumulando debiti, come la proverbiale cicala. E oggi, invece di recitare un <strong>doveroso mea culpa</strong>, ci lamentiamo del Governo (che fa del suo meglio), dell'Europa (che ci ha accolto nonostante fossimo poco credibili) e <strong>finanche dell'euro</strong> (che ci protegge dagli spekulatori kattivi).</p>

				<p>Questo strumento è stato pensato per te, che lotti solitario contro <strong>un popolo che non ti merita</strong>. Un popolo ingrato che non capisce che il tempo delle fiabe è finito ed è ora di diventare adulti abbracciando un modello economico che sia <strong>allaltezzadellesfidepoliticheesocialidellaglobalità</strong>. Le frasi che troverai su questa pagina ti aiuteranno a far sapere agli amici, ai compagni di impegno politico, ai parenti e (soprattutto) agli avventori del bar sottocasa, <strong>quanto ti fa schifo il paese in cui vivi</strong>. Anche se non sai nulla di ciò che accade nel mondo - o non sai nulla in genere - che ti frega: l'Italia è sicuramente la peggiore tra le nazioni ed essere italiani è una vergogna. Basta nascondersi. <strong>È giusto che tutti lo sappiano!</strong></p>

			</div>

		<? endif ?>

		<p><strong>Facciamocome&trade;</strong> è un generatore random di supercazzole esterofile e piddine. Dal 07/02/2014 abbiamo generato <strong><?= number_format($generazioni, 0, ',', '.') ?></strong> frasi.</p>

	</div>

</div>

<? include('includes/footer.php') ?>

<script type="text/javascript" src="js/jquery-1.11.0.min.js"></script>
<script type="text/javascript" src="js/jquery.colorbox.js"></script>
<script type="text/javascript" src="js/app.js"></script>

</body>
</html>
