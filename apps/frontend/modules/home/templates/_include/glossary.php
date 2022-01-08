<h2>Dicionário de termos</h2>
<form>
<div id="pokerGlossary">
	<div class="intro">Digite um termo de poker para saber seu signifcado.</div>
	<div id="termDescription"></div>
	<div class="form"><?php echo input_tag('pokerTerm', null, array('placeholder'=>'All in, blefe, flush...', 'id'=>'glossaryPokerTerm')) ?></div>
	<?php echo link_to('Ver todos', 'glossary/index') ?>
	<?php echo button_tag('searchTerm', 'Ver significado', array('onclick'=>'searchPokerTerm()', 'class'=>'right')) ?>
	<div class="clear"></div>
</div>
</form>
<?php
	MyTools::addStylesheet('glossary');
	MyTools::addJavascript('glossary');
?>