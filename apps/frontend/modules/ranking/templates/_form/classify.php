<table width="100%" cellspacing="1" cellpadding="0" style="margin-top: 5px">
	<tr>
		<td valign="top" style="padding: 5px 5px 5px 15px">Classificação atual do ranking</td>
		<td valign="top" style="padding: 5px 5px 5px 15px; text-align: right; font-weight: bold">Data/Histórico:</td> 
		<td valign="top" style="padding: 5px 5px 5px 15px;">
			<?php
				$orderByList   = array(EventPeer::EVENT_DATE=>'desc');
				$eventDateList = $rankingObj->getEventDateList('d/m/Y', true, $orderByList);
				$optionList    = array();
				foreach($eventDateList as $eventDate)
					$optionList[$eventDate] = $eventDate;
					
				echo select_tag('rankingDate', $optionList, array('onchange'=>'loadRankingHistory(this.value)'));
			?>
		</td>
	</tr>
	<tr>
		<td valign="top" colspan="3" class="defaultForm" id="rankingClassifyDiv">
			<?php include_partial('ranking/include/classify', array('rankingObj'=>$rankingObj, 'rankingDate'=>null)); ?>
		</td>
	</tr>
</table>