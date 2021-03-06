<?php
Util::getHelper('I18N');

$rankingObj = RankingPeer::retrieveByPK($rankingId);
$peopleObj  = PeoplePeer::retrieveByPK($peopleId);

$culture        = MyTools::getCulture();
$inputFilePath  = Util::getFilePath('/templates/rankHistory.xls');
$outputFilePath = Util::getFilePath('/temp/rankHistory-'.microtime().'.xls');

$eventDateList = $rankingObj->getEventDateList();
$players       = $rankingObj->getPlayers();

// Dataset definition
$DataSet = new pData;

$phpExcelObj = PHPExcel_IOFactory::load($inputFilePath);

$eventDateList = $rankingObj->getEventDateList();
$events        = count($eventDateList);

if( $events > 5 )
	$phpExcelObj->setActiveSheetIndex(0)->insertNewColumnBefore('F', $events-5);

$phpExcelObj->setActiveSheetIndex(0)->insertNewRowBefore(8, $players-2);

$orderByList = array(RankingPlayerPeer::TOTAL_SCORE=>'desc');
$rankingPlayerObjList = $rankingObj->getPlayerList($orderByList);

$eventDateList = array_merge(array(), $eventDateList);

foreach($eventDateList as $key=>$eventDate){
	
	$colName = PHPExcel_Cell::stringFromColumnIndex(($key+1));

	$phpExcelObj->setActiveSheetIndex(0)
				->setCellValue($colName.'6', $eventDate)
				->getColumnDimension($colName)->setWidth(13)
			;
}


$currentLine = 7;
foreach($rankingPlayerObjList as $key=>$rankingPlayerObj){

	$phpExcelObj->setActiveSheetIndex(0)
				->setCellValue('A'.$currentLine, '	'.$rankingPlayerObj->getPeople()->getName())
				;
				
	$phpExcelObj->setActiveSheetIndex(0)->getStyle('A'.$currentLine)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);

	foreach($eventDateList as $key=>$eventDate){
		
		$colName = PHPExcel_Cell::stringFromColumnIndex(($key+1));
	
		$rankingHistoryObj = RankingHistoryPeer::retrieveByPK($rankingObj->getId(), $rankingPlayerObj->getPeopleId(), Util::formatDate($eventDate));
	
		if( is_object($rankingHistoryObj) )
			$totalRankingScore = $rankingHistoryObj->getTotalScore();
//		else
//			$totalRankingScore = ' - ';
	
		$phpExcelObj->setActiveSheetIndex(0)
					->setCellValue($colName.$currentLine, Util::formatFloat($totalRankingScore, false, 3));
		
		$phpExcelObj->setActiveSheetIndex(0)->getStyle($colName.$currentLine)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
//		if( $totalRankingScore == ' - ' )
//			$phpExcelObj->setActiveSheetIndex(0)->getStyle($colName.$currentLine)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	}
	
	$currentLine++;
}

for($line=7; $line <= 7+$players-1; $line++)
	$phpExcelObj->setActiveSheetIndex(0)->getStyle('A'.$line.':'.$colName.$line)->getFill()->applyFromArray(
	    array(
	        'type'       => PHPExcel_Style_Fill::FILL_SOLID,
	        'startcolor' => array('rgb' => ($line%2==0?'D0D0D0':'FFFFFF'))
    	)
	);

$phpExcelObj->setActiveSheetIndex(0)
			->setCellValue('C2', $rankingObj->getRankingName())
			->setCellValue('C3', $rankingObj->getPlayers())
			->setCellValue('C4', $rankingObj->getEvents())
			->setCellValue('E4', $rankingObj->getRankingType()->getDescription())
			;


Util::headerExcel(__('statistic.fileName.rankingLog').'.xls');
$objWriter = PHPExcel_IOFactory::createWriter($phpExcelObj, 'Excel5');
$objWriter->save( $outputFilePath );

$fileContent = file_get_contents( $outputFilePath );
print_r($fileContent);
unlink($outputFilePath);
exit;
?>