<?php
	sfContext::getInstance()->getResponse()->addStylesheet('frontend/loading');
?>
<div class="formLoading<?php echo ($isWindow?'Window':'') ?>" id="indicator<?php echo ucfirst($indicatorId) ?>">
	<div class="image"><?php echo image_tag('ajaxLoaderForm.gif') ?></div>
	<div class="message"><?php echo $message ?></div>
</div>