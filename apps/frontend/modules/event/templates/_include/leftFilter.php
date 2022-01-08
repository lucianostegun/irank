<div class="innerFilter">
	<?php
		echo form_tag('event/search', array('id'=>'eventSearchForm', 'onsubmit'=>'doEventSearch(); return false'));
		echo input_hidden_tag('isIE', null);
		echo input_hidden_tag('filter', true);
		
		$rankingOptionList = Ranking::getOptionsForSelect($sf_request->getParameter('rankingId'), true, true, false);
		$rankingOptionList[''] = 'Rankings ativos';
		$rankingOptionList['all'] = 'Todos os rankings';
		ksort($rankingOptionList);
	?>
	<table cellspacing="0" cellpadding="0">
		<tr>
			<td><?php echo input_tag('dateStart', $sf_request->getParameter('dateStart'), array('onkeyup'=>'maskDate(event)', 'placeholder'=>'Data inicial', 'maxlength'=>10)); new Calendar('dateStart') ?></td>
			<td><?php echo input_tag('dateEnd', $sf_request->getParameter('dateEnd'), array('onkeyup'=>'maskDate(event)', 'placeholder'=>'Data final', 'maxlength'=>10)); new Calendar('dateEnd') ?></td>
		<tr>
		<tr>
			<td colspan="2"><?php echo input_tag('eventName', $sf_request->getParameter('eventName'), array('placeholder'=>'Nome do evento', 'class'=>'double')) ?></td>
		<tr>
		<tr>
			<td colspan="2"><?php echo select_tag('rankingId', options_for_select($rankingOptionList, 'active')) ?></td>
		<tr>
		<tr>
			<td colspan="2"><?php echo input_tag('eventPlace', $sf_request->getParameter('eventPlace'), array('placeholder'=>'Local do evento', 'class'=>'double')) ?></td>
		<tr>
		<tr>
			<td></td>
			<td><?php echo button_tag('eventSearch', 'Filtrar', array('onclick'=>'doEventSearch()', 'style'=>'float: right')) ?></td>
		<tr>
	</table>
</div>
</form>