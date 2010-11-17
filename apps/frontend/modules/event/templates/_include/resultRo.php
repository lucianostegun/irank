<table width="100%" border="0" cellspacing="1" cellpadding="0">
  <tr class="rank_heading">
    <td>Nome</td>
    <td>Buy-in</td>
    <td>Posição</td>
    <td>Prêmio</td>
    <td>Rebuy</td>
    <td>Add-on</td>
  </tr>
  <?php
  	$buyin = $eventObj->getBuyin();
  	
  	$orderByList = array(EventMemberPeer::ENABLED=>'desc',
  						 EventMemberPeer::EVENT_POSITION=>'asc');
  	
  	$eventMemberObjList = $eventObj->getMemberList($orderByList);
  	$recordCount        = count($eventMemberObjList);
  	foreach($eventMemberObjList as $key=>$eventMemberObj):
  	
  		if( !$eventMemberObj->getEnabled() )
  			continue;
  			
  		$peopleObj = $eventMemberObj->getPeople();
  ?>
  <tr class="boxcontent">
    <td><?php echo $peopleObj->getFullName() ?></td>
    <td align="right"><?php echo Util::formatFloat($buyin, true) ?></td>
    <td>#<?php echo $eventMemberObj->getEventPosition() ?></td>
    <td align="right"><?php echo Util::formatFloat($eventMemberObj->getPrize(), true) ?></td>
    <td align="right"><?php echo Util::formatFloat($eventMemberObj->getRebuy(), true) ?></td>
    <td align="right"><?php echo Util::formatFloat($eventMemberObj->getAddon(), true) ?></td>
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