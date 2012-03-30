<?php
	echo form_remote_tag(array(
		'url'=>'controlPanel/save',
		'success'=>'handleSuccessControlPanel(request.responseText)',
		'failure'=>'handleFailureControlPanel(request.responseText)',
		'loading'=>'showIndicator("controlPanel")',
		'encoding'=>'UTF8',
	), array('id'=>'controlPanelForm'));
?>
<article class="module width_full">
	<header>
	<ul class="tabs">
		<li><a href="#tab1">Principal</a></li>
		<li><a href="#tab2">Diretórios</a></li>
	</ul>
	</header>
	<div class="tab_container">
		<div id="tab1" class="tab_content"><?php include_partial('controlPanel/tab/main', array()) ?></div>
		<div id="tab2" class="tab_content"><?php include_partial('controlPanel/tab/paths', array()) ?></div>
	</div>
	<?php include_partial('home/include/formFooter', array('prefix'=>'controlPanel')) ?>
</article><!-- end of content manager article -->
</form>