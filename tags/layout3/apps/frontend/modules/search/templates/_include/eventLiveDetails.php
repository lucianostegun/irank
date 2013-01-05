<div id="quickEventLiveDetail">
	<div class="quickEventClose" onclick="hideEventLiveDetails()"></div>
	<h1 id="quickEventEventName"></h1>
	<h2 id="quickEventWhen"></h2>
	<h2 id="quickEventWhere"><b></b></h2>
	<h3><label>Rebuys: </label><div id="quickEventRebuys">Ilimitados</div><label>Add-ons:</label><div id="quickEventAddons"></div></h3>
	<div class="separator"></div>
	<table cellspacing="0" cellpadding="0">
		<tr>
			<th><?php echo image_tag('event/coins', array('title'=>'Buyin')) ?></th>
			<th><?php echo image_tag('event/timer', array('title'=>'Duração dos blinds')) ?></th>
			<th><?php echo image_tag('event/chips', array('title'=>'Stack inicial')) ?></th>
			<th><?php echo image_tag('event/players', array('title'=>'Jogadores confirmados')) ?></th>
		</tr>
		<tr>
			<td id="quickEventBuyin"></td>
			<td id="quickEventBlindTime"></td>
			<td id="quickEventStackChips"></td>
			<td id="quickEventPlayers"></td>
		</tr>
	</table>
</div>