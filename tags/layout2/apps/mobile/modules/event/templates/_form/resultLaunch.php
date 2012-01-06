<?php
	$culture = MyTools::getCulture();
	
  	$eventBuyin  = $eventObj->getBuyin();
  	$savedResult = $eventObj->getSavedResult();
  	$isRing      = $eventObj->getGameStyle()->isTagName('ring');
  	
  	$eventPlayerObjList = $eventObj->getClassify();
  	$recordCount        = count($eventPlayerObjList);

	$buyin = Util::formatFloat($eventBuyin, true);
	
	echo input_hidden_tag('peopleIdIndex', -1);
	echo input_hidden_tag('isFreeroll', $eventObj->getIsFreeroll());
	
	if( $isRing ){
		
		$buyinField         = input_tag('buyin', $buyin, array('size'=>5, 'maxlength'=>7, 'tabindex'=>1, 'style'=>'text-align: right', 'onfocus'=>'handleOnFocus(this)', 'onblur'=>'handleOnBlur(this); replicateValue(this); this.tabIndex=8', 'id'=>'eventBuyin'));
		$eventPositionField = input_tag('eventPosition', 0, array('size'=>5, 'maxlength'=>2, 'tabindex'=>2, 'onfocus'=>'handleOnFocus(this)', 'onblur'=>'handleOnBlur(this); replicateValue(this)', 'style'=>'text-align: right', 'id'=>'eventEventPosition'));
		$addonField         = input_tag('addon', Util::formatFloat(0, true), array('size'=>5, 'maxlength'=>7, 'tabindex'=>5, 'onfocus'=>'handleOnFocus(this)', 'onblur'=>'handleOnBlur(this); replicateValue(this); $("eventBuyin").tabIndex=1; getNextResult()', 'style'=>'text-align: right', 'id'=>'eventAddon'));
	}else{
		
		$buyinField         = input_hidden_tag('buyin', $buyin, array('style'=>'text-align: right', 'id'=>'eventBuyin'));
		$eventPositionField = input_tag('eventPosition', 0, array('size'=>5, 'maxlength'=>2, 'tabindex'=>2, 'onfocus'=>'handleOnFocus(this)', 'onblur'=>'handleOnBlur(this); replicateValue(this); this.tabIndex=6', 'style'=>'text-align: right', 'id'=>'eventEventPosition'));
		$addonField         = input_tag('addon', Util::formatFloat(0, true), array('size'=>5, 'maxlength'=>7, 'tabindex'=>5, 'onfocus'=>'handleOnFocus(this)', 'onblur'=>'handleOnBlur(this); replicateValue(this); $("eventEventPosition").tabIndex=2; getNextResult()', 'style'=>'text-align: right', 'id'=>'eventAddon'));
	}
?>
<div id="resultLunchDiv" style="display: none">
			
	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="gridTable">
	  <tr class="rank_heading">
	    <th id="eventResultLunchPeopleName" colspan="4"></th>
	  </tr>
	  <tr>
	    <th align"right">Buy-in</th>
	    <td colspan="3"><?php echo ($isRing?'':$buyin).$buyinField ?></td>
	  </tr>
	  <tr>
	    <th align"right"><?php echo __('event.resultLunch.position') ?></th>
	    <td><?php echo $eventPositionField ?></td>

	    <th align"right"><?php echo __('event.resultLunch.prize') ?></th>
	    <td><?php echo input_tag('prize', Util::formatFloat(0, true), array('size'=>5, 'maxlength'=>7, 'tabindex'=>3, 'onfocus'=>'handleOnFocus(this)', 'onblur'=>'handleOnBlur(this); replicateValue(this)', 'style'=>'text-align: right', 'id'=>'eventPrize')) ?></td>
	  </tr>
	  <tr>
	    <th align"right">Rebuy</th>
	    <td><?php echo input_tag('rebuy', Util::formatFloat(0, true), array('size'=>5, 'maxlength'=>7, 'tabindex'=>4, 'onfocus'=>'handleOnFocus(this)', 'onblur'=>'handleOnBlur(this); replicateValue(this)', 'style'=>'text-align: right', 'id'=>'eventRebuy')) ?></td>

	    <th align"right">Add-on</th>
	    <td><?php echo $addonField ?></td>
	  </tr>
	</table>
	
	<br/>
	
	<table width="100%" cellspacing="0" cellpadding="0">
		<tr>
			<td align="left" style="padding-left: 20px">
				<?php echo image_tag('mobile/button/previous', array('onclick'=>'getPreviousResult()')) ?><?php echo image_tag('mobile/button/next', array('onclick'=>'getNextResult()')) ?>
			</td>
			<td align="right">
				<?php echo button_tag('previewResult', __('button.previewResult'), array('onclick'=>'previewEventResult()', 'style'=>'float: right')) ?>
			</td>
		</tr>
	</table>
	
	<br/>
</div>