<?php
Util::getHelper('I18N');

$libDir = sfConfig::get('sf_lib_dir');

$criteria = new Criteria();
$criteria->add( RankingPlayerPeer::TOTAL_EVENTS, 0, Criteria::GREATER_THAN );

$rankingObj = RankingPeer::retrieveByPK($rankingId);
$rankingPlayerObjList = $rankingObj->getClassify(null, $criteria);
$playerNameList = array();
$totalPaidList = array();
$totalPrizeList = array();
$balanceList = array();
foreach($rankingPlayerObjList as $rankingPlayerObj){
	
	$totalPaidList[]      = $rankingPlayerObj->getTotalPaid();
	$totalPrizeList[]     = $rankingPlayerObj->getTotalPrize();
	$balanceList[]        = $rankingPlayerObj->getTotalBalance();
	$playerNameList[]     = $rankingPlayerObj->getPeople()->getFirstName();
}

$allValues = array_merge($totalPaidList, $totalPrizeList, $balanceList);

$minValue  = min($allValues);
$maxValue  = max($allValues);
//$minValue  = round($minValue+($minValue/10));
//$maxValue  = ceil($maxValue+($maxValue/10));

// Dataset definition 
$DataSet = new pData;
$DataSet->AddPoint($totalPaidList,'totalPaid');
$DataSet->AddPoint($totalPrizeList,'totalPrize');
$DataSet->AddPoint($balanceList,'balance');
$DataSet->AddPoint(array($playerNameList),'playerName');
$DataSet->AddAllSeries();
$DataSet->RemoveSerie('playerName');
$DataSet->SetAbsciseLabelSerie('playerName');
$DataSet->SetSerieName('B+R+A','totalPaid');
$DataSet->SetSerieName(__('statistic.chart.profit'),'totalPrize');
$DataSet->SetSerieName(__('statistic.chart.balance'),'balance');
$width  = 1100;
$height = 500;
// Initialise the graph
$Test = new pChart($width,$height);
$Test->loadColorPalette($libDir.'/pChart/sample/softtones.txt');
$Test->setFixedScale($minValue, $maxValue, 20);
$Test->setFontProperties($libDir.'/pChart/Fonts/tahoma.ttf',8);
$Test->setGraphArea(65,45,$width-88,$height-80);
$Test->drawFilledRoundedRectangle(7,7,$width-7,$height-7,5,240,240,240);
$Test->drawRoundedRectangle(5,5,$width-5,$height-5,5,230,230,230);
$Test->drawGraphArea(255,255,255,TRUE);
$Test->drawScale($DataSet->GetData(),$DataSet->GetDataDescription(),SCALE_NORMAL,50,50,50,TRUE,35,2,TRUE);
$Test->drawGrid(4,TRUE,230,230,230,50);

// Draw the 0 line
$Test->setFontProperties($libDir.'/pChart/Fonts/tahoma.ttf',6);
$Test->drawTreshold(0,143,55,72,TRUE,TRUE);

// Draw the bar graph
$Test->drawBarGraph($DataSet->GetData(),$DataSet->GetDataDescription(), false, 80);
//$Test->drawOverlayBarGraph($DataSet->GetData(),$DataSet->GetDataDescription(), 80);

header('Content-Type: image/jpeg');
header('Content-Disposition: attachment; filename='.__('statistic.fileName.playersBalance').'.png');
header('Expires: 0');
header('Pragma: no-cache');

// Finish the graph
$Test->setFontProperties($libDir.'/pChart/Fonts/tahoma.ttf',8);
$Test->drawLegend($width-82,30,$DataSet->GetDataDescription(),255,255,255);
$Test->setFontProperties($libDir.'/pChart/Fonts/tahomabd.ttf',11);
$Test->drawTitle(100,30,__('statistic.chart.title.playersBalance').' - '.$rankingObj->getRankingName(),50,50,50);
$Test->setFontProperties($libDir.'/pChart/Fonts/tahoma.ttf',8);
$Test->drawCredits();
$Test->Stroke();
   	
exit;
?>