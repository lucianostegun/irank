<div class="commonBar"><span><?php echo __('event.title') ?></span></div>
<?php
	echo form_tag('event/search', array('id'=>'eventSearchForm', 'onsubmit'=>'doEventSearch(); return false'));
		echo input_hidden_tag('isIE', null);
?>
<table width="100%" border="0" cellspacing="1" cellpadding="2" class="gridTable">
	<tr class="header">
		<th><?php echo __('Event') ?></th>
		<th>Ranking</th>
		<th><?php echo __('DateTime') ?></th>
		<th><?php echo __('Place') ?></th>
		<th colspan="3"><?php echo __('Guests') ?></th>
	</tr>
	<tr class="filter">
		<th><?php echo input_tag('eventName', $sf_request->getParameter('eventName'), array('size'=>15)) ?></th>
		<th><?php echo select_tag('rankingId', Ranking::getOptionsForSelect($sf_request->getParameter('rankingId'))) ?></th>
		<th><?php echo input_date_tag('eventDate', Util::formatDate($sf_request->getParameter('eventDate')), array('size'=>10, 'maxlength'=>10)) ?></th>
		<th><?php echo input_tag('eventPlace', $sf_request->getParameter('eventPlace'), array('size'=>15)) ?></th>
		<th width="100" colspan="4"><?php echo button_tag('eventFilterSubmit', __('button.search'), array('onclick'=>'doEventSearch()')) ?></th>
	</tr>
	<tbody id="eventListContent">
	<?php
			include_partial('event/include/search', array('criteria'=>$criteria));
	?>
	</tbody>
</table>
<div class="tabbarFooterInfo">* <?php echo __('event.footer') ?></div>
</form>