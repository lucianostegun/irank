<div id="resultDiv" style="display: none">

	<?php if( !$eventObj->getSavedResult() ): ?>
		<div class="text">
			O resultado deste evento ainda não foi salvo.<br/><br/>
			Aguarde até que as informações sejam atualizadas pelos responsáveis do evento.
		</div>
		<br/>
	<?php else: ?>
	
		<div class="text">
			Resultado do evento
		</div>
		<br/>
	
		<table width="100%" border="0" cellspacing="0" cellpadding="0" class="gridTable">
		  <tr>
		    <th>Nome</th>
		    <th class="hiddenColumn">Buy-in</th>
		    <th>Posição</th>
		    <th>Prêmio</th>
		    <th class="hiddenColumn">Rebuy</th>
		    <th class="hiddenColumn">Add-on</th>
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
		    <td class="hiddenColumn" align="right"><?php echo Util::formatFloat($buyin, true) ?></td>
		    <td>#<?php echo $eventPlayerObj->getEventPosition() ?></td>
		    <td align="right"><?php echo Util::formatFloat($eventPlayerObj->getPrize(), true) ?></td>
		    <td class="hiddenColumn" align="right"><?php echo Util::formatFloat($eventPlayerObj->getRebuy(), true) ?></td>
		    <td class="hiddenColumn" align="right"><?php echo Util::formatFloat($eventPlayerObj->getAddon(), true) ?></td>
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
	<?php endif; ?>
</div>