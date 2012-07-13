<?php
	$messageList = array();
	
	if( $userSiteObj->getEventCount()==0 )
		$messageList = array('!Você ainda não cadastrou nenhum evento. <b>'.link_to('Clique aqui', 'event/new', array('class'=>'red')).'</b> para criar seu primeiro evento.');
		
	include_partial('home/component/commonBar', array('pathList'=>array(__('event.title')=>'event/index'), 'messageList'=>$messageList));
?>
<table border="0" cellspacing="0" cellpadding="0" class="gridTable">
	<tr class="header">
		<th style="width: 225px" class="first"><?php echo __('Event') ?></th>
		<th style="width: 175px">Ranking</th>
		<th style="width: 110px"><?php echo __('DateTime') ?></th>
		<th style="width: 150px"><?php echo __('Place') ?></th>
		<th style="width: 50px" colspan="3"><?php echo __('Guests') ?></th>
	</tr>
	<tbody id="eventListContent">
	<?php include_partial('event/include/search', array('criteria'=>$criteria)); ?>
	</tbody>
</table>