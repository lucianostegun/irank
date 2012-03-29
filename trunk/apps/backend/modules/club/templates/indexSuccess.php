<?php
	$clubId = $sf_user->getAttribute('clubId');
	
	$allowDelete = !$clubId; // Se o usuário não estiver relacionado a um clube, permite excluir
	
	echo form_remote_tag(array(
		'url'=>'club/delete',
		'success'=>'handleSuccessClubIndex(request.responseText)',
		'failure'=>'handleFailureClubIndex(request.responseText)',
		'loading'=>'showIndicator("club")',
		'encoding'=>'UTF8',
	), array('id'=>'clubForm'));
?>
<article class="module width_full">
	<header></header>
	<table class="tablesorter hoHeader" cellspacing="0"> 
	<thead> 
		<tr> 
			<?php if( $allowDelete ): ?>
				<th class="checkbox"></th>
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
			
			$clubIdList = array();
			foreach(Club::getList($criteria) as $clubObj):
				
				$clubId       = $clubObj->getId();
				$clubIdList[] = $clubId;
				
				$onclick = 'goToPage(\'club\', \'edit\', \'clubId\', '.$clubId.')"';
		?>
		<tr onmouseover="this.addClassName('hover')" onmouseout="this.removeClassName('hover')" id="clubIdRow-<?php echo $clubId ?>">
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
			
			$recordCount = count($clubIdList);
		?>
		<tr class="<?php echo ($recordCount?'hidden':'') ?>" id="clubNoRecordsRow">
			<td colspan="4">Nenhum registro disponível para edição</td>
		</tr>
	</tbody> 
	</table>
<?php include_partial('home/include/paginator', array('prefix'=>'club', 'recordCount'=>$recordCount, 'allowDelete'=>$allowDelete)) ?>
</article><!-- end of content manager article -->
</form>