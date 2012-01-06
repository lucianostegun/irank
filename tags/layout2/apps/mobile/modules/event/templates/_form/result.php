<?php
	$culture = MyTools::getCulture();
?>
<div id="resultDiv" style="display: none">
	<div class="text">
		<?php echo __('event.result.intro') ?>
	</div>
	<br/>
	
	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="gridTable">
	  <tr class="rank_heading">
	    <th colspan="2"><?php echo __('event.result.playerName') ?></th>
	  </tr>
	  <?php
	  	$eventBuyin  = $eventObj->getBuyin();
	  	$savedResult = $eventObj->getSavedResult();
	  	$isRing      = $eventObj->getGameStyle()->isTagName('ring');
	  	
	  	$eventPlayerObjList = $eventObj->getClassify();
	  	$recordCount        = count($eventPlayerObjList);
	  	$peopleIdList       = array();
	  	
	  	foreach($eventPlayerObjList as $key=>$eventPlayerObj):
	  	
	  		$peopleObj = $eventPlayerObj->getPeople();
	  		$peopleId  = $peopleObj->getId();
	  		$enabled   = $eventPlayerObj->getEnabled();
	  		$class     = ($enabled?'confirmed':'notConfirmed');
	  		
	  		$peopleIdList[] = $peopleId;
	  ?>
	  <tr onclick="togglePresence(<?php echo $peopleId ?>)" class="<?php echo $class ?>" id="eventResultPlayer<?php echo $peopleId ?>">
	    <td id="eventResultPeopleName<?php echo $peopleId ?>"><?php echo $peopleObj->getFullName() ?></td>
	    <td width="30"><?php echo image_tag('icon/'.($enabled?'ok':'nok'), array('id'=>'eventResultPresenceIcon'.$peopleId)) ?></td>
	  </tr>
	  <?php
	  	endforeach;
	  	
	  	if( count($eventPlayerObjList)==0 ):
	  ?>
	  <tr>
	    <td><?php echo __('ranking.noPlayers') ?></td>
	  </tr>
	  <?php endif; ?>
	</table>
	
	<?php echo input_hidden_tag('peopleIdList', implode(',', $peopleIdList)); ?>
	
	<br/>
	<?php echo button_tag('lunchResult', __('button.lunchResult'), array('onclick'=>'lunchEventResult()', 'style'=>'float: right')) ?>
	<?php echo button_tag('previewResult', __('button.previewResult'), array('onclick'=>'previewEventResult()', 'style'=>'float: right')) ?>
	<br/>
	
	<br/>
</div>