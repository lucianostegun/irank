<?php
	$htpasswdFilePath = Config::getConfigByName('htpasswdFilePath', true);
?>
	<div class="formRow">
		<label>Arquivo .htpasswd</label>
		<div class="formRight"><?php echo input_tag('htpasswdFilePath', $htpasswdFilePath, array('size'=>50, 'id'=>'settingsHtpasswdFilePath')) ?></div>
		<div class="clear"></div>
	</div>