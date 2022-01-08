<div class="formRow">
	<label>Histórico</label>
	<div class="formRight">
		<?php echo select_tag('rankingDate', $rankingLiveObj->getHistoryClassifyOptions(), array('onchange'=>'loadRankingLiveHistory(this.value)')); ?>
	</div>
	<div class="clear"></div>
</div>
<div class="widget">
	<table cellpadding="0" cellspacing="0" width="100%" class="display sTable">
		<thead>
			<tr class="thead"> 
				<th class="mark">#</th> 
				<th class="mark">Nome</th> 
				<th class="mark">E-mail</th> 
				<th class="mark">Pontos</th> 
				<th class="mark">Prêmio</th> 
				<th class="mark">Eventos</th> 
			</tr>
		</thead>
		<tbody id="rankingLiveClassifyTbody">
			<?php include_partial('rankingLive/include/classify', array('rankingLiveObj'=>$rankingLiveObj, 'rankingDate'=>null)) ?>
		</tbody>
	</table>
</div>