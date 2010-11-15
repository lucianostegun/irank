<?php
	$successMessage = 'Registro salvo com sucesso!';
	$errorMessage   = 'Erro ao salvar o registro!';
?>
<div id="formStatusError<?php echo ucfirst($statusId) ?>Div" class="formStatusDiv">
	<div class="message"><?php echo $errorMessage ?></div>
</div>
<div id="formStatusSuccess<?php echo ucfirst($statusId) ?>Div" class="formStatusDiv">
	<div class="message" id="formStatusSuccess<?php echo ucfirst($statusId) ?>MessageDiv"><?php echo $successMessage ?></div>
</div>