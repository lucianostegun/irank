<h1>Níveis de blinds (3/4)</h1>
<div class="defaultForm">

	<?php
		echo form_remote_tag(array(
			'url'=>'timer/saveWizardLevels',
			'success'=>'handleSuccessWizard( request.responseText )',
			'failure'=>'handleFailureWizard( request.responseText )',
			), array('target'=>'_blank', 'id'=>'timerWizardForm'));
			
		echo input_hidden_tag('step', 4, array('id'=>'timerWizardStep')); // Próxima etapa a ser carregada
	?>
	Defina todos os níveis que deseja utilizar em seu evento.<br/>
	Os níveis já são pré-definidos de acordo com a quantidade de níveis definidos na etapa anterior.<br/>
	Você pode adicionar, remover ou reorganizar os níveis da forma que preferir para que se adapte melhor ao seu evento.<br/><hr/>
	<div id="drag">	
		<table border="0" cellspacing="0" cellpadding="0" class="gridTable" id="timerWizardLevelTable">
			<colgroup>
				<col/>
				<col/>
				<col/>
				<col/>
				<col/>
				<col/>
				<col/>
				<col/>
			</colgroup>
			<tbody id="timerWizardLevels">
				<tr class="header">
					<th class="mark first textR" colspan="2" style="width: 30px">#</th>
					<th class="mark">Small</th>
					<th class="mark">Big</th>
					<th class="mark">Ante</th>
					<th class="mark">Duração</th>
					<th class="mark" colspan="2" style="width: 30px">Pausa</th>
				</tr>
				<?php
					$levelList  = $timerSession->levelList;
					$hasAnte    = $timerSession->hasAnte;
					$levelLabel = 0;
					foreach($levelList as $key=>$level):
					
						$levelNumber = $key+1;
						$isPause     = $level['isPause'];
						$levelLabel += ($isPause?0:1);
				?>
				<tr class="timerLevel" id="timerWizardLevel-<?php echo $levelNumber ?>">
					<td class="rowhandler textC"><div class="drag row"></div></td>
					<td class="blindLevel textR"><?php echo ($isPause?'':"#$levelLabel") ?></td>
					<td><?php echo input_tag('smallBlind[]', $level['smallBlind'], array('size'=>4, 'maxlength'=>5, 'class'=>'textR'.($isPause?' hidden':''), 'onblur'=>'handleBlurSmallBlind(this.id)', 'id'=>'timerWizardSmallBlind-'.$levelNumber)) ?></td>
					<td><?php echo input_tag('bigBlind[]', $level['bigBlind'], array('size'=>4, 'maxlength'=>5, 'class'=>'textR'.($isPause?' hidden':''), 'id'=>'timerWizardBigBlind-'.$levelNumber)) ?></td>
					<td><?php echo input_tag('ante[]', $level['ante'], array('size'=>4, 'maxlength'=>5, 'class'=>'textR'.($isPause?' hidden':''), 'id'=>'timerWizardAnte-'.$levelNumber)) ?></td>
					<td><?php echo input_tag('duration[]', $level['duration'], array('size'=>2, 'maxlength'=>3, 'id'=>'timerWizardDuration-'.$levelNumber)) ?><span class="minuteLabel">min</span></td>
					<td class="textC">
						<?php
							echo checkbox_tag('pause', true, $isPause, array('onclick'=>'handleIsPause(this.checked, '.$levelNumber.')', 'id'=>'timerWizardPause-'.$levelNumber));
							echo input_hidden_tag('isPause[]', ($isPause?'1':''), array('class'=>'timerWizardIsPause', 'id'=>'timerWizardIsPause-'.$levelNumber));
						?>
					</td>
					<td class="textC"><?php echo link_to(image_tag('icon/delete'), '#removeLevel(event)', array('title'=>'Remover este nível')) ?></td>
				</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
	
	</form>

</div>