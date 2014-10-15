<!DOCTYPE html>

<head>
<? include('includes/head.php') ?>

<?php

	$page = 'contributi';

	require_once 'php/lib/meekrodb.2.2.class.php';
	require_once 'php/bootstrap.php';
	require_once 'php/helpers.php';
	require_once 'php/mod.generate.php';
	require_once 'php/mod.log.php';

	$stats = Log::get_stats();
	$templates = Log::get_contributi();

?>

</head>
<body>
<? include('includes/header.php') ?>

<div class="container" style="padding:3em">
	<div class="title">
		<h3>Contributi degli utenti</h3>
	</div>
	<p>Facciamo come è un progetto aperto. <!-- Il <strong>logo</strong> del sito è opera di Carlo Max Botta (<a href="https://twitter.com/BottaAdv" target="_blank">@BottaAdv</a>.--></p>
	<p>Ci sono <strong><?= $stats['template_totali'] ?></strong> frasi in database (di cui <strong><?= $stats['template_attivi'] ?></strong> attive). Puoi contribuire al frasario esterofilo e piddin-montiano inviando le tue frasi all'hashtag twitter <a href="https://twitter.com/search?q=%23facciamocome&src=hash" accesskey="3" title="#facciamocome" target="_blank">#facciamocome</a> oppure all'email <a href="mailto:&#105;&#110;&#102;&#111;&#064;&#102;&#097;&#099;&#099;&#105;&#097;&#109;&#111;&#099;&#111;&#109;&#101;&#046;&#111;&#114;&#103;">&#105;&#110;&#102;&#111;&#064;&#102;&#097;&#099;&#099;&#105;&#097;&#109;&#111;&#099;&#111;&#109;&#101;&#046;&#111;&#114;&#103;</a>. Tutti i contributi saranno riportati nel log sottostante, con indicazione dell'autore/ispiratore.</p>
	<p>Al momento la formulazione accettata è di solo tipo <em>esterofilo</em> (deve cioè includere riferimenti a una nazione casuale). Mi scuso in anticipo per i contributi che sarò costretto ad escludere, tagliare o riformulare (per ragioni di spazio), o che mi sono sfuggiti.</p>
	<div class="table">
		<? foreach ($templates as $giorno): ?>
			<p><strong><?= $giorno['giorno'] ?></strong></p>
			<hr>
			<p>
			<? foreach ($giorno['items'] as $template): ?>
				- [<?= $template['id'] ?>] "<?= $template['frase'] ?>" <?= $template['autore'] ?><br>
			<? endforeach ?>
			</p>
		<? endforeach ?>
	</div>
</div>

<? include('includes/footer.php') ?>

<script type="text/javascript" src="js/jquery-1.11.0.min.js"></script>

</body>
</html>
