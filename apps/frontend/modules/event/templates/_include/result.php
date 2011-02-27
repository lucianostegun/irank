<table width="100%" border="0" cellspacing="1" cellpadding="2" class="gridTabTable">
  <tr class="header">
    <th><?php echo __('Player') ?></th>
    <th width="50">Buy-in</th>
    <th width="50"><?php echo __('Position') ?></th>
    <th width="50"><?php echo __('Prize') ?></th>
    <th width="50">Rebuy</th>
    <th width="50">Add-on</th>
  </tr>
  <?php
  	$eventBuyin  = $eventObj->getBuyin();
  	$savedResult = $eventObj->getSavedResult();
  	$isRing      = $eventObj->getGameStyle()->isTagName('ring');
  	
  	$eventPlayerObjList = $eventObj->getClassify();
  	$recordCount        = count($eventPlayerObjList);
  	
  	$totalBuyin = 0;
  	$totalPrize = 0;
  	$totalRebuy = 0;
  	$totalAddon = 0;
  	
  	$peopleIdList = array();
  	
  	foreach($eventPlayerObjList as $key=>$eventPlayerObj):
  	
  		$peopleObj = $eventPlayerObj->getPeople();
  		$peopleId  = $peopleObj->getId();
  		$style     = ($eventPlayerObj->getEnabled()?'':'color: #BABABA');
  		
  		$peopleIdList[] = $peopleId;
  ?>
  <tr>
    <td id="eventResultPeopleName<?php echo $peopleId ?>" style="<?php echo $style ?>"><?php echo $peopleObj->getFullName() ?></td>
    <td align="<?php echo ($isRing?'left':'right') ?>">
    	<?php
    		$buyin = ($savedResult?$eventPlayerObj->getBuyin():$eventBuyin);
    		$prize = $eventPlayerObj->getPrize();
    		$rebuy = $eventPlayerObj->getRebuy();
    		$addon = $eventPlayerObj->getAddon();
    		
    		$totalBuyin += $buyin;
    		$totalPrize += $prize;
    		$totalRebuy += $rebuy;
    		$totalAddon += $addon;
    		 
    		$buyin = Util::formatFloat($buyin, true);
    		
    		
    		if( $isRing ){
    			
    			echo input_tag('buyin'.$peopleId, $buyin, array('size'=>5, 'maxlength'=>7, 'tabindex'=>($key+1), 'style'=>'text-align: right', 'onkeyup'=>'calculateResultTotal("buyin")', 'id'=>'eventBuyin'.$peopleId));
    		}else{
    			
    			echo input_hidden_tag('buyin'.$peopleId, $buyin, array('style'=>'text-align: right', 'id'=>'eventBuyin'.$peopleId));
    			echo $buyin;
    		}
    	?>
    </td>
    <td><?php echo input_tag('eventPosition'.$peopleId, $eventPlayerObj->getEventPosition(), array('size'=>2, 'maxlength'=>2, 'tabindex'=>($key+1+$recordCount), 'class'=>'eventResultPosition', 'id'=>'eventEventPosition'.$peopleId)) ?></td>
    <td><?php echo input_tag('prize'.$peopleId, Util::formatFloat($prize, true), array('size'=>5, 'maxlength'=>7, 'tabindex'=>($key+1+$recordCount*2), 'class'=>'eventResultPrize', 'onkeyup'=>'calculateResultTotal("prize")', 'style'=>'text-align: right', 'id'=>'eventPrize'.$peopleId)) ?></td>
    <td><?php echo input_tag('rebuy'.$peopleId, Util::formatFloat($rebuy, true), array('size'=>5, 'maxlength'=>7, 'tabindex'=>($key+1+$recordCount*3), 'class'=>'eventResultRebuy', 'onkeyup'=>'calculateResultTotal("rebuy")', 'style'=>'text-align: right', 'id'=>'eventRebuy'.$peopleId)) ?></td>
    <td><?php echo input_tag('addon'.$peopleId, Util::formatFloat($addon, true), array('size'=>5, 'maxlength'=>7, 'tabindex'=>($key+1+$recordCount*4), 'class'=>'eventResultAddon', 'onkeyup'=>'calculateResultTotal("addon")', 'style'=>'text-align: right', 'id'=>'eventAddon'.$peopleId)) ?></td>
  </tr>
  <?php
  	endforeach;
  	
  	if( count($eventPlayerObjList) > 0 ):
  ?>
  <tr class="resultTotal">
    <td>TOTAL</td>
    <td align="right" id="eventResultTotalBuyin"><?php echo Util::formatFloat($totalBuyin, true) ?></td>
    <td></td>
    <td align="right" id="eventResultTotalPrize"><?php echo Util::formatFloat($totalPrize, true) ?></td>
    <td align="right" id="eventResultTotalRebuy"><?php echo Util::formatFloat($totalRebuy, true) ?></td>
    <td align="right" id="eventResultTotalAddon"><?php echo Util::formatFloat($totalAddon, true) ?></td>
  </tr>
  <?php
  	else:
  ?>
  <tr>
    <td colspan="6"><?php echo __('ranking.resultTab.noPlayer') ?></td>
  </tr>
  <?php endif; ?>
  <tr>
    <td colspan="6" class="defaultForm">
    	<div class="row" style="margin-top: 3px">
    		<div class="text"><?php echo __('event.resultTab.footerMessage') ?></div>
    	</div>
    </td>
  </tr>
</table>
<?php
	echo input_hidden_tag('resultPeopleIdList', implode(',', $peopleIdList));
	echo input_hidden_tag('resultTab', true);
?>