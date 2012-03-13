<?php
	$successMessage = ($successMessage?$successMessage:__('form.statusSuccessMessage'));
	$errorMessage   = ($errorMessage?$errorMessage:__('form.statusErrorMessage'))
?>
<div id="formStatusError<?php echo ucfirst($statusId) ?>Div" class="formStatusDiv error">
	<div class="message"><?php echo $errorMessage ?></div>
</div>
<div id="formStatusSuccess<?php echo ucfirst($statusId) ?>Div" class="formStatusDiv success">
	<div class="message" id="formStatusSuccess<?php echo ucfirst($statusId) ?>MessageDiv"><?php echo $successMessage ?></div>
</div>