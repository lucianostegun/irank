<?php echo input_hidden_tag('options', true) ?>
<table width="100%" cellspacing="1" cellpadding="0" style="margin-top: 5px">
	<tr>
		<td valign="top" style="padding: 5px 5px 5px 15px"><?php echo __('ranking.optionsTab.intro') ?></td>
	</tr>
	<tr>
		<td valign="top">
			<table cellspacing="2" cellpadding="1" class="defaultForm" style="margin-left: 10px">
			<?php
				foreach($rankingObj->getPrizeSplitList() as $rankingPrizeSplitObj):
				
					$paidPlaces = $rankingPrizeSplitObj->getPaidPlaces();
			?>
				<tr>
					<th><?php echo __('ranking.optionsTab.until') ?></th>
					<td><?php echo input_tag('buyins'.$paidPlaces, $rankingPrizeSplitObj->getBuyins(), array('size'=>2, 'id'=>'rankingSplitPrizeBuyins'.$paidPlaces)) ?></td>
					<th><?php echo __('ranking.optionsTab.buyins', array('%paidPlaces%'=>$paidPlaces)) ?></th>
					<td><?php echo input_tag('percentList'.$paidPlaces, $rankingPrizeSplitObj->getPercentList(), array('size'=>18, 'onkeyup'=>'calculateTotalSplitPrize('.$paidPlaces.')', 'id'=>'rankingSplitPrizePercentList'.$paidPlaces)) ?></td>
					<td id="percent<?php echo $paidPlaces ?>PlacesTotal"></td>
				</tr>
			<?php endforeach; ?>
			</table>
			<div id="extraSplitDiv"></div>
			<!--I18N-->
			<?php #echo link_to('Adicionar regra') ?>
		</td>
	</tr>
</table>