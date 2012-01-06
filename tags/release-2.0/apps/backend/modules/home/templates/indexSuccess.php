<?php
	$userAdminObj = UserAdmin::getCurrentUser();
?>
<table cellspacing="0" cellpadding="0">
	<tr>
		<td valign="top" style="width: 340px">
		</td>
		<td valign="top">
			<div id="homeRightPanelDiv">
				<div style="margin-top: 10px">Olá <b><?php echo $sf_user->getAttribute('firstName') ?></b>.</div>
			</div>
		</td>
	</tr>
	<tr>
		<td colspan="2" style="padding-top: 10px">
		</td>
	</tr>
</table>