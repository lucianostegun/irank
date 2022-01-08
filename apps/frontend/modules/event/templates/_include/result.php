<?php
  	$eventBuyin  = $eventObj->getBuyin();
  	$savedResult = $eventObj->getSavedResult();
  	$isRing      = $eventObj->getGameStyle()->isTagName('ring');
	$isFreeroll  = $eventObj->getIsFreeroll();
	$allowRebuy  = $eventObj->getAllowRebuy();
	$allowAddon  = $eventObj->getAllowAddon();
?>
<div id="drag">
	<table border="0" cellspacing="0" cellpadding="0" class="gridTable gridTabTable" style="width: 650px">
		<colgroup>
			<col/>
			<col/>
			<col/>
			<col/>
			<col/>
			<col/>
			<col/>
			<col/>
		</colgroup>
	<tbody>
		<tr class="header">
			<th class="mark first"></th>
			<th class="mark"><?php echo __('Player') ?></th>
			<?php if( !$isFreeroll ): ?>
			<th class="mark" width="50">Buy-in</th>
			<?php endif; ?>
			<th class="mark" width="50"><?php echo __('Position') ?></th>
			<?php if( $allowRebuy ): ?>
			<th class="mark" width="50">Rebuy</th>
			<?php endif; ?>
			<?php if( $allowAddon ): ?>
			<th class="mark" width="50">Add-on</th>
			<?php endif; ?>
			<th class="mark" width="50"><?php echo __('Prize') ?></th>
		</tr>
	<?php
		$eventPlayerObjList = $eventObj->getClassify();
		$recordCount        = count($eventPlayerObjList);
		
		$totalBuyin = 0;
		$totalPrize = 0;
		$totalRebuy = 0;
		$totalAddon = 0;
		
		$peopleIdList = array();
		
		$fieldType     = ($isFreeroll?'input_hidden_tag':'input_tag');
		$eventPosition = 0;
		foreach($eventPlayerObjList as $key=>$eventPlayerObj):
		
			$peopleObj = $eventPlayerObj->getPeople();
			$peopleId  = $peopleObj->getId();
			$enabled   = $eventPlayerObj->getEnabled();
			$style     = ($enabled?'':'color: #BABABA');
			
			if( $enabled )
				$eventPosition++;
			
			$peopleIdList[] = $peopleId;
	  ?>
		<tr id="eventResultRow<?php echo $peopleId ?>" class="resultEventPlayerRow eventPosition<?php echo $eventPosition ?>" style="display: <?php echo ($enabled?'table-row':'none') ?>">
			<td align="center" class="rowhandler"><div class="drag row"></div></td>
			<td id="eventResultPeopleName<?php echo $peopleId ?>" style="<?php echo $style ?>"><?php echo $peopleObj->getFullName() ?></td>
			<?php
				$buyin = ($savedResult?$eventPlayerObj->getBuyin():0);
				$prize = $eventPlayerObj->getPrize();
				$rebuy = $eventPlayerObj->getRebuy();
				$addon = $eventPlayerObj->getAddon();
				 
				$buyin = Util::formatFloat($buyin, true);
				
				if( !$isFreeroll ):
			?>
			<td align="<?php echo ($isRing?'left':'right') ?>" id="eventResultBuyin<?php echo $peopleId ?>">
				<?php	
					if( $isRing ){
						
						$buyinField = input_tag('buyin'.$peopleId, $buyin, array('size'=>5, 'maxlength'=>7, 'tabindex'=>($key+1), 'style'=>'text-align: right', 'onkeyup'=>'calculateResultTotal("buyin")', 'id'=>'eventBuyin'.$peopleId));
						echo $buyinField;
						$buyinField = '';
					}else{
						
						$buyinField = input_hidden_tag('buyin'.$peopleId, $buyin, array('id'=>'eventBuyin'.$peopleId));
						echo $buyin;
					}
				?>	
			</td>
			<?php
				else:
					$buyinField = input_hidden_tag('buyin'.$peopleId, $buyin, array('id'=>'eventBuyin'.$peopleId));
				endif;
				
				$totalBuyin += $buyin;
				$totalPrize += $prize;
				$totalRebuy += $rebuy;
				$totalAddon += $addon;
				
				if( !$allowRebuy )
					echo input_hidden_tag('rebuy'.$peopleId, Util::formatFloat($rebuy, true), array('id'=>'eventRebuy'.$peopleId));
				if( !$allowAddon )
					echo input_hidden_tag('addon'.$peopleId, Util::formatFloat($addon, true), array('id'=>'eventAddon'.$peopleId));
			?>
			<td align="center"><?php echo $buyinField.input_tag('eventPosition'.$peopleId, $eventPlayerObj->getEventPosition(), array('size'=>2, 'maxlength'=>2, 'tabindex'=>($key+1+$recordCount), 'class'=>'eventResultPosition', 'onkeyup'=>'toggleBuyin('.$peopleId.'); checkBuyin('.$peopleId.')', 'autocomplete'=>'off', 'id'=>'eventEventPosition'.$peopleId)) ?></td>
			<?php if( $allowRebuy ): ?>
			<td align="center"><?php echo input_tag('rebuy'.$peopleId, Util::formatFloat($rebuy, true), array('size'=>5, 'maxlength'=>7, 'tabindex'=>($key+1+$recordCount*2), 'class'=>'eventResultRebuy', 'onkeyup'=>'calculateResultTotal("rebuy")', 'style'=>'text-align: right', 'id'=>'eventRebuy'.$peopleId)) ?></td>
			<?php endif; ?>
			<?php if( $allowAddon ): ?>
			<td align="center"><?php echo input_tag('addon'.$peopleId, Util::formatFloat($addon, true), array('size'=>5, 'maxlength'=>7, 'tabindex'=>($key+1+$recordCount*3), 'class'=>'eventResultAddon', 'onkeyup'=>'calculateResultTotal("addon")', 'style'=>'text-align: right', 'id'=>'eventAddon'.$peopleId)) ?></td>
			<?php endif; ?>
			<?php if( $isFreeroll ): ?>
			<td align="right" id="eventPrize<?php echo $peopleId ?>Div"><?php echo Util::formatFloat($prize, true) ?></td>
			<?php echo input_hidden_tag('prize'.$peopleId, Util::formatFloat($prize, true), array('id'=>'eventPrize'.$peopleId)); ?>
			<?php else: ?>
			<td align="center"><?php echo input_tag('prize'.$peopleId, Util::formatFloat($prize, true), array('size'=>5, 'maxlength'=>7, 'tabindex'=>($key+1+$recordCount*4), 'class'=>'eventResultPrize', 'onkeyup'=>'calculateResultTotal("prize")', 'style'=>'text-align: right', 'id'=>'eventPrize'.$peopleId)) ?></td>
			<?php endif; ?>
		</tr>
		  <?php
			endforeach;
			
			if( count($eventPlayerObjList) > 0 ):
		  ?>
		  
		<tr style="display: none">
			<td colspan="7">sss</td>
		</tr>
		</tbody>
		<tr class="resultTotal mark">
			<td class="mark" colspan="2">TOTAL</td>
			<?php if( !$isFreeroll ): ?>
			<td class="mark" align="right" id="eventResultTotalBuyin"><?php echo Util::formatFloat($totalBuyin, true) ?></td>
			<?php endif; ?>
			<td class="mark"></td>
			<?php if( $allowRebuy ): ?>
			<td class="mark" align="right" id="eventResultTotalRebuy"><?php echo Util::formatFloat($totalRebuy, true) ?></td>
			<?php endif; ?>
			<?php if( $allowAddon ): ?>
			<td class="mark" align="right" id="eventResultTotalAddon"><?php echo Util::formatFloat($totalAddon, true) ?></td>
			<?php endif; ?>
			<td class="mark" align="right" id="eventResultTotalPrize"><?php echo Util::formatFloat($totalPrize, true) ?></td>
		</tr>
		<?php else: ?>
		<tr>
			<td class="mark" colspan="7"><?php echo __('event.resultTab.noPlayer') ?></td>
		</tr>
		<?php endif; ?>
		<tr>
			<td class="mark" colspan="7">
				<?php echo __('event.resultTab.footerMessage') ?>
			</td>
		</tr>
	</table>
</div>
<br/>
<?php
	echo input_hidden_tag('resultPeopleIdList', implode(',', $peopleIdList));
	echo input_hidden_tag('resultTab', true);
?>