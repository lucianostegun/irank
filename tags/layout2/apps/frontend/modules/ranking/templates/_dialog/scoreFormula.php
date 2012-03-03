<table width="100%" height="<?php echo $windowHeight-17 ?>" cellspacing="1" cellpadding="0" class="windowForm">
	<tr>
		<td valign="top">
			
				<div style="text-align: left; padding: 2px 5px 5px 10px">
					Crie uma fórmula matemática utilizando as variáveis permitidas.
				</div>
			
			<div class="rowTextArea">
				<div class="label" id="rankingScoreFormulaScoreformulaLabel"><?php echo __('ranking.scoreFormula') ?></div>
				<div class="field"><?php echo textarea_tag('scoreFormula', $scoreFormula, array('class'=>'required', 'style'=>'width: 250px; height: 50px', 'id'=>'rankingScoreFormulaFormula')) ?></div>
				<div class="textFlex" id="rankingFormulaSuccessDiv"><?php echo image_tag('icon/success20', array('align'=>'absmiddle')) ?> Fórmula válida</div>
			</div>
			
			<div class="rowTextArea" style="height: 120px">
				<div class="label"><?php echo __('ranking.allowedVariables') ?></div>
				<div class="text" style="height: 120px; background: #FFFFFF">
					<b>POSICAO</b> - Posição do jogador no evento<br/>
					<b>EVENTOS</b> - Eventos que o jogador já participou no ranking<br/>
					<b>PREMIO</b> - Valor do prêmio do jogador no evento<br/>
					<b>JOGADORES</b> - Quantidade de jogadores presentes no evento<br/>
					<b>BUYINS</b> - Valor B+R+A arrecadado<br/>
					<b>BUYIN</b> - Valor do buy-in do evento<br/>
					<b>ITM</b> - Posições pagas<br/>
				</div>
			</div>
		</td>
	</tr>
</table>
<div class="windowButtonBar">
	<?php
		echo button_tag('rankingScoreFormulaCancel', __('button.cancel'), array('onclick'=>'windowRankingScoreFormulaHide()'));
		echo button_tag('rankingScoreFormulaSave', __('button.save'), array('onclick'=>'doSaveRankingScoreFormula()', 'disabled'=>true));
		echo button_tag('rankingScoreFormulaValidate', __('button.validateFormula'), array('onclick'=>'doValidateRankingScoreFormula()'));
		echo getFormWindowLoading('rankingScoreFormula');
		echo getFormStatus('rankingScoreFormula');
	?>
</div>