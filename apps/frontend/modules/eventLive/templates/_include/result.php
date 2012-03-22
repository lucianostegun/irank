<table border="0" cellspacing="0" cellpadding="0" class="gridTable">
	<tr class="header">
		<th class="first"><?php echo __('Event') ?></th>
		<th style="width: 150px">Ranking</th>
		<th style="width: 100px"><?php echo __('DateTime') ?></th>
		<th style="width: 120px"><?php echo __('Place') ?></th>
		<th style="width: 50px" colspan="3"><?php echo __('Guests') ?></th>
	</tr>
	<tbody id="eventListContent">
	<?php
		include_partial('event/include/search', array('criteria'=>new Criteria()));
	?>
	</tbody>
</table>