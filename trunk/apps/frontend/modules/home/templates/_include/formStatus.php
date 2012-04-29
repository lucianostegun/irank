<?php
	$successMessage = ($successMessage?$successMessage:__('form.statusSuccessMessage'));
	$errorMessage   = ($errorMessage?$errorMessage:__('form.statusErrorMessage'))
?>
<div id="formStatusError<?php echo ucfirst($statusId) ?>Div" class="formStatusDiv errorStatus">
	<div class="statusMessage"><?php echo $errorMessage ?></div>
</div>
<div id="formStatusSuccess<?php echo ucfirst($statusId) ?>Div" class="formStatusDiv successStatus">
	<div class="statusMessage" id="formStatusSuccess<?php echo ucfirst($statusId) ?>MessageDiv"><?php echo $successMessage ?></div>
</div>