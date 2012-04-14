<?php
	echo form_tag('settings/save', array('class'=>'form', 'id'=>'settingsForm'));
?>
<!-- Fullscreen tabs -->
<div class="widget">       
	<ul class="tabs">
		<li><a href="#tab1">Principal</a></li>
		<li><a href="#tab2">Diretórios</a></li>
	</ul>
	<div class="tab_container">
		<div id="tab1" class="tab_content"><?php include_partial('settings/tab/main', array()) ?></div>
		<div id="tab2" class="tab_content"><?php include_partial('settings/tab/paths', array()) ?></div>
	</div>
</div>
</form>