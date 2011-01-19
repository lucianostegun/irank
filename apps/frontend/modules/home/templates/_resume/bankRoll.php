<table border="0" cellspacing="1" cellpadding="2" class="resumeBankRollTable">
	<tr>
		<th colspan="2" class="title">BankRoll</th>
	</tr>
	<tr>
		<th>Buy-ins</th>
		<td><?php echo Util::formatFloat($buyin, true) ?></td>
	</tr>
	<tr>
		<th>Rebuys</th>
		<td><?php echo Util::formatFloat($rebuy, true) ?></td>
	</tr>
	<tr>
		<th>Add-ons</th>
		<td><?php echo Util::formatFloat($addon, true) ?></td>
	</tr>
	<tr>
		<th>Ganhos</th>
		<td><?php echo Util::formatFloat($prize, true) ?></td>
	</tr>
	<tr>
		<th>SALDO</th>
		<td><?php echo Util::formatFloat($balance, true) ?></td>
	</tr>
</table>
