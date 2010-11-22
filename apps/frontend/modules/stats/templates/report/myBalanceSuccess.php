<?php
$rankingObj = RankingPeer::retrieveByPK($rankingId);
$peopleObj  = PeoplePeer::retrieveByPK($peopleId);

$peopleIdOther = $rankingObj->getByPlace(1)->getPeopleId();
$otherPlace    = '1';

if( $peopleIdOther==$peopleId ){
	
	$peopleIdOther = $rankingObj->getByPlace(2)->getPeopleId();
	$otherPlace    = '2';
}

$inputFilePath  = Util::getFilePath('/templates/myBalance.xls');
$outputFilePath = Util::getFilePath('/temp/myBalance-'.microtime().'.xls');

$phpExcelObj = PHPExcel_IOFactory::load($inputFilePath);

$eventDateList = $rankingObj->getEventDateList();
$events        = count($eventDateList);

$phpExcelObj->setActiveSheetIndex(0)->insertNewRowBefore(8, $events-2);

for($line=7; $line <= 7+$events-1; $line++)
	$phpExcelObj->setActiveSheetIndex(0)->getStyle('A'.$line.':G'.$line)->getFill()->applyFromArray(
	    array(
	        'type'       => PHPExcel_Style_Fill::FILL_SOLID,
	        'startcolor' => array('rgb' => ($line%2==0?'A6A6A6':'D0D0D0'))
    	)
	);

$phpExcelObj->setActiveSheetIndex(0)
			->setCellValue('D2', $rankingObj->getRankingName())
			->setCellValue('D3', $rankingObj->getMembers())
			->setCellValue('D4', $rankingObj->getEvents())
			->setCellValue('F4', $rankingObj->getRankingType()->getDescription())
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

Util::headerExcel('meu_balanco.xls');
$objWriter = PHPExcel_IOFactory::createWriter($phpExcelObj, 'Excel5');
$objWriter->save( $outputFilePath );

$fileContent = file_get_contents( $outputFilePath );
print_r($fileContent);
unlink($outputFilePath);
exit;
?>