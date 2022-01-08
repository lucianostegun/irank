<?php
Util::getHelper('I18N');

$libDir = sfConfig::get('sf_lib_dir');

$peopleId = $sf_user->getAttribute('peopleId');
$resultSet = Util::executeQuery('SELECT ranking_date FROM ranking_history WHERE people_id = '.$peopleId.' ORDER BY ranking_date');
$rankingDateList = array();

while($resultSet->next())
	$rankingDateList[] = date('Y-m', strtotime($resultSet->getTimestamp(1)));

$rankingDateList = array_unique($rankingDateList);
$rankingDateList = array_values($rankingDateList);

$rankingId = 1;

$rankingObj = RankingPeer::retrieveByPK($rankingId);
$peopleObj  = PeoplePeer::retrieveByPK($peopleId);

$libDir = sfConfig::get('sf_lib_dir');

$totalPaidList    = array();
$totalPrizeList   = array();
$totalBalanceList = array();
$paidValueList    = array();
$prizeValueList   = array();
$balanceValueList = array();

foreach($rankingDateList as $key=>$rankingDate){

	$rankingDate        = Util::formatDate($rankingDate);
	$totalEventList[]   = rand(0,13);
	$totalPrizeList[]   = rand(0,800);
}

$allValues = array_merge($totalEventList, $totalPrizeList);
$minValue  = min($allValues);
$maxValue  = max($allValues);
// Dataset definition
$DataSet = new pData;

$DataSet->AddPoint($totalEventList,'totalEvent');
$DataSet->AddPoint($totalPrizeList,'totalPrize');

$DataSet->SetSerieName('Eventos','totalEvent');
$DataSet->SetSerieName('Ganhos','totalPrize');

$DataSet->AddPoint($rankingDateList,'rankingDateList');
$DataSet->SetAbsciseLabelSerie('rankingDateList');

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
$DataSet->AddSerie('totalEvent');
$DataSet->AddSerie('totalPrize');
  
// Draw the line graph
$Test->drawLineGraph($DataSet->GetData(),$DataSet->GetDataDescription());
$Test->drawPlotGraph($DataSet->GetData(),$DataSet->GetDataDescription(),3,2,255,255,255);

$Test->setLineStyle(1.5);
$DataSet->AddSerie('totalEvent');
$DataSet->AddSerie('totalPrize');

// Draw the line graph
$Test->drawLineGraph($DataSet->GetData(),$DataSet->GetDataDescription());
$Test->drawPlotGraph($DataSet->GetData(),$DataSet->GetDataDescription(),3,2,255,255,255);

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