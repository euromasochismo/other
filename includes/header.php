<?php 

if(count(get_included_files()) ==1) exit("Direct access not permitted.");

?>

<div id="header" class="container">
	<div id="logo">
		<a href="/">
			<div id="image">
				<img src="images/European_Stars_Black.png" height="150">
			</div>
			<!-- <div id="title-group">
				<div id="title">Facciamo come...?</div>
			</div> -->
		</a>
	</div>
	<div id="menu">
		<ul>
			<li class="<?= ($page == 'generatore') ? 'current_page_item' : '' ?>"><a href="/" title="">Generatore</a></li>
			<li class="<?= ($page == 'contributi') ? 'current_page_item' : '' ?>"><a href="contributi" title="contributi">Contributi</a></li>
			<li class="<?= ($page == 'widget') ? 'current_page_item' : '' ?>"><a href="widget" title="Widget">Widget</a></li>
			<li class="<?= ($page == 'api') ? 'current_page_item' : '' ?>"><a href="api" title="API">API</a></li>
			<li class="<?= ($page == 'libro') ? 'current_page_item' : '' ?>"><a href="il-libro" title="API">Libro</a></li>
		</ul>
	</div>
</div>