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
  	
  	$orderByList = array(EventPlayerPeer::ENABLED=>'desc',
  						 EventPlayerPeer::EVENT_POSITION=>'asc');
  	
  	$eventPlayerObjList = $eventObj->getPlayerList($orderByList);
  	$recordCount        = count($eventPlayerObjList);
  	foreach($eventPlayerObjList as $key=>$eventPlayerObj):
  	
  		if( !$eventPlayerObj->getEnabled() )
  			continue;
  			
  		$peopleObj = $eventPlayerObj->getPeople();
  ?>
  <tr class="boxcontent">
    <td><?php echo $peopleObj->getFullName() ?></td>
    <td align="right"><?php echo Util::formatFloat($buyin, true) ?></td>
    <td>#<?php echo $eventPlayerObj->getEventPosition() ?></td>
    <td align="right"><?php echo Util::formatFloat($eventPlayerObj->getPrize(), true) ?></td>
    <td align="right"><?php echo Util::formatFloat($eventPlayerObj->getRebuy(), true) ?></td>
    <td align="right"><?php echo Util::formatFloat($eventPlayerObj->getAddon(), true) ?></td>
  </tr>
  <?php
  	endforeach;
  	
  	if( count($eventPlayerObjList)==0 ):
  ?>
  <tr class="boxcontent">
    <td colspan="6">Este ranking não possui convidados para compor os resultados</td>
  </tr>
  <?php endif; ?>
</table>