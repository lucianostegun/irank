<table width="100%" border="0" cellspacing="0" cellpadding="0" class="onlinepokerrooms_bg2">
  <tr>
	<td align="left" valign="middle" class="poker_heading"><?php echo image_tag('icon/stats', array('style'=>'margin: 2 8 0 10')) ?>Estatísticas</td>
  </tr>
  <tr>
    <td align="left" valign="top" style="padding:15px 23px 16px 20px;">
		Para gerar as estatísticas dos seus rankins e eventos,<br/>
		selecione abaixo os filtros e o tipo de gráfico ou relatório que deseja.
    </td>
  </tr>
  <tr>
    <td align="left" valign="top" style="padding:15px 23px 16px 20px;" class="defaultForm">

	<?php
		echo form_remote_tag(array(
			'url'=>'stats/export',
			'success'=>'handleSuccessStats( request.responseText )',
			'failure'=>'enableButton("mainSubmit"); handleFormFieldError( request.responseText, "statsForm", "stats", false, "stats" )',
			'encoding'=>'utf8',
			'loading'=>'showIndicator()'
			), array( 'id'=>'statsForm' ));
			
			echo input_hidden_tag('export', null);
	?>			
			
			<div class="row">
				<div class="label" id="statsRankingIdLabel">Ranking</div>
				<div class="field" id="rankingIdFieldDiv"><?php echo select_tag('rankingId', Ranking::getOptionsForSelect(), array('class'=>'required', 'id'=>'statsRankingId')) ?></div>
			</div>
			<div class="row">
				<div class="label" id="statsFormatLabel">Formato</div>
				<div class="field" id="formatFieldDiv"><?php echo select_tag('format', array(''=>'Selecione', 'chart'=>'Gráfico', 'report'=>'Relatório'), array('class'=>'required', 'id'=>'statsFormat')) ?></div>
			</div>
			<div class="row">
				<div class="label" id="statsReportTypeLabel">Tipo de informação</div>
				<div class="field" id="reportTypeFieldDiv"><?php echo select_tag('reportType', array(''=>'Selecione', 'playersBalance'=>'Balanço dos jogadores', 'myPerformance'=>'Meu desempenho', 'myBalance'=>'Meu balanço'), array('class'=>'required', 'id'=>'statsReportType')) ?></div>
			</div>
			<div class="row" style="display: none">
				<div class="label" id="statsPeriodLabel">Período</div>
				<div class="field"><?php echo input_date_tag('periodStart', null, array('size'=>10, 'maxlength'=>10, 'class'=>'required', 'id'=>'statsPeriodStart')) ?></div>
				<div class="textFlex">a</div>
				<div class="field"><?php echo input_date_tag('periodFinish', null, array('size'=>10, 'maxlength'=>10, 'class'=>'required', 'id'=>'statsPeriodStart')) ?></div>
			</div>
    	
	</td>
  </tr>
</table>

	<div class="buttonBarForm" id="statsMainButtonBar" style="border: 0px transparent">
		<?php echo button_tag('mainSubmit', 'Gerar estatísticas', array('onclick'=>'doSubmitStats()')); ?>
		<?php echo getFormLoading('stats') ?>
		<?php echo getFormStatus(null, null, 'Preencha todos os campos obrigatórios'); ?>
	</div>