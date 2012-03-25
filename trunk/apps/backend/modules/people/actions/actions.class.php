<?php

/**
 * people actions.
 *
 * @package    iRank
 * @subpackage backend
 * @author     Luciano Stegun
 */
class peopleActions extends sfActions
{

  public function preExecute(){
    
  }
  
  public function executeAutoComplete($request){
    
	$peopleName   = $request->getParameter('peopleName');
	$instanceName = $request->getParameter('instanceName');
	$suggestNew   = $request->getParameter('suggestNew');

	$options = array('suggestNew'=>$suggestNew,
					 'quickName'=>$peopleName);
	
	$peopleName = str_replace(' ', '%', $peopleName);
	 
	$table      = 'people';
	$fieldId    = 'id';
	$fieldName  = 'FULL_NAME';
	$condition  = 'no_accent(full_name) ILIKE no_accent(\'%'.$peopleName.'%\')';
	$fieldOrder = '1';
	
	echo Util::getAutoCompleteResults($table, $fieldId, $fieldName, $condition, $fieldOrder, $instanceName, $options );
	exit;
  }

  public function executeAddQuick($request){
    
	$fullName  = $request->getParameter('quickName');
	$firstName = preg_replace('/ .*/', '', $fullName);
	$lastName  = preg_replace('/^'.$firstName.' /', '', $fullName);
	
	$peopleObj = new People();
	$peopleObj->setFirstName($firstName);
	$peopleObj->setLastName($lastName);
	$peopleObj->setFullName($fullName);
	$peopleObj->save();
	
	echo $peopleObj->getId();
	exit;
  }
}
