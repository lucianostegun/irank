<?php include_partial('home/component/commonBar', array('pathList'=>array(__('statistic.title')=>null))); ?>
<?php echo image_tag('statistic', array('class'=>'logo')) ?>
<div class="moduleIntro image">
	A geração de estatísticas ajuda você a conhecer melhor seu próprio jogo através relatórios com o resultado completo de todos os eventos de um determinado ranking.
	<br/><br/>
	Utilize os gráficos para identificar sua melhor fase durante o ano. Compare sua posição no ranking com o primeiro.
	Você também pode obter um relatório detalhado de seus gastos, ganhos e balanço financeiro.
</div>
<hr class="separator"/>
<div align="center">
<?php if( $sf_user->isAuthenticated() ): ?>
	<table border="0" cellspacing="0" cellpadding="0" class="formTable" style="width: 600px">
		<tr>
			<th><h1>Estatísticas</h1></th>
		</tr>
		<tr>
			<td>
			<?php
				echo form_remote_tag(array(
					'url'=>'statistic/export',
					'success'=>'handleSuccessStats(request.responseText)',
					'failure'=>'handleFailureStats(request.responseText)',
					'encoding'=>'UTF8',
					), array('id'=>'statisticForm'));
					
					echo input_hidden_tag('export', null);
			?>			
				<div class="defaultForm">
					<div class="row">
						<div class="label" id="statisticRankingIdLabel">Ranking</div>
						<div class="field" id="rankingIdFieldDiv"><?php echo select_tag('rankingId', Ranking::getOptionsForSelect(false, false, true), array('class'=>'required', 'id'=>'statisticRankingId')) ?></div>
					</div>
					<div class="row">
						<div class="label" id="statisticReportTypeLabel"><?php echo __('statistic.reportType') ?></div>
						<div class="field" id="reportTypeFieldDiv">
							<?php
								$optionList = array(''=>__('select'));
								$optionList['playersBalance'] = __('statistic.reportType.playersBalance');
								$optionList['myPerformance']  = __('statistic.reportType.myPerformance');
								$optionList['myBalance']      = __('statistic.reportType.myBalance');
								$optionList['rankHistory']    = __('statistic.reportType.rankHistory');
								
								echo select_tag('reportType', $optionList, array('class'=>'required', 'onchange'=>'checkReportType()', 'id'=>'statisticReportType')) ?></div>
					</div>
					<div class="row">
						<div class="label" id="statisticFormatLabel"><?php echo __('statistic.format') ?></div>
						<div class="field" id="formatFieldDiv">
							<?php
								echo select_tag('format', array(''=>__('select'), 'chart'=>__('statistic.format.chart'), 'report'=>__('statistic.format.spreadsheet')), array('class'=>'required', 'onchange'=>'checkReportType()', 'id'=>'statisticFormat'));
							?>
						</div>
					</div>
			  		<div class="separator"></div>
					<div class="buttonBarForm" id="statisticMainButtonBar">
						<?php echo button_tag('mainSubmit', __('button.buildStatistic'), array('onclick'=>'doSubmitStats()')); ?>
						<?php echo getFormLoading('statistic') ?>
						<?php echo getFormStatus(null, null, __('statistic.buildError')); ?>
					</div>
				</div>
			</td>
  		</tr>
	</table>
<?php else: ?>
	<div class="mt40">Para gerar as estatísticas você precisa estar cadastrado e logado no site.</div>
<?php endif; ?>
</div>