<div id="resultDiv" style="display: none">
	<div class="text">
		Utilize o dispositivo na posição horizontal para visualizar todos os campos de edição
	</div>
	<br/>
			
	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="gridTable">
	  <tr class="rank_heading">
	    <th>Nome</th>
	    <th>Buy-in</th>
	    <th>Pos</th>
	    <th>$$$</th>
	    <th class="hiddenColumn">Rebuy</th>
	    <th class="hiddenColumn">Add-on</th>
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
	  		$style     = ($eventPlayerObj->getEnabled()?'':'font-style: italic');
	  ?>
	  <tr>
	    <td id="eventResultPeopleName<?php echo $peopleId ?>" style="<?php echo $style ?>"><?php echo $peopleObj->getFullName() ?></td>
	    <td align="<?php echo ($isRing?'left':'right') ?>">
	    	<?php
	    		$buyin = ($savedResult?$eventPlayerObj->getBuyin():$eventBuyin);
	    		$buyin = Util::formatFloat($buyin, true);
	    		if( $isRing ){
	    			
	    			echo input_tag('buyin'.$peopleId, $buyin, array('size'=>5, 'maxlength'=>7, 'tabindex'=>($key+1), 'style'=>'text-align: right', 'onfocus'=>'handleOnFocus(this)', 'onblur'=>'handleOnBlur(this)', 'id'=>'eventBuyin'.$peopleId));
	    		}else{
	    			
	    			echo input_hidden_tag('buyin'.$peopleId, $buyin, array('style'=>'text-align: right', 'id'=>'eventBuyin'.$peopleId));
	    			echo $buyin;
	    		}
	    	?>
	    </td>
	    <td align="center"><?php echo input_tag('eventPosition'.$peopleId, $eventPlayerObj->getEventPosition(), array('size'=>2, 'maxlength'=>2, 'tabindex'=>($key+1+$recordCount), 'onfocus'=>'handleOnFocus(this)', 'onblur'=>'handleOnBlur(this)', 'id'=>'eventEventPosition'.$peopleId)) ?></td>
	    <td align="center"><?php echo input_tag('prize'.$peopleId, Util::formatFloat($eventPlayerObj->getPrize(), true), array('size'=>5, 'maxlength'=>7, 'tabindex'=>($key+1+$recordCount*2), 'onfocus'=>'handleOnFocus(this)', 'onblur'=>'handleOnBlur(this)', 'style'=>'text-align: right', 'id'=>'eventPrize'.$peopleId)) ?></td>
	    <td align="center" class="hiddenColumn"><?php echo input_tag('rebuy'.$peopleId, Util::formatFloat($eventPlayerObj->getRebuy(), true), array('size'=>5, 'maxlength'=>7, 'tabindex'=>($key+1+$recordCount*3), 'onfocus'=>'handleOnFocus(this)', 'onblur'=>'handleOnBlur(this)', 'style'=>'text-align: right', 'id'=>'eventRebuy'.$peopleId)) ?></td>
	    <td align="center" class="hiddenColumn"><?php echo input_tag('addon'.$peopleId, Util::formatFloat($eventPlayerObj->getAddon(), true), array('size'=>5, 'maxlength'=>7, 'tabindex'=>($key+1+$recordCount*4), 'onfocus'=>'handleOnFocus(this)', 'onblur'=>'handleOnBlur(this)', 'style'=>'text-align: right', 'id'=>'eventAddon'.$peopleId)) ?></td>
	  </tr>
	  <?php
	  	endforeach;
	  	
	  	if( count($eventPlayerObjList)==0 ):
	  ?>
	  <tr>
	    <td colspan="6">Este ranking não possui convidados para compor os resultados</td>
	  </tr>
	  <?php endif; ?>
	</table>
	
	<br/>
	<div class="text">Os resultados serão enviados por e-mail a todos os convidados</div>
	<br/>
	
	<table width="100%" cellspacing="0" cellpadding="0">
		<tr>
			<td align="right" style="padding-right: 20px"><?php echo image_tag('mobile/button/conclude', array('onclick'=>'doSubmitEvent()')) ?></div>
		</tr>
	</table>
	
	<br/>
	<table class="text">
		<tr><th align="right">Pts</th><td>Pontos ganhos</td></tr>
		<tr><th align="right">BRA</th><td>Buy-in + Rebuys + Add-ons</td></tr>
		<tr><th align="right">$$$</th><td>Ganhos</td></tr>
		<tr><th align="right">Bal</th><td>Balanço</td></tr>
		<tr><th align="right">Méd</th><td>Média (Ganhos/BRA)</td></tr>
	</table>
	<br/>
</div>