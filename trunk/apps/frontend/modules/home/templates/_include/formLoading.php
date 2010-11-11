<?php
	sfContext::getInstance()->getResponse()->addStylesheet( 'frontend/loading' );
?>
<div class="formLoading" id="indicator<?php echo ucfirst($indicatorId) ?>">
	<div class="image"><?php echo image_tag('ajaxLoaderForm.gif') ?></div>
	<div class="message">Processando, aguarde...</div>
</div>