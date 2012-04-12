<?php
	if( $userSiteObj->getRankingCount()==0 )
		$messageList = array('!Você ainda não está participando de nenhum ranking. <b>'.link_to('Clique aqui', 'ranking/new', array('class'=>'red')).'</b> para criar e compartilhar seu primeiro ranking.');
	else
		$messageList = array();
	
	include_partial('home/component/commonBar', array('pathList'=>array('Rankings'=>'ranking/index'), 'messageList'=>$messageList));
?>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="gridTable">
	<tr class="header">
		<th width="200" class="first"><?php echo __('ranking.name') ?></th>
		<th><?php echo __('ranking.style') ?></th>
		<th><?php echo __('ranking.start') ?></th>
		<th><?php echo __('ranking.finish') ?></th>
		<th>Buy-in</th>
		<th><?php echo __('ranking.players') ?></th>
		<th><?php echo __('ranking.events') ?></th>
	</tr>
	<tbody id="rankingListContent">
	<?php include_partial('ranking/include/search', array('criteria'=>$criteria, 'userSiteObj'=>$userSiteObj)); ?>
	</tbody>
</table>