<table width="100%" border="0" cellspacing="1" cellpadding="0">
  <tr class="rank_heading">
    <td>Nome</td>
    <td>Buy-in</td>
    <td>Posição</td>
    <td>Prêmio</td>
    <td>Rebuys</td>
    <td>Add-ons</td>
  </tr>
  <?php
  	$buyIn = $eventObj->getBuyIn();
  	
  	$orderByList = array(EventMemberPeer::ENABLED=>'desc',
  						 EventMemberPeer::EVENT_POSITION=>'asc');
  	
  	$eventMemberObjList = $eventObj->getMemberList($orderByList);
  	$recordCount        = count($eventMemberObjList);
  	foreach($eventMemberObjList as $key=>$eventMemberObj):
  	
  		$peopleObj = $eventMemberObj->getPeople();
  		$peopleId  = $peopleObj->getId();
  		$style     = ($eventMemberObj->getEnabled()?'':'color: #555555');
  ?>
  <tr class="boxcontent">
    <td id="eventResultPeopleName<?php echo $peopleId ?>" style="<?php echo $style ?>"><?php echo $peopleObj->getFullName() ?></td>
    <td><?php echo Util::formatFloat($buyIn, true) ?></td>
    <td><?php echo input_tag('eventPosition'.$peopleId, $eventMemberObj->getEventPosition(), array('size'=>2, 'maxlength'=>2, 'tabindex'=>($key+1), 'id'=>'eventEventPosition'.$peopleId)) ?></td>
    <td><?php echo input_tag('prizeValue'.$peopleId, Util::formatFloat($eventMemberObj->getPrizeValue(), true), array('size'=>5, 'maxlength'=>5, 'tabindex'=>($key+1+$recordCount), 'style'=>'text-align: right', 'onkeyup'=>'maskCurrency(event)', 'id'=>'eventPrizeValue'.$peopleId)) ?></td>
    <td><?php echo input_tag('rebuys'.$peopleId, $eventMemberObj->getRebuys(), array('size'=>5, 'maxlength'=>5, 'tabindex'=>($key+1+$recordCount*2), 'id'=>'eventRebuys'.$peopleId)) ?></td>
    <td><?php echo input_tag('addons'.$peopleId, $eventMemberObj->getAddons(), array('size'=>5, 'maxlength'=>5, 'tabindex'=>($key+1+$recordCount*3), 'id'=>'eventAddons'.$peopleId)) ?></td>
  </tr>
  <?php
  	endforeach;
  	
  	if( count($eventMemberObjList)==0 ):
  ?>
  <tr class="boxcontent">
    <td colspan="6">Este ranking não possui convidados para compor os resultados</td>
  </tr>
  <?php endif; ?>
</table>