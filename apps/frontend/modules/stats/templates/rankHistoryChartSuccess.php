<?php
$libDir = sfConfig::get('sf_lib_dir');

$rankingObj = RankingPeer::retrieveByPK($rankingId);
$rankingMemberObjList = $rankingObj->getMemberList();

$players = count($rankingMemberObjList);

$eventDateList = array();

$criteria = new Criteria();
$criteria->add( EventPeer::SAVED_RESULT, true );
$eventObjList = $rankingObj->getEventList($criteria);
foreach($eventObjList as $eventObj)
	$eventDateList[] = $eventObj->getEventDate('d/m/Y');

$serieNameList = array();
$serieDateList = array();
foreach($rankingMemberObjList as $rankingMemberObj){
	
	$peopleId                 = $rankingMemberObj->getPeopleId();
	$serieNameList[$peopleId] = $rankingMemberObj->getPeople()->getName();
	
	foreach($eventDateList as $eventDate)
		$serieDataList[$peopleId][$eventDate] = rand(1,15);
}

// Dataset definition
$DataSet = new pData;

foreach($serieDataList as $peopleId=>$serieData){
	
	$DataSet->AddPoint($serieData,'Serie'.$peopleId);
	$DataSet->AddSerie('Serie'.$peopleId);
}

$DataSet->AddPoint($eventDateList,'eventDateList');
$DataSet->SetAbsciseLabelSerie('eventDateList');

foreach($serieNameList as $key=>$serieName)
	$DataSet->SetSerieName($serieName,'Serie'.$key);

$DataSet->SetYAxisName('Classificação');
$DataSet->SetYAxisFormat('int');

$width=1150;
$height=350;

//	echo '<pre>';print_r($DataSet->getData());exit;

// Initialise the graph   
$Test = new pChart($width,$height+60);
$Test->setFixedScale($players, 1, $players-1);
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
  
// Draw the line graph
$Test->drawLineGraph($DataSet->GetData(),$DataSet->GetDataDescription());
$Test->drawPlotGraph($DataSet->GetData(),$DataSet->GetDataDescription(),3,2,255,255,255);
 
// Finish the graph
$Test->setFontProperties($libDir.'/pChart/Fonts/tahoma.ttf',8);
$Test->drawLegend($width-135,35,$DataSet->GetDataDescription(),255,255,255);
$Test->setFontProperties($libDir.'/pChart/Fonts/tahoma.ttf',10);
$Test->drawTitle(60,22,'Histórico de classificação',50,50,50,585);
$Test->Stroke();
   	
exit;
?>