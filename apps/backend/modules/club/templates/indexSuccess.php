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
					<th>Nome</th> 
					<th>Cidade</th> 
					<th>Rankings</th> 
					<th>Eventos</th> 
				</tr> 
			</thead> 
			<tbody id="clubTbody"> 
				<?php
					$criteria = new Criteria();
					if( $clubId )
						$criteria->add( ClubPeer::ID, $clubId);
					
					foreach(Club::getList($criteria) as $clubObj):
						
						$clubId  = $clubObj->getId();
						$onclick = 'goToPage(\'club\', \'edit\', \'clubId\', '.$clubId.')"';
				?>
				<tr class="gradeA" id="clubIdRow-<?php echo $clubId ?>">
					<?php if( $allowDelete ): ?>
						<td><?php echo checkbox_tag('clubId[]', $clubId) ?></td>
					<?php endif; ?> 
					<td onclick="<?php echo $onclick ?>"><?php echo image_tag('club/'.$clubObj->getFileNameLogo(), array('style'=>'height: 40px; margin: -8px 5px -12px 0px')) ?><?php echo $clubObj->getClubName() ?></td> 
					<td onclick="<?php echo $onclick ?>"><?php echo $clubObj->getLocation() ?></td> 
					<td onclick="<?php echo $onclick ?>"><?php echo $clubObj->getRankingCount() ?></td> 
					<td onclick="<?php echo $onclick ?>"><?php echo $clubObj->getEventCount() ?></td> 
				</tr> 
				<?php
					endforeach;
				?>
			</tbody> 
		</table>
	</div>
</div>