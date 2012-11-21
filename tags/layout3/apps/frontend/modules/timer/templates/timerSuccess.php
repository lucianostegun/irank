<div id="blindTimer">
	
	<div class="timerClock">
		<label id="timerHours">00</label>
		<span class="separator"></span>
		<label id="timerMinutes">00</label>
		<span class="separator"></span>
		<label id="timerSeconds">00</label>
	</div>
	
	<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
	
	<div class="blindPanel">
		<span class="roundPanel" id="currentLevel">Level 10</span>
		
		<div class="smallBlind">
			<label>Small blind</label>
			<span id="smallBlindValue">0</span>
		</div>

		<div class="bigBlind">
			<label>Big blind</label>
			<span id="bigBlindValue">0</span>
		</div>

		<div class="bigBlind">
			<label>Ante</label>
			<span id="anteValue">0</span>
		</div>

		<div class="elapsedTime">
			<label>Tempo total</label>
			<span id="elapsedTimeValue">00:00:00</span>
		</div>
	</div>

	<div class="commandBar">
		<?php echo button_tag('timerToggler', 'Iniciar', array('onclick'=>'toggleTimer()')) ?>
		<?php echo button_tag('levelPrevious', 'Anterior', array('onclick'=>'previousLevel(true)', 'disabled'=>true)) ?>
		<?php echo button_tag('levelNext', 'Próximo', array('onclick'=>'nextLevel(true)', 'disabled'=>true)) ?>
		<?php echo button_tag('blindAdd', 'Novo blind', array('onclick'=>'addBlind()')) ?>
	</div>
	
	<div class="clear"></div>
	
	<div id="track1" class="track" style="width: 600px; margin-top: 50px" >
	   <div id="handle1" class="handle" style="width: 17px;"></div>
	</div>
	
	<script type="text/javascript">
		var timerSliderObj = new Control.Slider('handle1' , 'track1', {
			sliderValue: 0,
			values: [],
			disabled: true,
			onSlide: function(v) {
				
				sliderValue = Math.round(v);
				
				if( sliderValue < 0 )
					return false;
					
				stopTimer();
				secondsLeft = sliderValue;
				elapsedSeconds = levelSeconds-secondsLeft;
				updateTimerLabels();
			}
		});
	</script>
	
	<div class="clear"></div>

	<br/>
	<br/>
	<div class="timerLevels">
		<?php
			$dhtmlxGridObj = new DhtmlxGrid('blind');
			$dhtmlxGridObj->setHeader(array('ID',		0,	'left',		'ro',	'int'),
									  array('',			50,	'center',	'img',	'str'),
									  array('#',		30,	'right',	'ro',	'int'),
									  array('Small',	70,	'center',	'ed',	'int'),
									  array('Big',		70,	'center',	'ed',	'int'),
									  array('Ante',		70,	'center',	'ed',	'int'),
									  array('Duração',	40,	'right',	'ed',	'str'),
									  array('#cspan',	50,	'left',		'ro',	'str'),
									  array('Pausa',	75,	'center',	'ch',	'int')
									);
									
			echo input_hidden_tag('timerId', $timerId);
			
			$dhtmlxGridObj->enableDragAndDrop();
			$dhtmlxGridObj->addHandler('onEditCell', 'onCellEditBlind');
			$dhtmlxGridObj->addHandler('onCheck', 'onCheckBlind');
			$dhtmlxGridObj->addHandler('onKeyPress', 'onKeyPressBlind');
			$dhtmlxGridObj->setWidth(600);
			$dhtmlxGridObj->setHeight(350);
			$dhtmlxGridObj->setXmlUrl('/timer/getXml/model/level?timerId='.$timerId);
			$dhtmlxGridObj->build();
		?>
	</div>
</div>
<div class="clear"></div>
