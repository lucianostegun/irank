<?php
$username  = MyTools::getAttribute('username', MyTools::getCookie('username', (isset($username)?$username:null)));
$firstName = MyTools::getAttribute('firstName', MyTools::getCookie('firstName', (isset($firstName)?$firstName:null)));
?>
<div align="center" style="margin-left: 20px; width: 200px; padding: 5px; background: #FFFFFF; border: 1px solid #333">
<table border="0" width="200" cellspacing="2" cellpadding="0" style="margin-top: 4px">
	<tr>
		<td class="quickLoginHello"><b style="color: #000000">Olá <?php echo $firstName ?></b></td>
		<th><?php echo link_to('logout', '#doQuickLogout()') ?></th>
	</tr>
</table>
<table border="0" width="200" cellspacing="2" cellpadding="0" style="margin-top: 4px">
	<tr>
		<td><?php echo link_to('Meus rankings', 'ranking/index') ?></td>
	</tr>
	<tr>
		<td><?php echo link_to('Novo ranking', 'ranking/new') ?></td>
	</tr>
</table>
</div>