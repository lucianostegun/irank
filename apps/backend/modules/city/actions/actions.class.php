<?php

/**
 * city actions.
 *
 * @package    iRank
 * @subpackage backend
 * @author     Luciano Stegun
 */
class cityActions extends sfActions
{

  public function preExecute(){
    
  }
  
  public function executeAutoComplete($request){
    
	$cityName     = $request->getParameter('cityName');
	$instanceName = $request->getParameter('instanceName');
	$suggestNew   = $request->getParameter('suggestNew');
	
	$options = array('suggestNew'=>$suggestNew,
					 'quickName'=>$cityName);
	
	$cityName = str_replace(' ', '%', $cityName);
	 
	$table      = 'city_view';
	$fieldId    = 'id';
	$fieldName  = 'FULL_NAME';
	$condition  = 'no_accent(full_name) ILIKE no_accent(\'%'.$cityName.'%\')';
	$fieldOrder = '1';
	
	echo Util::getAutoCompleteResults($table, $fieldId, $fieldName, $condition, $fieldOrder, $instanceName, $options );
	exit;
  }
}
