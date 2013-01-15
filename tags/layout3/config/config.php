<?php

function nvl($key, $else=null){
	
	return ($key?$key:$else);
}

function array_split($array, $arraySize=2){  
    
    $elements = ceil(count($array)/$arraySize);
    
	$eventLivePlayerObjGroup = array();
	for($i=0; $i < $elements; $i++)
		$eventLivePlayerObjGroup[$i] = array_slice($array, $i*$arraySize, $arraySize);
	
	return $eventLivePlayerObjGroup;
}

function prexit($object, $noExit=false){
	
	echo '<pre>';
	print_r($object);
	echo '</pre>';
	
	if( !$noExit )
		exit;
}

// symfony directories
$sf_symfony_lib_dir  = dirname(__FILE__).'/../lib/symfony';
$sf_symfony_data_dir = dirname(__FILE__).'/../data/symfony';

//ini_set('session.save_path','/home/irank/sessions');