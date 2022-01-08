<style>
.bankroll th {
	
	text-align: 	right;
	padding: 		3 10px 3px 3px;
	font-size: 		8pt;
}

.bankroll td {
	
	text-align: right;
}
</style>
<table border="0" cellspacing="0" cellpadding="0" class="bankroll">
  <tr>
  	<th>B+R+A</th>
  	<td><?php echo Util::formatFloat($buyin+$rebuy+$addon, true) ?></td>
  </tr>
  <tr>
  	<th><i>Buy-ins</i></th>
  	<td><?php echo Util::formatFloat($buyin, true) ?></td>
  </tr>
  <tr>
  	<th><i>Rebuys</i></th>
  	<td><?php echo Util::formatFloat($rebuy, true) ?></td>
  </tr>
  <tr>
  	<th><i>Add-ons</i></th>
  	<td><?php echo Util::formatFloat($addon, true) ?></td>
  </tr>
</table>
<br/>
<table border="0" cellspacing="0" cellpadding="0" class="bankroll">
  <tr>
  	<th>Prêmios</th>
  	<td><?php echo Util::formatFloat($prize, true) ?></td>
  </tr>
  <tr>
  	<th>Média</th>
  	<td><?php echo Util::formatFloat($average, true) ?></td>
  </tr>
  <tr>
  	<th>Pontos</th>
  	<td><?php echo Util::formatFloat($score, true) ?></td>
  </tr>
</table>
