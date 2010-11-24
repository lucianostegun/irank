<table width="100%" border="0" cellspacing="1" cellpadding="0">
  <tr class="rank_heading">
    <td>Nome</td>
    <td>BI</td>
    <td>Pos</td>
    <td>$$$</td>
    <td>RB</td>
    <td>AO</td>
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
  		$style     = ($eventPlayerObj->getEnabled()?'':'color: #F5F5F5');
  ?>
  <tr class="boxcontent">
    <td id="eventResultPeopleName<?php echo $peopleId ?>" style="<?php echo $style ?>"><?php echo $peopleObj->getFullName() ?></td>
    <td align="<?php echo ($isRing?'left':'right') ?>">
    	<?php
    		$buyin = ($savedResult?$eventPlayerObj->getBuyin():$eventBuyin);
    		$buyin = Util::formatFloat($buyin, true);
    		if( $isRing ){
    			
    			echo input_tag('buyin'.$peopleId, $buyin, array('size'=>5, 'maxlength'=>7, 'tabindex'=>($key+1), 'style'=>'text-align: right', 'id'=>'eventBuyin'.$peopleId));
    		}else{
    			
    			echo input_hidden_tag('buyin'.$peopleId, $buyin, array('style'=>'text-align: right', 'id'=>'eventBuyin'.$peopleId));
    			echo $buyin;
    		}
    	?>
    </td>
    <td><?php echo input_tag('eventPosition'.$peopleId, $eventPlayerObj->getEventPosition(), array('size'=>2, 'maxlength'=>2, 'tabindex'=>($key+1+$recordCount), 'id'=>'eventEventPosition'.$peopleId)) ?></td>
    <td><?php echo input_tag('prize'.$peopleId, Util::formatFloat($eventPlayerObj->getPrize(), true), array('size'=>5, 'maxlength'=>7, 'tabindex'=>($key+1+$recordCount*2), 'style'=>'text-align: right', 'id'=>'eventPrize'.$peopleId)) ?></td>
    <td><?php echo input_tag('rebuy'.$peopleId, Util::formatFloat($eventPlayerObj->getRebuy(), true), array('size'=>5, 'maxlength'=>7, 'tabindex'=>($key+1+$recordCount*3), 'style'=>'text-align: right', 'id'=>'eventRebuy'.$peopleId)) ?></td>
    <td><?php echo input_tag('addon'.$peopleId, Util::formatFloat($eventPlayerObj->getAddon(), true), array('size'=>5, 'maxlength'=>7, 'tabindex'=>($key+1+$recordCount*4), 'style'=>'text-align: right', 'id'=>'eventAddon'.$peopleId)) ?></td>
  </tr>
  <?php
  	endforeach;
  	
  	if( count($eventPlayerObjList)==0 ):
  ?>
  <tr class="boxcontent">
    <td colspan="6">Este ranking não possui convidados para compor os resultados</td>
  </tr>
  <?php endif; ?>
  <tr class="boxcontent">
    <td colspan="6" class="defaultForm">
    	<div class="row" style="margin-top: 3px">
    		<div class="text">Os resultados serão enviados por e-mail a todos os convidados</div>
    	</div>
    </td>
  </tr>
</table>
<br/>
<b>BI</b> = Buy-in<br/>
<b>Pos</b> = Posição/Classificação no torneio/ring<br/>
<b>$$$</b> = Premiação<br/>
<b>RB</b> = Rebuy (valor)<br/>
<b>AD</b> = Add-on (valor)
<?php echo input_hidden_tag('resultTab', true) ?>