<style>
	* {
		padding: 0;
		margin: 0;
		font-family: 	helvetica
	}
	
	.header {
		
		position: 		relative;
		border-bottom: 	thin solid #000000;
		height: 		15mm;
	}
	
	.page {
		page-break-after: always;
		margin: 5mm;
	}
	
	.resultTable {
	
		margin-top: 	5mm;
		border: 		thin solid #303030	
	}
	
	.resultTable tr th {
		
		font-size: 		0.7em;
		padding: 		1mm 1mm;
		background: 	#BDC0C0;
		border-bottom: 	thin solid #606060
	}
	
	.resultTable tr td {
		
		font-size: 	0.7em;
		padding: 	1mm 1mm
	}
	
	.resultTable tr.odd { background: #FFFFFF }
	.resultTable tr.even { background: #D0d0d0 }
	
	.textL { text-align: left }
	.textC { text-align: center }
	.textR { text-align: right }
</style>
</head>
<body>

<div class="page">
<div class="header">
	<img src="[webDir]/images/logo/pdf.png" />
	<div style="position: absolute; left: 50mm; font-weight: bold; font-size: 1.2em">Resultado do evento <?php echo $eventLiveObj->getEventName() ?></div>
	<div style="position: absolute; left: 50mm; top: 7mm; font-size: 0.8em"><?php echo sprintf('%s, %s @%s', $eventLiveObj->getWeekDay(), $eventLiveObj->getEventDateTime('d/m/Y H:i'), $eventLiveObj->getClub()->toString()); ?></div>
</div>
<table class="resultTable" cellspacing="0" cellpadding="0" style="width: 100%">
	<tr>
		<th style="width: 7mm">#</th>
		<th>Jogador</th>
		<th style="width: 30mm">Eventos</th>
		<th style="width: 20mm">Pontos</th>
		<th style="width: 20mm">Prêmio</th>
	</tr>
<?php
	$eventLivePlayerObjList = $eventLiveObj->getEventLivePlayerResultList(null, true);

	$class = 'even';
	foreach($eventLivePlayerObjList as $eventLivePlayerObj):
	
		$peopleObj = $eventLivePlayerObj->getPeople();
		$class = ($class=='odd'?'even':'odd');
?>
	<tr class="<?php echo $class ?>">
		<td class="textR"><?php echo $eventLivePlayerObj->getEventPosition() ?></td>
		<td><?php echo $peopleObj->getName() ?></td>
		<td class="textC">0</td>
		<td class="textR"><?php echo Util::formatFloat($eventLivePlayerObj->getScore(), true, 3) ?></td>
		<td class="textR"><?php echo Util::formatFloat($eventLivePlayerObj->getPrize(), true, 2) ?></td>
	</tr>
<?php endforeach; ?>
</table>
</div>
<div class="page">
	<div style="font-family: Avengeance; text-align: center; font-size: 28px">Fotos do evento</div>
	<?php
		foreach($eventLiveObj->getPhotoList() as $key=>$eventLivePhotoObj):
		
		if( ($key+1)%5==0 ):
	?>
		<div class="textC"><img src="<?php echo $eventLivePhotoObj->getFile()->getFilePath(true) ?>" style="height: 110mm; margin-top: 2.5mm" /></div>
		</div><div class="page">	
	<?php else: ?>
		<img src="<?php echo $eventLivePhotoObj->getFile()->getFilePath(true) ?>" style="width: 95mm; margin: 2.5mm" />	
	<?php endif; ?>
	<?php endforeach; ?>
</div>

</body>
</html>

