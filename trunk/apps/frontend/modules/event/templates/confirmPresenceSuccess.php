<div class="commonBar"><span><?php echo __('event.confirmPresence.title') ?></span></div>


<table width="500" border="0" cellspacing="0" cellpadding="3" class="gridTableFlex" style="margin: 30px">
	<tr>
		<td align="left" valign="top" rowspan="2" align="center">
			<?php echo image_tag('success', array('align'=>'left', 'style'=>'margin: 20px 15px 15px 15px')) ?>
		</td>
		<td align="left" valign="top">
			<?php echo __('event.confirmPresence.successMessage', array('%eventName%'=>$eventObj->getEventName())) ?><br/><br/>
		</td>
	</tr>
	<tr>
		<td align="left" valign="top">
			<?php echo __('event.confirmPresence.link', array('%link%'=>link_to(__('ClickHere'), '#goModule(\'event\', \'show\', \'eventId\', '.$eventObj->getId().')'))) ?><br/>
		</td>
	</tr>
</table>