<div class="commonBar"><span><?php echo __('eventPersonal.title') ?></span></div>
<div class="innerContent">
	<?php echo __('eventPersonal.intro') ?>
	<br/><br/>
</div>
<?php
	echo form_tag('eventPersonal/search', array('id'=>'eventPersonalSearchForm', 'onsubmit'=>'doEventPersonalSearch(); return false'));
		echo input_hidden_tag('isIE', null);
?>
<table width="100%" border="0" cellspacing="1" cellpadding="2" class="gridTable">
	<tr class="header">
		<th><?php echo __('Event') ?></th>
		<th><?php echo __('Date') ?></th>
		<th><?php echo __('Place') ?></th>
		<th><?php echo __('Players') ?></th>
		<th><?php echo __('Position') ?></th>
		<th>B+R+A</th>
		<th><?php echo __('Prize') ?></th>
	</tr>
	<tr class="filter">
		<th><?php echo input_tag('eventName', $sf_request->getParameter('eventName'), array('size'=>15)) ?></th>
		<th><?php echo input_date_tag('eventDate', Util::formatDate($sf_request->getParameter('eventDate')), array('size'=>10, 'maxlength'=>10)) ?></th>
		<th><?php echo input_tag('eventPlace', $sf_request->getParameter('eventPlace'), array('size'=>15)) ?></th>
		<th></th>
		<th></th>
		<th></th>
		<th width="100"><?php echo button_tag('eventFilterSubmit', __('button.search'), array('onclick'=>'doEventPersonalSearch()')) ?></th>
	</tr>
	<tbody id="eventPersonalListContent">
	<?php
			include_partial('eventPersonal/include/search', array('criteria'=>$criteria));
	?>
	</tbody>
</table>
</form>