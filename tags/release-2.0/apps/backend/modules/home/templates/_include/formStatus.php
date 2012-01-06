<?php
	$successMessage = 'Registro salvo com sucesso!';
	$errorMessage   = 'Erro ao salvar o registro!';
?>
<div id="formStatusError<?php echo ucfirst($statusId) ?>Div" class="formStatus<?php echo ($window?'WindowError':'') ?>Div">
	<div class="message"><?php echo $errorMessage ?></div>
</div>
<div id="formStatusSuccess<?php echo ucfirst($statusId) ?>Div" class="formStatus<?php echo ($window?'WindowSuccess':'') ?>Div">
	<div class="message" id="formStatusSuccess<?php echo ucfirst($statusId) ?>MessageDiv"><?php echo $successMessage ?></div>
</div>