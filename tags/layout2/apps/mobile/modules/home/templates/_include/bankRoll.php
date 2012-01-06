<br/>
<h1>Bankroll</h1>

	<table width="95%" cellpadding="0" cellspacing="0" border="0" class="mobileForm">
		<tr>
			<td colspan="3" class="formContent">
				<table cellpadding="0" cellspacing="0" width="100%" class="formTable">
					<tr>
						<th class="firstLine">Buy-ins:</th>
						<td class="firstLine"><?php echo Util::formatFloat($buyin, true) ?></td>
						<th class="firstLine" style="background: #FFFFFF">Rebuys:</th>
						<td class="firstLine"><?php echo Util::formatFloat($rebuy, true) ?></td>
					</tr>
					<tr>
						<th>Add-ons:</th>
						<td><?php echo Util::formatFloat($addon, true) ?></td>
						<th style="background: #FFFFFF"><?php echo __('resume.prizes') ?>:</th>
						<td><?php echo Util::formatFloat($prize, true) ?></td>
					</tr>
					<tr>
						<th class="lastLine"><?php echo __('resume.credits') ?>:</th>
						<td class="lastLine" colspan="3"><?php echo Util::formatFloat($balance, true) ?></td>
					</tr>
				</table>
			</td>
		</tr>
	</table>