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
	  	$peopleIdList       = array();
	  	foreach($eventPlayerObjList as $key=>$eventPlayerObj):
	  	
	  		$peopleObj = $eventPlayerObj->getPeople();
	  		$peopleId  = $peopleObj->getId();
	  		$class     = ($eventPlayerObj->getEnabled()?'confirmedResult':'notConfirmedResult');
	  		
	  		$buyin = ($savedResult && $eventPlayerObj->getBuyin()?$eventPlayerObj->getBuyin():$eventBuyin);
    		$buyin = Util::formatFloat($buyin, true);
    		$peopleIdList[] = $peopleId;
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
		  echo input_hidden_tag('buyin'.$peopleId, $buyin, array('class'=>'eventResultBuyin', 'id'=>'eventBuyin'.$peopleId));
		  echo input_hidden_tag('eventPosition'.$peopleId, $eventPlayerObj->getEventPosition(), array('class'=>'eventResultPosition', 'id'=>'eventEventPosition'.$peopleId));
		  echo input_hidden_tag('prize'.$peopleId, Util::formatFloat($eventPlayerObj->getPrize(), true), array('class'=>'eventResultPrize', 'id'=>'eventPrize'.$peopleId));
		  echo input_hidden_tag('rebuy'.$peopleId, Util::formatFloat($eventPlayerObj->getRebuy(), true), array('class'=>'eventResultRebuy', 'id'=>'eventRebuy'.$peopleId));
		  echo input_hidden_tag('addon'.$peopleId, Util::formatFloat($eventPlayerObj->getAddon(), true), array('class'=>'eventResultAddon', 'id'=>'eventAddon'.$peopleId));

	  	endforeach;
	  	
	  	echo input_hidden_tag('resultPeopleIdList', implode(',', $peopleIdList));
	  	
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
	

	<table cellspacing="0" cellpadding="0" style="float: right">
		<tr>
			<td align="left" style="padding-left: 20px">
				<?php echo button_tag('calcularePrize', __('button.calculetePrize'), array('onclick'=>'doCalculatePrize()', 'style'=>'float: right')) ?>
			</td>
			<td align="right">
				<?php echo button_tag('mainSubmit', __('button.saveResult'), array('onclick'=>'doSubmitEvent()', 'style'=>'float: right')) ?>
			</td>
		</tr>
	</table>	
	<br/>
	
	<br/>
	
	<table class="text">
		<tr><th align="right"><?php echo __('event.result.position') ?></th><td><?php echo __('event.result.legend.position') ?></td></tr>
		<tr><th align="right">$</th><td><?php echo __('event.result.legend.prize') ?></td></tr>
	</table>
	<br/>
</div>