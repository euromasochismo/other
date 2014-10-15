<?php 

if(count(get_included_files()) ==1) exit("Direct access not permitted.");

?>

<div id="header" class="container">
	<div id="logo">
		<a href="/">
			<div id="image">
				
			</div>
			<!-- <div id="title-group">
				<div id="title">Facciamo come...?</div>
			</div> -->
		</a>
	</div>
	<div id="menu">
		<ul>
			<li class="<?= ($page == 'frasi') ? 'current_page_item' : '' ?>"><a href="frasi" title="frasi">Frasi</a></li>
			<li class="<?= ($page == 'tags') ? 'current_page_item' : '' ?>"><a href="tags" title="tags">Tags</a></li>
			<li class="<?= ($page == 'rimandi') ? 'current_page_item' : '' ?>"><a href="rimandi" title="rimandi">Rimandi</a></li>
		</ul>
	</div>
</div>