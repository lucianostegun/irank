<table border="0" cellspacing="1" cellpadding="2" id="rankingFreerollDetailsTable" class="gridTabTable" style="width: 200px; display: none">
	<tr class="header">
		<th colspan="2"><?php echo __('ranking.balance.title') ?></th>
	</tr>
	<tr>
		<th align="right"><?php echo __('TotalEntranceFee') ?> (+)</th>
		<td align="right"><?php echo Util::formatFloat($rankingObj->getTotalEntranceFee(), true) ?></td>
	</tr>
	<tr>
		<th align="right"><?php echo __('TotalPrize') ?> (-)</th>
		<td align="right"><?php echo Util::formatFloat($rankingObj->getTotalFreerollPrize(), true) ?></td>
	</tr>
	<tr>
		<th align="right"><?php echo __('Balance') ?> (=)</th>
		<td align="right"><?php echo Util::formatFloat($rankingObj->getCredit(), true) ?></td>
	</tr>
</table>