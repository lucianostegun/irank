<?php
Util::getHelper('I18N');

$rankingObj = RankingPeer::retrieveByPK($rankingId);
$peopleObj  = PeoplePeer::retrieveByPK($peopleId);

$libDir = sfConfig::get('sf_lib_dir');

$eventDateList = $rankingObj->getEventDateList();

$eventDateList    = array_unique($eventDateList);
$totalPaidList    = array();
$totalPrizeList   = array();
$totalBalanceList = array();
$paidValueList    = array();
$prizeValueList   = array();
$balanceValueList = array();

foreach($eventDateList as $key=>$eventDate){

	$eventDate          = Util::formatDate($eventDate);
	$rankingHistoryObj  = RankingHistoryPeer::retrieveByPK($rankingObj->getId(), $peopleId, $eventDate);	
	$totalPaidList[]    = $rankingHistoryObj->getTotalPaid();
	$totalPrizeList[]   = $rankingHistoryObj->getTotalPrize();
	$totalBalanceList[] = $rankingHistoryObj->getTotalBalance();
	$paidValueList[]    = $rankingHistoryObj->getPaidValue();
	$prizeValueList[]   = $rankingHistoryObj->getPrizeValue();
	$balanceValueList[] = $rankingHistoryObj->getBalanceValue();
}

$allValues = array_merge($totalPaidList, $totalPrizeList, $totalBalanceList, $paidValueList, $prizeValueList, $balanceValueList);
$minValue  = min($allValues);
$maxValue  = max($allValues);
// Dataset definition
$DataSet = new pData;

$DataSet->AddPoint($paidValueList,'paidValue');
$DataSet->AddPoint($prizeValueList,'prizeValue');
$DataSet->AddPoint($balanceValueList,'balanceValue');
$DataSet->AddPoint($totalPaidList,'totalPaid');
$DataSet->AddPoint($totalPrizeList,'totalPrize');
$DataSet->AddPoint($totalBalanceList,'totalBalance');

$DataSet->SetSerieName('B+R+A','paidValue');
$DataSet->SetSerieName(__('statistic.chart.profit'),'prizeValue');
$DataSet->SetSerieName(__('statistic.chart.balance'),'balanceValue');
$DataSet->SetSerieName(__('statistic.chart.totalBRA'),'totalPaid');
$DataSet->SetSerieName(__('statistic.chart.totalProfit'),'totalPrize');
$DataSet->SetSerieName(__('statistic.chart.totalBalance'),'totalBalance');

$DataSet->AddPoint($eventDateList,'eventDateList');
$DataSet->SetAbsciseLabelSerie('eventDateList');

$DataSet->SetYAxisName(__('statistic.chart.values'));
$DataSet->SetYAxisFormat('int');

$width=1150;
$height=350;

//	echo '<pre>';print_r($DataSet->getData());exit;

// Initialise the graph   
$Test = new pChart($width,$height+60);
$Test->loadColorPalette($libDir.'/pChart/sample/softtones.txt');
$Test->setFixedScale($minValue, $maxValue, 15);
$Test->setFontProperties($libDir.'/pChart/Fonts/tahoma.ttf',8);
$Test->setGraphArea(85,45,$width-150,$height-20);
$Test->drawFilledRoundedRectangle(7,7,$width-7,$height+50,5,240,240,240);
$Test->drawRoundedRectangle(5,5,$width-5,$height+52,5,230,230,230);
$Test->drawGraphArea(255,255,255,TRUE);
$Test->drawScale($DataSet->getData(),$DataSet->GetDataDescription(),SCALE_NORMAL,150,150,150,TRUE,65,2);
$Test->drawGrid(4,TRUE,230,230,230,50);
// echo '<pre>';print_r($DataSet->GetDataDescription());exit;
// Draw the 0 line   
$Test->setFontProperties($libDir.'/pChart/Fonts/tahoma.ttf',6);
$Test->drawTreshold(0,143,55,72,TRUE,TRUE);
  
$Test->setLineStyle(1);
$DataSet->AddSerie('paidValue');
$DataSet->AddSerie('prizeValue');
$DataSet->AddSerie('balanceValue');
  
// Draw the line graph
$Test->drawLineGraph($DataSet->GetData(),$DataSet->GetDataDescription());
$Test->drawPlotGraph($DataSet->GetData(),$DataSet->GetDataDescription(),3,2,255,255,255);

$Test->setLineStyle(1.5);
$DataSet->AddSerie('totalPaid');
$DataSet->AddSerie('totalPrize');
$DataSet->AddSerie('totalBalance');

$DataSet->RemoveSerie('paidValue');
$DataSet->RemoveSerie('prizeValue');
$DataSet->RemoveSerie('balanceValue');
  
// Draw the line graph
$Test->drawLineGraph($DataSet->GetData(),$DataSet->GetDataDescription());
$Test->drawPlotGraph($DataSet->GetData(),$DataSet->GetDataDescription(),3,2,255,255,255);

header('Content-Type: image/jpeg');
header('Content-Disposition: attachment; filename='.__('statistic.fileName.myBalance').'.png');
header('Expires: 0');
header('Pragma: no-cache');

// Finish the graph
$Test->setFontProperties($libDir.'/pChart/Fonts/tahoma.ttf',8);
$Test->drawLegend($width-135,35,$DataSet->GetDataDescription(),255,255,255);
$Test->setFontProperties($libDir.'/pChart/Fonts/tahoma.ttf',11);
$Test->drawTitle(100,30,__('statistic.chart.title.myBalance').' - '.$rankingObj->getRankingName(),50,50,50);
$Test->setFontProperties($libDir.'/pChart/Fonts/tahoma.ttf',8);
$Test->drawCredits($width, $height);
$Test->Stroke();
   	
exit;
?>