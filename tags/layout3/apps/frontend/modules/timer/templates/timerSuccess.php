<div id="blindTimer">
	<div class="timerClock">
		<label id="timerHours">00</label>
		<span class="separator"></span>
		<label id="timerMinutes">00</label>
		<span class="separator"></span>
		<label id="timerSeconds">00</label>
		
		<div class="smallBlind">
			<div>Small blind</div>
			<div id="smallBlindValue">0</div>
		</div>

		<div class="bigBlind">
			<div>Big blind</div>
			<div id="bigBlindValue">0</div>
		</div>

		<div class="bigBlind">
			<div>Ante</div>
			<div id="anteValue">0</div>
		</div>
	</div>

	<div class="commandBar">
		<?php echo button_tag('timerToggler', 'Iniciar', array('onclick'=>'toggleTimer()')) ?>
		<?php echo button_tag('levelPrevious', 'Anterior', array('onclick'=>'previousLevel()', 'disabled'=>true)) ?>
		<?php echo button_tag('levelNext', 'Próximo', array('onclick'=>'nextLevel()', 'disabled'=>true)) ?>
		<?php echo button_tag('blindAdd', 'Novo blind', array('onclick'=>'addBlind()')) ?>
	</div>
	
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
			
			$dhtmlxGridObj->enableDragAndDrop();
			$dhtmlxGridObj->addHandler('onEditCell', 'onCellEditBlind');
			$dhtmlxGridObj->addHandler('onCheck', 'onCheckBlind');
			$dhtmlxGridObj->addHandler('onKeyPress', 'onKeyPressBlind');
			$dhtmlxGridObj->setHeight(350);
			$dhtmlxGridObj->setXmlUrl('/timer/getXml/model/level?timerId='.$timerId);
			$dhtmlxGridObj->build();
		?>
	</div>
</div>
<div class="clear"></div>
