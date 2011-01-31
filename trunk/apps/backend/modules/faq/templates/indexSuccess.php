<?php
	$indexDivDisplay  = ($actionName=='index'?'block':'none');
	$recordDivDisplay = ($actionName=='index'?'none':'block');
?>

<div id="indexDiv" style="display: <?php echo $indexDivDisplay ?>">
	<?php include_partial('faq/indexSuccess', array('moduleName'=>'faq')); ?>
</div>
<div id="recordDiv" style="display: <?php echo $recordDivDisplay ?>">
	<?php include_partial('faq/createSuccess', array('faqObj'=>$faqObj, 'readOnly'=>$readOnly)); ?>
</div>
