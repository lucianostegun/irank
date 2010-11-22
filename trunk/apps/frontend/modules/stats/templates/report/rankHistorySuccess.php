<?php
$rankingObj = RankingPeer::retrieveByPK($rankingId);
$peopleObj  = PeoplePeer::retrieveByPK($peopleId);

$inputFilePath  = Util::getFilePath('/templates/rankHistory.xls');
$outputFilePath = Util::getFilePath('/temp/rankHistory-'.microtime().'.xls');

$eventDateList = $rankingObj->getEventDateList();
$players       = $rankingObj->getMembers();

// Dataset definition
$DataSet = new pData;

$phpExcelObj = PHPExcel_IOFactory::load($inputFilePath);

$eventDateList = $rankingObj->getEventDateList();
$events        = count($eventDateList);

if( $events > 5 )
	$phpExcelObj->setActiveSheetIndex(0)->insertNewColumnBefore('F', $events-5);

$phpExcelObj->setActiveSheetIndex(0)->insertNewRowBefore(8, $players-2);

$rankingMemberObjList = $rankingObj->getMemberList();

foreach($eventDateList as $key=>$eventDate){
	
	$colName = PHPExcel_Cell::stringFromColumnIndex(($key+1));

	$phpExcelObj->setActiveSheetIndex(0)
				->setCellValue($colName.'6', $eventDate)
				->getColumnDimension($colName)->setWidth(13)
			;
}


$currentLine = 7;
foreach($rankingMemberObjList as $key=>$rankingMemberObj){

	$phpExcelObj->setActiveSheetIndex(0)
				->setCellValue('A'.$currentLine, $rankingMemberObj->getPeople()->getName())
				;
					
	foreach($eventDateList as $key=>$eventDate){
		
		$colName = PHPExcel_Cell::stringFromColumnIndex(($key+1));
	
		$rankingHistoryObj = RankingHistoryPeer::retrieveByPK($rankingObj->getId(), $rankingMemberObj->getPeopleId(), Util::formatDate($eventDate));
	
		$phpExcelObj->setActiveSheetIndex(0)
					->setCellValue($colName.$currentLine, $rankingHistoryObj->getTotalRankingPosition())
					;
	}
	
	$currentLine++;
}

for($line=7; $line <= 7+$players-1; $line++)
	$phpExcelObj->setActiveSheetIndex(0)->getStyle('A'.$line.':'.$colName.$line)->getFill()->applyFromArray(
	    array(
	        'type'       => PHPExcel_Style_Fill::FILL_SOLID,
	        'startcolor' => array('rgb' => ($line%2==0?'A6A6A6':'D0D0D0'))
    	)
	);

$phpExcelObj->setActiveSheetIndex(0)
			->setCellValue('C2', $rankingObj->getRankingName())
			->setCellValue('C3', $rankingObj->getMembers())
			->setCellValue('C4', $rankingObj->getEvents())
			->setCellValue('E4', $rankingObj->getRankingType()->getDescription())
			;


Util::headerExcel('historico_classificacao.xls');
$objWriter = PHPExcel_IOFactory::createWriter($phpExcelObj, 'Excel5');
$objWriter->save( $outputFilePath );

$fileContent = file_get_contents( $outputFilePath );
print_r($fileContent);
unlink($outputFilePath);
exit;
?>