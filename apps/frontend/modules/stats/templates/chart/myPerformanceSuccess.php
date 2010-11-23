<?php
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

$libDir = sfConfig::get('sf_lib_dir');


$players = $rankingObj->getPlayers();

$eventDateList = $rankingObj->getEventDateList();


$eventDateList       = array_unique($eventDateList);
$myPositionByDayList = array();
$myPositionProgressList = array();
$otherPlaceByDayList    = array();
$otherPlaceProgressList = array();

foreach($eventDateList as $key=>$eventDate){

	$eventDate             = Util::formatDate($eventDate);
	$rankingHistoryObj     = RankingHistoryPeer::retrieveByPK($rankingObj->getId(), $peopleId, $eventDate);	
	
	$position      = $rankingHistoryObj->getRankingPosition();
	$totalPosition = $rankingHistoryObj->getTotalRankingPosition();
	$myPositionByDayList[] = ($position?$position:null);
	$myPositionProgressList[] = ($totalPosition?$totalPosition:null);
	
	$rankingHistoryObj = RankingHistoryPeer::retrieveByPK($rankingObj->getId(), $peopleIdOther, $eventDate);
	$position          = $rankingHistoryObj->getRankingPosition();
	$totalPosition     = $rankingHistoryObj->getTotalRankingPosition();
	$otherPlaceByDayList[] = ($position?$position:null);
	$otherPlaceProgressList[] = ($totalPosition?$totalPosition:null);
}

//
// Dataset definition
$DataSet = new pData;

$DataSet->AddPoint($myPositionByDayList,'myPositionByDay');
$DataSet->AddPoint($otherPlaceByDayList,'otherPlaceByDay');
$DataSet->AddPoint($myPositionProgressList,'myPositionProgress');
$DataSet->AddPoint($otherPlaceProgressList,'otherPlaceProgress');

$DataSet->AddPoint($eventDateList,'eventDateList');
$DataSet->SetAbsciseLabelSerie('eventDateList');

$peopleName = $peopleObj->getFirstName();
$DataSet->SetSerieName($peopleName.' (por data)','myPositionByDay');
$DataSet->SetSerieName($peopleName.' (progressivo)','myPositionProgress');
$DataSet->SetSerieName($otherPlace.'º colocado (por data)','otherPlaceByDay');
$DataSet->SetSerieName($otherPlace.'º colocado (progressivo)','otherPlaceProgress');

$DataSet->SetYAxisName('Classificação');
$DataSet->SetYAxisFormat('int');

$width=1150;
$height=350;


// Initialise the graph   
$Test = new pChart($width,$height+60);
$Test->setFixedScale($players, 0, $players);
$Test->setFontProperties($libDir.'/pChart/Fonts/tahoma.ttf',8);
$Test->setGraphArea(85,45,$width-170,$height-20);
$Test->drawFilledRoundedRectangle(7,7,$width-7,$height+50,5,240,240,240);
$Test->drawRoundedRectangle(5,5,$width-5,$height+52,5,230,230,230);
$Test->drawGraphArea(255,255,255,TRUE);
$Test->drawScale($DataSet->getData(),$DataSet->GetDataDescription(),SCALE_NORMAL,150,150,150,TRUE,65,2);
$Test->drawGrid(4,TRUE,230,230,230,50);
// echo '<pre>';print_r($DataSet->GetDataDescription());exit;
// Draw the 0 line   
$Test->setFontProperties($libDir.'/pChart/Fonts/tahoma.ttf',6);
$Test->drawTreshold(0,143,55,72,TRUE,TRUE);


$Test->setLineStyle(1.5);
$DataSet->AddSerie('myPositionByDay');
$DataSet->AddSerie('myPositionProgress');
// Draw the line graph
$Test->drawLineGraph($DataSet->GetData(),$DataSet->GetDataDescription());
$Test->drawPlotGraph($DataSet->GetData(),$DataSet->GetDataDescription(),3,2,255,255,255);



$Test->setLineStyle(1);
$DataSet->AddSerie('otherPlaceByDay');
$DataSet->AddSerie('otherPlaceProgress');
$DataSet->RemoveSerie('myPositionByDay');
$DataSet->RemoveSerie('myPositionProgress');

$Test->drawLineGraph($DataSet->GetData(),$DataSet->GetDataDescription());
$Test->drawPlotGraph($DataSet->GetData(),$DataSet->GetDataDescription(),3,2,255,255,255);

header('Content-Type: image/jpeg');
header('Content-Disposition: attachment; filename=meu_desempenho.png');
header('Expires: 0');
header('Pragma: no-cache');

// Finish the graph
$Test->setFontProperties($libDir.'/pChart/Fonts/tahoma.ttf',8);
$Test->drawLegend($width-160,35,$DataSet->GetDataDescription(),255,255,255);
$Test->setFontProperties($libDir.'/pChart/Fonts/tahoma.ttf',11);
$Test->drawTitle(100,30,'Histórico de classificação - '.$rankingObj->getRankingName(),50,50,50);
$Test->setFontProperties($libDir.'/pChart/Fonts/tahoma.ttf',8);
$Test->drawCredits($width, $height);
$Test->Stroke();
   	
exit;
?>