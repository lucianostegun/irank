<div class="innerFilter">
	<?php
		echo form_tag('ranking/search', array('id'=>'rankingSearchForm', 'onsubmit'=>'doRankingSearch(); return false'));
		echo input_hidden_tag('isIE', null);
	?>
	<table cellspacing="0" cellpadding="0">
		<tr>
			<td><?php echo input_tag('dateStart', $sf_request->getParameter('dateStart'), array('onkeyup'=>'maskDate(event)', 'placeholder'=>'Início')); new Calendar('dateStart') ?></td>
			<td><?php echo input_tag('dateEnd', $sf_request->getParameter('dateEnd'), array('onkeyup'=>'maskDate(event)', 'placeholder'=>'Término')); new Calendar('dateEnd') ?></td>
		<tr>
		<tr>
			<td colspan="2"><?php echo input_tag('rankingName', $sf_request->getParameter('rankingName'), array('placeholder'=>'Nome do ranking', 'class'=>'double')) ?></td>
		<tr>
		<tr>
			<td colspan="2"><?php echo select_tag('status', options_for_select(array('all'=>'Todos os rankings', 'active'=>'Rankings ativos', 'old'=>'Rankings antigos'), 'active')) ?></td>
		<tr>
		<tr>
			<td><?php echo input_tag('eventsStart', $sf_request->getParameter('eventsStart'), array('placeholder'=>'Eventos')); ?></td>
			<td><?php echo input_tag('eventsEnd', $sf_request->getParameter('eventsEnd'), array('placeholder'=>'Eventos'));?></td>
		<tr>
		<tr>
			<td><?php echo input_tag('playersStart', $sf_request->getParameter('playersStart'), array('placeholder'=>'Jogadores')); ?></td>
			<td><?php echo input_tag('playersEnd', $sf_request->getParameter('playersEnd'), array('placeholder'=>'Jogadores'));?></td>
		<tr>
		<tr>
			<td></td>
			<td><?php echo button_tag('rankingSearch', 'Filtrar', array('onclick'=>'doRankingSearch()', 'style'=>'float: right')) ?></td>
		<tr>
	</table>
</div>
</form>