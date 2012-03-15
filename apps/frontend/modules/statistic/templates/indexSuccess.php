<?php include_partial('home/component/commonBar', array('pathList'=>array(__('statistic.title')=>null))); ?>

<div class="moduleIntro">
		<?php echo __('statistic.intro') ?>
</div>
<div align="center">
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
					), array( 'id'=>'statisticForm' ));
					
					echo input_hidden_tag('export', null);
			?>			
				<div class="defaultForm">
					<div class="row">
						<div class="label" id="statisticRankingIdLabel">Ranking</div>
						<div class="field" id="rankingIdFieldDiv"><?php echo select_tag('rankingId', Ranking::getOptionsForSelect(), array('class'=>'required', 'id'=>'statisticRankingId')) ?></div>
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
</div>