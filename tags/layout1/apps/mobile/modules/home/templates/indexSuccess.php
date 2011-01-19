<div class="text">
Olá, seja bem vindo ao modo <i>mobile</i> do site <b>iRank</b>.
</div>
<br/>
<div align="center">
<table width="95%" cellpadding="0" cellspacing="0" class="menu">
	<tr onclick="goModule('ranking', 'index')">
		<td width="20" class="topLeft">&nbsp;</td>
		<td class="middle label"><?php echo image_tag('mobile/home/ranking', array('align'=>'middle')) ?>Meus rankings</td>
		<td width="20" class="topRight">&nbsp;</td>
	</tr>
	<tr onclick="goModule('event', 'index')">
		<td width="20" class="left">&nbsp;</td>
		<td class="middle label"><?php echo image_tag('mobile/home/event', array('align'=>'middle')) ?>Meus eventos</td>
		<td width="20" class="right">&nbsp;</td>
	</tr>
	<?php if( MyTools::isAuthenticated() ): ?>
	<tr onclick="goModule('login', 'logout')">
		<td width="20" class="baseLeft">&nbsp;</td>
		<td class="base label"><?php echo image_tag('mobile/home/close', array('align'=>'middle')) ?>Desconectar</td>
		<td width="20" class="baseRight">&nbsp;</td>
	</tr>
	<?php else: ?>
	<tr onclick="goModule('login', 'index')">
		<td width="20" class="baseLeft">&nbsp;</td>
		<td class="base label"><?php echo image_tag('mobile/home/login', array('align'=>'middle')) ?>Login</td>
		<td width="20" class="baseRight">&nbsp;</td>
	</tr>
	<?php endif; ?>
</table>
</div>