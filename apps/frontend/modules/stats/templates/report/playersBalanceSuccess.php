<?php

$rankingObj = RankingPeer::retrieveByPK($rankingId);

$rankingMemberObjList = $rankingObj->getClassify();
$players = $rankingObj->getMembers();

$inputFilePath  = Util::getFilePath('/templates/playersBalance.xls');
$outputFilePath = Util::getFilePath('/temp/playersBalance-'.microtime().'.xls');

$phpExcelObj = PHPExcel_IOFactory::load($inputFilePath);

$phpExcelObj->setActiveSheetIndex(0)->insertNewRowBefore(8, $players-2);

for($line=7; $line <= 7+$players-1; $line++)
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
			->setCellValue('F4', $rankingObj->getRankingType()->getDescription());
						
$currentLine = 7;
$position    = 1;
foreach($rankingMemberObjList as $rankingMemberObj):
	
	$phpExcelObj->setActiveSheetIndex(0)
				->setCellValue('A'.$currentLine, $position++)
				->setCellValue('B'.$currentLine, $rankingMemberObj->getPeople()->getName())
				->setCellValue('C'.$currentLine, $rankingMemberObj->getTotalPaid())
				->setCellValue('D'.$currentLine, $rankingMemberObj->getTotalPrize())
				->setCellValue('E'.$currentLine, $rankingMemberObj->getBalance())
				->setCellValue('F'.$currentLine, '=D'.$currentLine.'/C'.$currentLine)
				->setCellValue('G'.$currentLine, $rankingMemberObj->getEvents());
				
	$currentLine++;
endforeach;

Util::headerExcel('balanco_jogadores.xls');
$objWriter = PHPExcel_IOFactory::createWriter($phpExcelObj, 'Excel5');
$objWriter->save( $outputFilePath );

$fileContent = file_get_contents( $outputFilePath );
print_r($fileContent);
unlink($outputFilePath);
exit;
?>