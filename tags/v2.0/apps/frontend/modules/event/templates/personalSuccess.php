<div class="commonBar"><span><?php echo __('event.title') ?></span></div>
<?php
	echo form_tag('event/search', array('id'=>'eventSearchForm', 'onsubmit'=>'doEventSearch(); return false'));
		echo input_hidden_tag('isIE', null);
?>
<table width="100%" border="0" cellspacing="1" cellpadding="2" class="gridTable">
	<tr class="header">
		<th><?php echo __('Event') ?></th>
		<th><?php echo __('DateTime') ?></th>
		<th><?php echo __('Place') ?></th>
		<th><?php echo __('Players') ?></th>
	</tr>
	<tr class="filter">
		<th><?php echo input_tag('eventName', $sf_request->getParameter('eventName'), array('size'=>15)) ?></th>
		<th><?php echo input_date_tag('eventDate', Util::formatDate($sf_request->getParameter('eventDate')), array('size'=>10, 'maxlength'=>10)) ?></th>
		<th><?php echo input_tag('eventPlace', $sf_request->getParameter('eventPlace'), array('size'=>15)) ?></th>
		<th width="100" colspan="2"><?php echo button_tag('eventFilterSubmit', __('button.search'), array('onclick'=>'doEventSearch()')) ?></th>
	</tr>
	<tbody id="eventListContent">
	<?php
			include_partial('event/include/personal/search', array('criteria'=>$criteria));
	?>
	</tbody>
</table>
</form>