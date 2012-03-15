<?php
Util::getHelper('I18N');

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

$culture        = MyTools::getCulture();
$inputFilePath  = Util::getFilePath('/templates/'.$culture.'/myBalance.xls');
$outputFilePath = Util::getFilePath('/temp/myBalance-'.microtime().'.xls');

$phpExcelObj = PHPExcel_IOFactory::load($inputFilePath);

$eventDateList = $rankingObj->getEventDateList();
$events        = count($eventDateList);

$phpExcelObj->setActiveSheetIndex(0)->insertNewRowBefore(8, $events-2);

for($line=7; $line <= 7+$events-1; $line++)
	$phpExcelObj->setActiveSheetIndex(0)->getStyle('A'.$line.':G'.$line)->getFill()->applyFromArray(
	    array(
	        'type'       => PHPExcel_Style_Fill::FILL_SOLID,
	        'startcolor' => array('rgb' => ($line%2==0?'D0D0D0':'FFFFFF'))
    	)
	);

$phpExcelObj->setActiveSheetIndex(0)
			->setCellValue('E2', $rankingObj->getRankingName())
			->setCellValue('E3', $rankingObj->getPlayers())
			->setCellValue('E4', $rankingObj->getEvents())
			->setCellValue('G4', $rankingObj->getRankingType()->getDescription())
			;
						
$currentLine = 7;
foreach($eventDateList as $key=>$eventDate){

	$rankingHistoryObj = RankingHistoryPeer::retrieveByPK($rankingObj->getId(), $peopleId, Util::formatDate($eventDate));	

	$phpExcelObj->setActiveSheetIndex(0)
				->setCellValue('A'.$currentLine, $eventDate)
				->setCellValue('B'.$currentLine, $rankingHistoryObj->getTotalPaid())
				->setCellValue('C'.$currentLine, $rankingHistoryObj->getTotalPrize())
				->setCellValue('D'.$currentLine, $rankingHistoryObj->getTotalBalance())
				->setCellValue('E'.$currentLine, $rankingHistoryObj->getPaidValue())
				->setCellValue('F'.$currentLine, $rankingHistoryObj->getPrizeValue())
				->setCellValue('G'.$currentLine, $rankingHistoryObj->getBalanceValue())
				;

	$currentLine++;
}

Util::headerExcel(__('statistic.fileName.myBalance').'.xls');
$objWriter = PHPExcel_IOFactory::createWriter($phpExcelObj, 'Excel5');
$objWriter->save( $outputFilePath );

$fileContent = file_get_contents( $outputFilePath );
print_r($fileContent);
unlink($outputFilePath);
exit;
?>