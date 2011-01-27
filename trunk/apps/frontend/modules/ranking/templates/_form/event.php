<table width="100%" cellspacing="1" cellpadding="0" style="margin-top: 5px">
	<tr>
		<td valign="top" style="padding: 5px 5px 5px 15px"><?php echo __('ranking.eventsTab.intro') ?></td>
	</tr>
	<tr>
		<td valign="top" class="defaultForm" id="rankingPlayerDiv">
			<?php include_partial('ranking/include/event', array('rankingObj'=>$rankingObj)); ?>
		</td>
	</tr>
</table>