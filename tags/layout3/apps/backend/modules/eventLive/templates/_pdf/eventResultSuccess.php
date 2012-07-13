<style>
	* {
		padding: 0;
		margin: 0;
		font-family: 	helvetica
	}
	
	body {
		
		background: #e8e8e8 url('/images/backgrounds/pdf.png') repeat-x;
	}
	
	.header {
		
		position: 		relative;
		border-bottom: 	thin solid #000000;
		height: 		15mm;
	}
	
	.page {
		page-break-after: always;
		margin: 5mm;
		height: 		287mm;
	}
	
	.resultTable {
	
		margin: 	5mm 1mm;
		border: 	thin solid #303030	
	}
	
	.resultTable.full {
	
		margin: 	0mm;
		border: 	thin solid #303030	
	}

	.resultTable.full.first {
	
		margin: 	5mm 0mm;
	}
	
	.resultTable tr th {
		
		font-size: 		0.7em;
		padding: 		1mm 1mm;
		background: 	#BDC0C0;
		border-bottom: 	thin solid #606060
	}
	
	.resultTable tr td {
		
		font-size: 	0.6em;
		padding: 	0.9mm 1mm
	}
	
	.resultTable.full tr td {
		
		font-size: 	0.7em;
	}

	.resultTable tr td.position {
		
		background: 	#C0c0c0;
		font-weight: 	bold;
	}
	
	.resultTable tr.odd { background: #FFFFFF }
	.resultTable tr.even { background: #D0d0d0 }
	
	.resultTable.full tr.odd,
	.resultTable.full tr.even {
		
		background: 	#FFFFFF;
	}
	
	.resultTable.full tr td {
		
		border-bottom: 	thin solid #303030;
	}
	
	.resultTable.full tr td.dark {
		
		background: 	#E0E0E0;
	}
	
	
	.resultFull h1 {
		
		font-family: Avengeance;
		text-align: center;
		font-size: 28px;
		padding-bottom: 5mm;
		margin-bottom: 0mm;
		border-bottom: thin solid #000000;
	}
	
	.eventPhoto {
		
		width: 90mm;
		margin: 2.5mm;
		border: 0.5mm solid 303030;
		background: #000000;
	}

	.eventPhoto.right1 {
		
		-webkit-transform: rotate(0.1rad);
		-moz-transform: rotate(0.1rad);
		-ms-transform: rotate(0.1rad);
	}

	.eventPhoto.left1 {
		
		-webkit-transform: rotate(-0.1rad);
		-moz-transform: rotate(-0.1rad);
		-ms-transform: rotate(-0.1rad);
	}
	
	.eventPhotos h1 {
		
		font-family: Avengeance;
		text-align: center;
		font-size: 28px;
		padding-bottom: 5mm;
		margin-bottom: 7mm;
		border-bottom: thin solid #000000;
	}
	
	
	.textL { text-align: left }
	.textC { text-align: center }
	.textR { text-align: right }
	.textB { font-weight: bold }
	
	.mt5 { margin-top: 5mm }
	
	.pl2 { padding-left: 20mm }
</style>
</head>
<body>

<div class="page">
	<div class="header">
		<img src="[webDir]/images/logo/pdf.png" />
		<div style="position: absolute; left: 50mm; font-weight: bold; font-size: 1.2em">Resultado do evento <?php echo $eventLiveObj->getEventName() ?></div>
		<div style="position: absolute; left: 50mm; top: 7mm; font-size: 0.8em"><?php echo sprintf('%s, %s @%s', $eventLiveObj->getWeekDay(), $eventLiveObj->getEventDateTime('d/m/Y H:i'), $eventLiveObj->getClub()->toString()); ?></div>
	</div>
	
	<?php
		$eventLivePlayerObjList  = $eventLiveObj->getEventLivePlayerResultList(null, true);
		$players                 = count($eventLivePlayerObjList);
		$rankingLiveObj          = $eventLiveObj->getRankingLive();
		
		$eventLivePlayerObjGroup = array_split($eventLivePlayerObjList, 50);
		
		unset($eventLivePlayerObjList);
		Util::getHelper('Text');
	?>
	<table cellspacing="0" cellpadding="0" style="width: 100%">
		<tr>
			<?php
				$column = 0;
				foreach($eventLivePlayerObjGroup as $eventLivePlayerObjList):
					$column++;
			?>
			<td valign="top" width="33.3%">
				<table class="resultTable" cellspacing="0" cellpadding="0" style="width: 100%">
					<tr>
						<th width="5%">#</th>
						<th>Jogador</th>
						<th width="8%">Pts</th>
					</tr>
				<?php
					$class = 'even';
					foreach($eventLivePlayerObjList as $eventLivePlayerObj):
					
						$peopleObj = $eventLivePlayerObj->getPeople();
						$class = ($class=='odd'?'even':'odd');
				?>
					<tr class="<?php echo $class ?>">
						<td class="position textR"><?php echo $eventLivePlayerObj->getEventPosition() ?>º</td>
						<td class="pl2"><?php echo truncate_text($peopleObj->getName(), 35) ?></td>
						<td class="textR"><?php echo Util::formatFloat($eventLivePlayerObj->getScore(), true, 3) ?></td>
					</tr>
				<?php endforeach; ?>
				</table>		
			</td>
			<?php if( $column==3 ): ?>
			</tr>
			<tr>
			<?php
					$column = 0;
				endif;
				
				endforeach;
			?>
		</tr>
	</table>
</div>




<?php if( $rankingLiveObj->getScoreFormulaOption()=='multiple' ): ?>
<div class="page resultFull">
	<h1>Pontuacao Detalhada</h1>
	<?php
		$eventLivePlayerObjList  = $eventLiveObj->getEventLivePlayerResultList(null, true);
		
		$scoreFormula = $eventLiveObj->getRankingLive()->getScoreFormula();
		$scoreFormulaList = explode('|', $scoreFormula);
		foreach($scoreFormulaList as $key=>$scoreFormula)
			$scoreFormulaList[$key] = preg_replace('/ *:.*/', '', $scoreFormula);
		
		Util::getHelper('Text');
		ob_start();
	?>
	<table class="resultTable full first" cellspacing="0" cellpadding="0" style="width: 100%">
		<tr>
			<th>#</th>
			<th>Jogador</th>
			<?php foreach($scoreFormulaList as $scoreFormula): ?>
			<th><?php echo $scoreFormula ?></th>
			<?php endforeach; ?>
			<th>Pts</th>
		</tr>
		<?php
			$header = ob_get_clean();
			echo $header;
			
			foreach($scoreFormulaList as &$scoreFormula)
				$scoreFormula = String::removeAccents(strtolower(preg_replace('/ *:.*/', '', $scoreFormula)));
			
			$lineLimit   = 45;
			$currentLine = 0;
			$class       = 'even';
			foreach($eventLivePlayerObjList as $key=>$eventLivePlayerObj):
			
				$peopleObj = $eventLivePlayerObj->getPeople();
				$class = ($class=='odd'?'even':'odd');
				$currentLine++;
		?>
			<tr class="<?php echo $class ?>">
				<td width="7mm" class="position textR"><?php echo $eventLivePlayerObj->getEventPosition() ?>º</td>
				<td><?php echo truncate_text($peopleObj->getName(), 35) ?></td>
				<?php
					$classScore = '';
					
					$eventLivePlayerScoreList = $eventLivePlayerObj->getScoreList(true);
	
					foreach($eventLivePlayerScoreList as $eventLivePlayerScore):
						$classScore = ($classScore=='dark'?'':'dark');
				?>
				<td width="20mm" class="textR <?php echo $classScore ?>"><?php echo Util::formatFloat($eventLivePlayerScore, true, 2) ?></td>
				<?php
					endforeach;
					
					$classScore = ($classScore=='dark'?'':'dark');
				?>
				<td width="20mm" class="textR textB <?php echo $classScore ?>"><?php echo Util::formatFloat($eventLivePlayerObj->getScore(), true, 3) ?></td>
			</tr>
		<?php
				if( $currentLine%$lineLimit==0 ){
					
					$lineLimit   = 50;
					$currentLine = 0;
					echo '</table></div><div class="page resultFull">'.str_replace('resultTable full first', 'resultTable full', $header);
				}
			endforeach;
		?>
	</table>
</div>
<?php endif; ?>



<?php
	$eventLivePhotoObjList = $eventLiveObj->getPhotoList();
	
	if( !empty($eventLivePhotoObjList) ):
?>
<div class="page eventPhotos">
	<h1>Fotos do evento</h1>
	<?php
		$classList = array('left1', 'right1', 'normal');
		$lastClass = null;
		foreach($eventLivePhotoObjList as $key=>$eventLivePhotoObj):
		
		do{
			
			$class = $classList[rand(0,2)];
		}while($class==$lastClass);
		
		$lastClass = $class;
	?>
		<img src="<?php echo $eventLivePhotoObj->getFile()->getFilePath(true) ?>" class="eventPhoto <?php echo $class ?>" />	
	<?php
		if( $key > 0 && ($key+1)%6==0 )
			echo '</div><div class="page eventPhotos"><h1>Fotos do evento</h1>';
			
		endforeach;
	?>
</div>
<?php endif; ?>
</body>
</html>

