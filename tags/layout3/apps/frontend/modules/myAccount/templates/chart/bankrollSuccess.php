<?php
$libDir = sfConfig::get('sf_lib_dir');

$monthList = array('jan', 'fev', 'mar', 'abr', 'mai', 'jun', 'jul', 'ago', 'set', 'out', 'nov', 'dez');

$peopleId = $sf_user->getAttribute('peopleId');
$peopleId = $sf_request->getParameter('peopleId', $peopleId);

$userSiteId = $sf_user->getAttribute('userSiteId');
$userSiteId = $sf_request->getParameter('userSiteId', $userSiteId);

$sql = "SELECT
			*
		FROM 
			bankroll 
		WHERE 
			(user_site_id = $userSiteId OR people_id = $peopleId)
		ORDER BY
			event_date";
			
$resultSet = Util::executeQuery($sql);
$bankrollByMonth = array();
$bankrollSum     = array();
$lastMonth       = null;
$balanceSum      = 0;

$emptyArray = array('1'=>0, '2'=>0, '3'=>0, '4'=>0, '5'=>0, '6'=>0, '7'=>0, '8'=>0, '9'=>0, '10'=>0, '11'=>0, '12'=>0);

while($resultSet->next()){
		
	$eventId       = $resultSet->getInt(1);
    $eventDate     = $resultSet->getTimestamp(2);
    $eventName     = $resultSet->getString(3);
    $eventPosition = $resultSet->getInt(4);
    $players       = $resultSet->getInt(5);
    $buyin         = $resultSet->getFloat(6);
    $entranceFee   = $resultSet->getFloat(7);
    $rebuy         = $resultSet->getFloat(8);
    $addon         = $resultSet->getFloat(9);
    $prize         = $resultSet->getFloat(10);
    
    $year  = date('Y', strtotime($eventDate));
    $month = date('m', strtotime($eventDate))*1;
    
    $balance = $prize-$buyin-$rebuy-$addon-$entranceFee;
    
    if( !isset($bankrollByMonth[$year]) )
    	$bankrollByMonth[$year] = array('1'=>0, '2'=>0, '3'=>0, '4'=>0, '5'=>0, '6'=>0, '7'=>0, '8'=>0, '9'=>0, '10'=>0, '11'=>0, '12'=>0);
    
    if( !isset($bankrollSum[$year]) )
    	$bankrollSum[$year] = array();

    if( !isset($bankrollSum[$year][$month]) )
    	$bankrollSum[$year][$month] = $balanceSum;

    $bankrollByMonth[$year][$month] += $balance;
    $bankrollSum[$year][$month] += $balance;
    
    $balanceSum += $balance;
}

$year = $sf_request->getParameter('year');
$year = preg_replace('/[^0-9]/', '', $year);

$bankrollByMonth = $bankrollByMonth[$year];
$bankrollByMonth = array_values($bankrollByMonth);
$bankrollSum = $bankrollSum[$year];
//$bankrollSum = array_values($bankrollSum);

//$bankrollSum

foreach($emptyArray as $key=>$value){
	
	if( !isset($bankrollSum[$key]) )
		$bankrollSum[$key] = null;
}

ksort($bankrollSum);


//
// Dataset definition
$DataSet = new pData;

foreach($bankrollByMonth as &$value)
	if( $value===0 )
		$value = null;

$DataSet->AddPoint($bankrollByMonth, 'bankrollByMonth');
$DataSet->AddPoint($bankrollSum, 'bankrollSum');

$DataSet->AddPoint($monthList,'monthList');
$DataSet->SetAbsciseLabelSerie('monthList');

$DataSet->SetSerieName('Mensal','bankrollByMonth');
$DataSet->SetSerieName('Acumulado','bankrollSum');

$DataSet->SetYAxisFormat('float');

$width  = 750;
$height = 200;

$allPositions = array_merge($bankrollByMonth, $bankrollSum);
foreach($allPositions as $key=>$allPosition)
	if( is_null($allPosition) )
		unset($allPositions[$key]);
		
$min = min($allPositions);
$max = max($allPositions);

//$min = ($min<=1?0:$min);

// Initialise the graph   
$Test = new pChart($width,$height+60);
$Test->setFixedScale($min, $max, 12);
$Test->setFontProperties($libDir.'/pChart/Fonts/tahoma.ttf',8);
$Test->setGraphArea(55,15,$width-10,$height+20);
$Test->drawFilledRectangle(0,0,$width,$height+60,240,240,240);
//$Test->drawRectangle(1,1,$width-1,$height+52,230,230,230);
$Test->drawGraphArea(255,255,255,TRUE);
$Test->drawScale($DataSet->getData(),$DataSet->GetDataDescription(),SCALE_NORMAL,150,150,150,TRUE,65,2);
$Test->drawGrid(4,TRUE,230,230,230,50);
// echo '<pre>';print_r($DataSet->GetDataDescription());exit;
// Draw the 0 line   
$Test->setFontProperties($libDir.'/pChart/Fonts/tahoma.ttf',6);
$Test->drawTreshold(0,143,55,72,TRUE,TRUE);


$Test->setLineStyle(1);
$DataSet->AddSerie('bankrollByMonth');
// Draw the line graph
$Test->drawLineGraph($DataSet->GetData(),$DataSet->GetDataDescription());
$Test->drawPlotGraph($DataSet->GetData(),$DataSet->GetDataDescription(),3,2,255,255,255);


////$Test->setLineStyle(1);
$DataSet->AddSerie('bankrollSum');
$DataSet->RemoveSerie('bankrollByMonth');

$Test->drawLineGraph($DataSet->GetData(),$DataSet->GetDataDescription());
$Test->drawPlotGraph($DataSet->GetData(),$DataSet->GetDataDescription(),3,2,255,255,255);

header('Content-Type: image/png');
header('Content-Disposition: attachment; filename=bankroll_'.$year.'.png');
header('Expires: 0');
header('Pragma: no-cache');

// Finish the graph
$Test->setFontProperties($libDir.'/pChart/Fonts/tahoma.ttf',8);
$Test->drawLegend($width-120, 35, $DataSet->GetDataDescription(), 255, 255, 255);
$Test->setFontProperties($libDir.'/pChart/Fonts/tahomabd.ttf',11);
$Test->setFontProperties($libDir.'/pChart/Fonts/tahoma.ttf',8);
$Test->drawCredits(75);
$Test->Stroke();
   	
exit;
?>