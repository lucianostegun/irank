<table width="100%" cellspacing="1" cellpadding="0" style="margin-top: 5px" class="defaultForm">
	<tr>
		<td valign="top" style="padding: 5px 5px 5px 15px"><?php echo __('ranking.importTab.intro') ?><br/><br/></td>
	</tr>
	<tr>
		<td valign="top">
			<div class="row">
				<div class="label">Ranking</div>
				<div class="field"><?php echo select_tag('rankingIdImport', Ranking::getOptionsForSelect(false, false, true), array('id'=>'rankingRankingIdImport')) ?></div>
			</div>
			<br/>
			<div class="rowCheckbox">
				<div class="field"><?php echo checkbox_tag('rankingPlaces', true, true, array('id'=>'rankingImportRankingPlaces')) ?></div>
				<label for="rankingImportRankingPlaces"><?php echo __('ranking.import.rankingPlaces') ?></label>
			</div>
			
			<div class="rowCheckbox">
				<div class="field"><?php echo checkbox_tag('rankingPlayers', true, true, array('id'=>'rankingImportRankingPlayers')) ?></div>
				<label for="rankingImportRankingPlayers"><?php echo __('ranking.import.rankingPlayers') ?></label>
			</div>
		</td>
	</tr>
</table>