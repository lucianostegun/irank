<?php
	echo get_partial('ranking/form/main', array('rankingObj'=>$rankingObj));
	echo get_partial('ranking/form/event', array('rankingObj'=>$rankingObj));
	echo get_partial('ranking/form/classify', array('rankingObj'=>$rankingObj));
?>
<br/>
<div align="center">
<table width="95%" cellpadding="0" cellspacing="0" class="menu">
	<tr onclick="hideDiv('eventListDiv'); hideDiv('classifyDiv'); showDiv('infoDiv'); goTop()">
		<td>&nbsp;</td>
		<th><?php echo __('ranking.info') ?></th>
		<td class="topRight">&nbsp;</td>
	</tr>
	<tr onclick="hideDiv('infoDiv'); hideDiv('eventListDiv'); showDiv('classifyDiv'); goTop()">
		<td>&nbsp;</td>
		<th><?php echo __('ranking.rating') ?></th>
		<td>&nbsp;</td>
	</tr>
	<tr onclick="hideDiv('infoDiv'); hideDiv('classifyDiv'); showDiv('eventListDiv'); goTop()" class="last">
		<td>&nbsp;</td>
		<th><?php echo __('ranking.events') ?></th>
		<td>&nbsp;</td>
	</tr>
</table>
</div>
<br/><br/>