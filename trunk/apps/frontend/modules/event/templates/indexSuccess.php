<?php
	$messageList = array();
	
	if( $userSiteObj->getEventCount()==0 )
		$messageList = array('!Você ainda não cadastrou nenhum evento. <b>'.link_to('Clique aqui', 'event/new', array('class'=>'red')).'</b> para criar seu primeiro evento.');
		
	include_partial('home/component/commonBar', array('pathList'=>array(__('event.title')=>'event/index'), 'messageList'=>$messageList));

	echo form_tag('event/search', array('id'=>'eventSearchForm', 'onsubmit'=>'doEventSearch(); return false'));
		echo input_hidden_tag('isIE', null);
?>
<table border="0" cellspacing="0" cellpadding="0" class="gridTable">
	<tr class="header">
		<th class="first"><?php echo __('Event') ?></th>
		<th style="width: 150px">Ranking</th>
		<th style="width: 100px"><?php echo __('DateTime') ?></th>
		<th style="width: 120px"><?php echo __('Place') ?></th>
		<th style="width: 50px" colspan="3"><?php echo __('Guests') ?></th>
	</tr>
	<tr class="filter" style="display: none">
		<th><?php echo input_tag('eventName', $sf_request->getParameter('eventName'), array('size'=>15)) ?></th>
		<th><?php echo select_tag('rankingId', Ranking::getOptionsForSelect($sf_request->getParameter('rankingId'))) ?></th>
		<th><?php echo input_date_tag('eventDate', Util::formatDate($sf_request->getParameter('eventDate')), array('size'=>10, 'maxlength'=>10)) ?></th>
		<th><?php echo input_tag('eventPlace', $sf_request->getParameter('eventPlace'), array('size'=>15)) ?></th>
		<th colspan="4"><?php echo button_tag('eventFilterSubmit', __('button.search'), array('onclick'=>'doEventSearch()')) ?></th>
	</tr>
	<tbody id="eventListContent">
	<?php
			include_partial('event/include/search', array('criteria'=>$criteria));
	?>
	</tbody>
</table>
</form>