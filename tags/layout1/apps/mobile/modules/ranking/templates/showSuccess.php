<?php
	echo get_partial('ranking/form/main', array('rankingObj'=>$rankingObj));
	echo get_partial('ranking/form/event', array('rankingObj'=>$rankingObj));
	echo get_partial('ranking/form/classify', array('rankingObj'=>$rankingObj));
?>
<br/>
<div align="center">
<table width="95%" cellpadding="0" cellspacing="0" class="menu">
	<tr onclick="hideDiv('eventListDiv'); hideDiv('classifyDiv'); showDiv('infoDiv'); goTop()">
		<td width="20" class="topLeft">&nbsp;</td>
		<td class="middle label">Informações</td>
		<td width="20" class="topRight">&nbsp;</td>
	</tr>
	<tr onclick="hideDiv('infoDiv'); hideDiv('eventListDiv'); showDiv('classifyDiv'); goTop()">
		<td width="20" class="left">&nbsp;</td>
		<td class="middle label">Classificação</td>
		<td width="20" class="right">&nbsp;</td>
	</tr>
	<tr onclick="hideDiv('infoDiv'); hideDiv('classifyDiv'); showDiv('eventListDiv'); goTop()">
		<td width="20" class="baseLeft">&nbsp;</td>
		<td class="base label">Eventos</td>
		<td width="20" class="baseRight">&nbsp;</td>
	</tr>
</table>
</div>
<br/><br/>