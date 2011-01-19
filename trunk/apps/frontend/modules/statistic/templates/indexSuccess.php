<div class="commonBar"><span>Esatísticas</span></div>

<div class="innerContent">
		Para gerar as estatísticas dos seus rankins e eventos,<br/>
		selecione abaixo os filtros e o tipo de gráfico ou relatório que deseja.
</div>
	<table width="100%" border="0" cellspacing="1" cellpadding="2" class="gridTable">
		<tr class="header">
			<th>Formulário de envio de dúvida</th>
		</tr>
		<tr>
			<td>
		
		<?php
			echo form_remote_tag(array(
				'url'=>'statistic/export',
				'success'=>'handleSuccessStats( request.responseText )',
				'failure'=>'enableButton("mainSubmit"); handleFormFieldError( request.responseText, "statisticForm", "statistic", false, "statistic" )',
				'encoding'=>'utf8',
				'loading'=>'showIndicator()'
				), array( 'id'=>'statisticForm' ));
				
				echo input_hidden_tag('export', null);
		?>			
				
			<table width="100%" cellspacing="0" cellpadding="0" class="defaultForm">
				<tr>
					<td>
				<div class="row">
					<div class="label" id="statisticRankingIdLabel">Ranking</div>
					<div class="field" id="rankingIdFieldDiv"><?php echo select_tag('rankingId', Ranking::getOptionsForSelect(), array('class'=>'required', 'id'=>'statisticRankingId')) ?></div>
				</div>
				<div class="row">
					<div class="label" id="statisticReportTypeLabel">Tipo de relatório</div>
					<div class="field" id="reportTypeFieldDiv">
						<?php
							$optionList = array(''=>'Selecione');
							$optionList['playersBalance'] = 'Balanço dos jogadores';
							$optionList['myPerformance']  = 'Meu desempenho';
							$optionList['myBalance']      = 'Meu balanço';
							$optionList['rankHistory']    = 'Histórico de classificação';
							
							echo select_tag('reportType', $optionList, array('class'=>'required', 'onchange'=>'checkReportType()', 'id'=>'statisticReportType')) ?></div>
				</div>
				<div class="row">
					<div class="label" id="statisticFormatLabel">Formato</div>
					<div class="field" id="formatFieldDiv">
						<?php
							echo select_tag('format', array(''=>'Selecione', 'chart'=>'Gráfico', 'report'=>'Planilha'), array('class'=>'required', 'onchange'=>'checkReportType()', 'id'=>'statisticFormat'));
						?>
					</div>
				</div>
				</td>
			</tr>
		</table>
    	
	</td>
  </tr>
</table>

	<div class="buttonBarForm" id="statisticMainButtonBar">
		<?php echo button_tag('mainSubmit', 'Gerar estatísticas', array('onclick'=>'doSubmitStats()')); ?>
		<?php echo getFormLoading('statistic') ?>
		<?php echo getFormStatus(null, null, 'Preencha todos os campos obrigatórios'); ?>
	</div>