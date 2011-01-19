<?php
$rankingObj = RankingPeer::retrieveByPK($rankingId);
$peopleObj  = PeoplePeer::retrieveByPK($peopleId);

$peopleIdOther = $rankingObj->getByPlace(1)->getPeopleId();
$otherPlace    = '1';

if( $peopleIdOther==$peopleId ){
	
	$peopleObjOther = $rankingObj->getByPlace(2);
	
	if( is_object($peopleObjOther) ){
		
		$peopleIdOther = $peopleObjOther->getPeopleId();
		$otherPlace    = '2';
	}else{
		
		$peopleIdOther = $peopleId;
	}
}

$inputFilePath  = Util::getFilePath('/templates/myPerformance.xls');
$outputFilePath = Util::getFilePath('/temp/myPerformance-'.microtime().'.xls');

$phpExcelObj = PHPExcel_IOFactory::load($inputFilePath);

$eventDateList = $rankingObj->getEventDateList();
$events        = count($eventDateList);

$phpExcelObj->setActiveSheetIndex(0)->insertNewRowBefore(8, $events-2);

for($line=7; $line <= 7+$events-1; $line++)
	$phpExcelObj->setActiveSheetIndex(0)->getStyle('A'.$line.':E'.$line)->getFill()->applyFromArray(
	    array(
	        'type'       => PHPExcel_Style_Fill::FILL_SOLID,
	        'startcolor' => array('rgb' => ($line%2==0?'A6A6A6':'D0D0D0'))
    	)
	);

$phpExcelObj->setActiveSheetIndex(0)
			->setCellValue('C2', $rankingObj->getRankingName())
			->setCellValue('C3', $rankingObj->getPlayers())
			->setCellValue('C4', $rankingObj->getEvents())
			->setCellValue('E4', $rankingObj->getRankingType()->getDescription())
			->setCellValue('B6', $peopleObj->getName().' (por data)')
			->setCellValue('D6', $otherPlace.' (por data)')
			->setCellValue('C6', $peopleObj->getName().' (progressivo)')
			->setCellValue('C6', $otherPlace.' (progressivo)')
			;
						
$currentLine = 7;
foreach($eventDateList as $key=>$eventDate){

	$rankingHistoryObj = RankingHistoryPeer::retrieveByPK($rankingObj->getId(), $peopleId, Util::formatDate($eventDate));	
	$position          = $rankingHistoryObj->getRankingPosition();
	$totalPosition     = $rankingHistoryObj->getTotalRankingPosition();
	
	$rankingHistoryObj  = RankingHistoryPeer::retrieveByPK($rankingObj->getId(), $peopleIdOther, Util::formatDate($eventDate));
	$positionOther      = $rankingHistoryObj->getRankingPosition();
	$totalPositionOther = $rankingHistoryObj->getTotalRankingPosition();

	$phpExcelObj->setActiveSheetIndex(0)
				->setCellValue('A'.$currentLine, $eventDate)
				->setCellValue('B'.$currentLine, $position)
				->setCellValue('C'.$currentLine, $totalPosition)
				->setCellValue('D'.$currentLine, $positionOther)
				->setCellValue('E'.$currentLine, $totalPositionOther);

	$currentLine++;
}

Util::headerExcel('meu_desempenho.xls');
$objWriter = PHPExcel_IOFactory::createWriter($phpExcelObj, 'Excel5');
$objWriter->save( $outputFilePath );

$fileContent = file_get_contents( $outputFilePath );
print_r($fileContent);
unlink($outputFilePath);
exit;
?>