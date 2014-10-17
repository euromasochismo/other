<!DOCTYPE html>

<head>
<? include('includes/head.php') ?>

<?php
	
	$page = 'mobile';

?>

</head>
<body>
<? include('includes/header.php') ?>

<div id="mobile">

	<div class="container">

		<div class="title">
			<h3>Porta il tuo autorazzismo sempre con te!</h3>
		</div>

		<table width="100%">
			<tr>
				<td width="240">
					<ul class="actions">
						<li>
							<a href="https://play.google.com/store/apps/details?id=org.facciamocome.info.facciamocome&hl=it" target="_blank" class="button generate" style="background-image:url('images/mobile-previews/android.png'); background-repeat: no-repeat; background-position:10% 50%">
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Android
							</a>
						</li>
					</ul>
				</td>
				<td width="210">
					<ul class="actions">
						<li>
							<a href="#" target="_blank" class="button generate" style="background-image:url('images/mobile-previews/apple.png'); background-repeat: no-repeat; background-position:10% 50%" onclick="alert('La app è in fase di approvazione sull\'Apple Store. Riprova tra qualche giorno!'); return false;">
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;iOS
							</a>
						</li>
					</ul>
				</td>
				<!-- <td width="260">
					<ul class="actions">
						<li>
							<a href="libro/libro_generate" target="_blank" class="button generate" style="background-image:url('images/mobile-previews/github.png'); background-repeat: no-repeat; background-position:7% 50%">
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Sorgente
							</a>
						</li>
					</ul>
				</td> -->
				<td></td>
			</tr>
		</table>

		<div style="float: left">
			<img class="preview" src="images/mobile-previews/iPhone5.png" width="120">
			<img class="preview" src="images/mobile-previews/iPad.png" width="200">
			<img class="preview" src="images/mobile-previews/HTC_Sensation.png" width="120">
			<img class="preview" src="images/mobile-previews/Nexus_One.png" width="120">
			<img class="preview" src="images/mobile-previews/Galaxy_S3.png" width="120">
			<img class="preview" src="images/mobile-previews/Galaxy_Tab.png" width="200">
		</div>

	</div>
</div>

<? include('includes/footer.php') ?>

</body>
</html>
