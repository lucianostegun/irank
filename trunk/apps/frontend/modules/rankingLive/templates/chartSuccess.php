<?php
/**
 * Na linha 208 da classe pChart.class.php tem uma declaração de que todas as cores 255, 255, 255 serão consideradas transparentes
 */

// Dataset definition    
$DataSet = new pData;   
$DataSet->AddPoint($rankingPositionList,'Serie1');
$DataSet->AddPoint($totalRankingPositionList,'Serie2');
//$DataSet->AddPoint($rankingDateList,'rankingDateList');

$DataSet->AddPoint($rankingDateList,'rankingDateList');
$DataSet->SetAbsciseLabelSerie('rankingDateList');

//$DataSet->SetAbsciseLabelSerie('rankingDateList');   
$DataSet->SetSerieName('Posição por etapa','Serie1');
$DataSet->SetSerieName('Classificacao','Serie2');
//$DataSet->SetYAxisName(__('statistic.chart.rating'));
//$DataSet->SetYAxisFormat('int');   
$DataSet->SetYAxisUnit("º");
 
$libDir = sfConfig::get('sf_lib_dir');

$width=780;
$height=350;

$players = max(array_merge($totalRankingPositionList, $rankingPositionList));

// Initialise the graph   
$Test = new pChart($width,$height+60, true);
//$Test->loadColorPalette($libDir.'/pChart/tones/rankingLive/performance.txt');
$Test->setFixedScale($players+1, 1, $players);
$Test->setFontProperties($libDir.'/pChart/Fonts/tahoma.ttf',8);
$Test->setGraphArea(55,55,$width-45,$height-20);
$Test->drawFilledRoundedRectangle(7,7,$width-7,$height+50,5,240,240,240);
$Test->drawRoundedRectangle(5,5,$width-5,$height+52,5,30,30,30);
$Test->drawGraphArea(255,255,255,TRUE);
$Test->drawScale($DataSet->getData(),$DataSet->GetDataDescription(),SCALE_NORMAL,50,50,50,TRUE,45,2);
$Test->drawGrid(4,TRUE,230,230,230,50);
// echo '<pre>';print_r($DataSet->GetDataDescription());exit;
// Draw the 0 line   
$Test->setFontProperties($libDir.'/pChart/Fonts/tahoma.ttf',6);
//$Test->drawTreshold(0,143,55,72,TRUE,TRUE);  

$Test->setLineStyle(1);
$DataSet->AddSerie('Serie1');
// Draw the line graph
$Test->drawLineGraph($DataSet->GetData(),$DataSet->GetDataDescription());   
$Test->drawPlotGraph($DataSet->GetData(),$DataSet->GetDataDescription(),3,2,255,255,255);   
$DataSet->RemoveSerie('Serie1');

$Test->setLineStyle(1.5);
$DataSet->AddSerie('Serie2');
// Draw the line graph
$Test->drawCubicCurve($DataSet->GetData(),$DataSet->GetDataDescription());   
$Test->drawPlotGraph($DataSet->GetData(),$DataSet->GetDataDescription(),4,2,255,255,255);

header('Content-Type: image/jpeg');
header('Content-Disposition: attachment; filename=performance.png');
header('Expires: 0');
header('Pragma: no-cache');   
 
// Finish the graph   
$Test->setFontProperties($libDir.'/pChart/Fonts/tahoma.ttf',8);
$Test->drawLegend($width-163,15,$DataSet->GetDataDescription(),255,255,255);
$Test->setFontProperties($libDir.'/pChart/Fonts/tahomabd.ttf',11);
$Test->drawTitle(65,30,__('statistic.chart.title.rankingLog').' - '.$rankingLiveObj->getRankingName(),50,50,50);
$Test->setFontProperties($libDir.'/pChart/Fonts/tahoma.ttf',8);
$Test->drawCredits($width, $height-55);
$Test->Stroke();
exit;
?>