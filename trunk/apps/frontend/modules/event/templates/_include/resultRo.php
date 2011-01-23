<table border="0" cellspacing="1" cellpadding="2" class="gridTabTable">
  <tr class="header">
    <th>Nome</th>
    <th>Buy-in</th>
    <th>Posição</th>
    <th>Prêmio</th>
    <th>Rebuy</th>
    <th>Add-on</th>
    <th>Pontos</th>
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
  <tr>
    <td><?php echo $peopleObj->getFullName() ?></td>
    <td align="right"><?php echo Util::formatFloat($buyin, true) ?></td>
    <td>#<?php echo $eventPlayerObj->getEventPosition() ?></td>
    <td align="right"><?php echo Util::formatFloat($eventPlayerObj->getPrize(), true) ?></td>
    <td align="right"><?php echo Util::formatFloat($eventPlayerObj->getRebuy(), true) ?></td>
    <td align="right"><?php echo Util::formatFloat($eventPlayerObj->getAddon(), true) ?></td>
    <td align="right"><?php echo Util::formatFloat($eventPlayerObj->getScore(), true, 3) ?></td>
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