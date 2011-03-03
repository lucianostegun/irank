<?php
	$culture = MyTools::getCulture();
?>
<div id="resultPreviewDiv" style="display: none">
			
	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="gridTable">
	  <tr>
	    <th><?php echo __('event.result.playerName') ?></th>
	    <th>B</th>
	    <th><?php echo __('event.result.position') ?></th>
	    <th>$</th>
	    <th>R</th>
	    <th>A</th>
	  </tr>
	  <?php
	  	$eventBuyin  = $eventObj->getBuyin();
	  	$savedResult = $eventObj->getSavedResult();
	  	$isRing      = $eventObj->getGameStyle()->isTagName('ring');
	  	
	  	$eventPlayerObjList = $eventObj->getClassify();
	  	$recordCount        = count($eventPlayerObjList);
	  	foreach($eventPlayerObjList as $key=>$eventPlayerObj):
	  	
	  		$peopleObj = $eventPlayerObj->getPeople();
	  		$peopleId  = $peopleObj->getId();
	  		$class     = ($eventPlayerObj->getEnabled()?'confirmedResult':'notConfirmedResult');
	  		
	  		$buyin = ($savedResult && $eventPlayerObj->getBuyin()?$eventPlayerObj->getBuyin():$eventBuyin);
    		$buyin = Util::formatFloat($buyin, true);
	  ?>
	  <tr class="<?php echo $class ?>" id="eventResultPlayer<?php echo $peopleId ?>Preview">
	    <td><?php echo $peopleObj->getFirstName() ?></td>
	    <td align="right"><?php echo $buyin; ?></td>
	    <td align="right" id="eventEventPosition<?php echo $peopleId ?>Preview"><?php echo $eventPlayerObj->getEventPosition() ?></td>
	    <td align="right" id="eventPrize<?php echo $peopleId ?>Preview"><?php echo Util::formatFloat($eventPlayerObj->getPrize(), true) ?></td>
	    <td align="right" id="eventRebuy<?php echo $peopleId ?>Preview"><?php echo Util::formatFloat($eventPlayerObj->getRebuy(), true) ?></td>
	    <td align="right" id="eventAddon<?php echo $peopleId ?>Preview" style="padding-right: 5px"><?php echo Util::formatFloat($eventPlayerObj->getAddon(), true) ?></td>
	  </tr>
	  <?php
		  echo input_hidden_tag('buyin'.$peopleId, $buyin, array('id'=>'eventBuyin'.$peopleId));
		  echo input_hidden_tag('eventPosition'.$peopleId, $eventPlayerObj->getEventPosition(), array('id'=>'eventEventPosition'.$peopleId));
		  echo input_hidden_tag('prize'.$peopleId, Util::formatFloat($eventPlayerObj->getPrize(), true), array('id'=>'eventPrize'.$peopleId));
		  echo input_hidden_tag('rebuy'.$peopleId, Util::formatFloat($eventPlayerObj->getRebuy(), true), array('id'=>'eventRebuy'.$peopleId));
		  echo input_hidden_tag('addon'.$peopleId, Util::formatFloat($eventPlayerObj->getAddon(), true), array('id'=>'eventAddon'.$peopleId));

	  	endforeach;
	  	
	  	if( count($eventPlayerObjList)==0 ):
	  ?>
	  <tr>
	    <td colspan="6"><?php echo __('ranking.noPlayers') ?></td>
	  </tr>
	  <?php endif; ?>
	</table>
	
	<br/>
	<div class="text"><?php echo __('event.result.notifyInfo') ?></div>
	<br/>
	
	
	<br/>
	<?php echo button_tag('mainSubmit', __('button.saveResult'), array('onclick'=>'doSubmitEvent()', 'style'=>'float: right')) ?>
	<br/>
	
	<br/>
	<table class="text">
		<tr><th align="right"><?php echo __('event.result.position') ?></th><td><?php echo __('event.result.legend.position') ?></td></tr>
		<tr><th align="right">$</th><td><?php echo __('event.result.legend.prize') ?></td></tr>
	</table>
	<br/>
</div>