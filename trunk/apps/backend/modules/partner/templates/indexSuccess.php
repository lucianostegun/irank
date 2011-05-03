<?php
	$indexDivDisplay  = ($actionName=='index'?'block':'none');
	$recordDivDisplay = ($actionName=='index'?'none':'block');
?>

<div id="indexDiv" style="display: <?php echo $indexDivDisplay ?>">
	<?php include_partial('partner/indexSuccess', array('moduleName'=>'partner')); ?>
</div>
<div id="recordDiv" style="display: <?php echo $recordDivDisplay ?>">
	<?php include_partial('partner/createSuccess', array('partnerObj'=>$partnerObj, 'readOnly'=>$readOnly)); ?>
</div>
