<?php
	$clubId = $sf_user->getAttribute('clubId');
	
	$allowDelete = !$clubId; // Se o usuário não estiver relacionado a um clube, permite excluir
?>
<div class="wrapper">
    <div class="widget">
		<div class="title"><span class="titleIcon"><input type="checkbox" id="titleCheck" name="titleCheck" /></span><h6>Clubes</h6></div>                          
		<table cellpadding="0" cellspacing="0" width="100%" class="display dTable withCheck" id="checkAll">
		    <thead>
				<tr>
					<?php if( $allowDelete ): ?>
					<th width="10"><?php echo image_tag('backend/icons/tableArrows') ?></th>
					<?php endif; ?> 
					<th>Mesa</th> 
					<th>Situação</th> 
					<th>Modalidade</th> 
					<th>Jogadores</th> 
					<th>Buyin</th> 
					<th>Valor atual</th> 
				</tr> 
			</thead> 
			<tbody id="clubTbody"> 
				<?php
					$criteria = new Criteria();
					if( $clubId )
						$criteria->add( ClubPeer::ID, $clubId);
					
					foreach(CashTable::getList($criteria) as $cashTableObj):
						
						$cashTableId  = $cashTableObj->getId();
						$onclick = 'goToPage(\'cashTable\', \'edit\', \'cashTableId\', '.$cashTableId.')"';
				?>
				<tr class="gradeA" id="cashTableIdRow-<?php echo $cashTableId ?>">
					<?php if( $allowDelete ): ?>
						<td><?php echo checkbox_tag('cashTableId[]', $cashTableId) ?></td>
					<?php endif; ?> 
					<td onclick="<?php echo $onclick ?>"><?php echo $cashTableObj->getCashTableName() ?></td> 
					<td width="10%" onclick="<?php echo $onclick ?>"><?php echo $cashTableObj->getTableStatus(true) ?></td> 
					<td width="10%" onclick="<?php echo $onclick ?>" class="textC"><?php echo $cashTableObj->getGameType()->getDescription() ?></td> 
					<td width="10%" onclick="<?php echo $onclick ?>" class="textC"><?php echo $cashTableObj->getPlayers() ?></td> 
					<td width="10%" onclick="<?php echo $onclick ?>" class="textR"><?php echo Util::formatFloat($cashTableObj->getBuyin(), true) ?></td> 
					<td width="10%" onclick="<?php echo $onclick ?>" class="textR"><?php echo Util::formatFloat($cashTableObj->getCurrentValue(), true) ?></td> 
				</tr> 
				<?php
					endforeach;
				?>
			</tbody> 
		</table>
	</div>
</div>