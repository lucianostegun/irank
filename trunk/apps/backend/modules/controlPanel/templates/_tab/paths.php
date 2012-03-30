<?php
$htpasswdFilePath = Config::getConfigByName('htpasswdFilePath', true);
?>
<div class="module_content">
	<div class="defaultForm">
		<section>
			<label>Arquivo .htpasswd</label>
			<?php echo input_tag('htpasswdFilePath', $htpasswdFilePath, array('size'=>50, 'id'=>'controlPanelHtpasswdFilePath')) ?>
		</section>
	</div>
</div>