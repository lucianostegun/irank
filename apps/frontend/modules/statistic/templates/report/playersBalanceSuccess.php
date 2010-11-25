<?php

$rankingObj = RankingPeer::retrieveByPK($rankingId);

$rankingPlayerObjList = $rankingObj->getClassify();
$players = $rankingObj->getPlayers();

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
			->setCellValue('D3', $rankingObj->getPlayers())
			->setCellValue('D4', $rankingObj->getEvents())
			->setCellValue('F4', $rankingObj->getRankingType()->getDescription());
						
$currentLine = 7;
$position    = 1;
foreach($rankingPlayerObjList as $rankingPlayerObj):
	
	$phpExcelObj->setActiveSheetIndex(0)
				->setCellValue('A'.$currentLine, $position++)
				->setCellValue('B'.$currentLine, $rankingPlayerObj->getPeople()->getName())
				->setCellValue('C'.$currentLine, $rankingPlayerObj->getTotalPaid())
				->setCellValue('D'.$currentLine, $rankingPlayerObj->getTotalPrize())
				->setCellValue('E'.$currentLine, $rankingPlayerObj->getBalance())
				->setCellValue('F'.$currentLine, '=D'.$currentLine.'/C'.$currentLine)
				->setCellValue('G'.$currentLine, $rankingPlayerObj->getEvents());
				
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