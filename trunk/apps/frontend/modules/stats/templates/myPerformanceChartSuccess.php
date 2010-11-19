<?php
$rankingObj = RankingPeer::retrieveByPK($rankingId);
$peopleObj  = PeoplePeer::retrieveByPK(peopleId);


$libDir = sfConfig::get('sf_lib_dir');


$players = $rankingObj->getMembers();


$criteria = new Criteria();
$criteria->add( EventPeer::SAVED_RESULT, true );
$criteria->addAscendingOrderByColumn( EventPeer::EVENT_DATE );
$criteria->addAscendingOrderByColumn( EventPeer::START_TIME );
$eventObjList  = $rankingObj->getEventList($criteria);
$eventDateList = array();
foreach($eventObjList as $eventObj){
	
	$eventDate       = $eventObj->getEventDate('d/m/Y');
	$eventDateList[] = $eventDate;
}

$eventDateList       = array_unique($eventDateList);
$rankingPositionList = array();

foreach($eventDateList as $key=>$eventDate){

	$eventDate             = Util::formatDate($eventDate);
	$rankingHistoryObj     = RankingHistoryPeer::retrieveByPK($rankingObj->getId(), $peopleId, $eventDate);	
	$rankingPositionList[] = $rankingHistoryObj->getRankingPosition();
}

// Dataset definition
$DataSet = new pData;

$DataSet->AddPoint($rankingPositionList,'Ranking');
$DataSet->AddAllSeries();

$DataSet->AddPoint($eventDateList,'eventDateList');
$DataSet->SetAbsciseLabelSerie('eventDateList');

$DataSet->SetYAxisName('Classificação');
$DataSet->SetYAxisFormat('int');

$width=1150;
$height=350;


// Initialise the graph   
$Test = new pChart($width,$height+60);
$Test->setFixedScale($players, 0, $players);
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

header('Content-Type: image/jpeg');
header('Content-Disposition: attachment; filename=meu_desempenho.png');
header('Expires: 0');
header('Pragma: no-cache');

// Finish the graph
$Test->setFontProperties($libDir.'/pChart/Fonts/tahoma.ttf',8);
//$Test->drawLegend($width-135,35,$DataSet->GetDataDescription(),255,255,255);
$Test->setFontProperties($libDir.'/pChart/Fonts/tahoma.ttf',10);
$Test->drawTitle(60,30,'Histórico de classificação',50,50,50,255);
$Test->Stroke();
   	
exit;
?>