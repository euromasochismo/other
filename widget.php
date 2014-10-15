<!DOCTYPE html>

<head>
<? include('includes/head.php') ?>

<?php
	
	$page = 'widget';

?>

</head>
<body>
<? include('includes/header.php') ?>

<div id="api">

	<div class="container">

		<p>Widget v. 0.1 18/02/2014</p>

		<div class="title">
			<h3>Widget per siti web</h3>
		</div>

		<p>È possibile includere il generatore di supercazzole esterofile e piddine nei propri siti web richiamando la pagina widget in un iframe:</p>
		<div class="code">
			http://facciamocome.org/widgets/app
		</div>
		<p>Ad esempio, il codice:</p>
		<div class="code">
			&lt;iframe src="http://facciamocome.org/widgets/app" scrolling="no" style="width:100%; overflow: hidden; border:none; margin:0">&lt;/iframe&gt;
		</div>
		<p>produce (le frasi cambiano <strong>ogni 15 secondi</strong>):</p>
		<iframe src="http://facciamocome.org/widgets/app" scrolling="no" style="width:100%; overflow: hidden; border:none; margin:0"></iframe>

	</div>
</div>

<? include('includes/footer.php') ?>

</body>
</html>
