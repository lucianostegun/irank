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
    
	$peopleName   = $request->getParameter('term');
	$instanceName = $request->getParameter('instanceName');
	$suggestNew   = $request->getParameter('suggestNew');

	$options = array('suggestNew'=>$suggestNew,
					 'quickName'=>$peopleName,
					 'jquery'=>true);
	
	$table = 'people';
	
	if( $instanceName=='player' ){
		
		$emailAddress = null;
		
		if( preg_match('/,/', $peopleName) )
			list($peopleName, $emailAddress) = explode(',', $peopleName);
			
		$peopleName   = str_replace(' ', '%', trim($peopleName));
		$emailAddress = str_replace(' ', '%', trim($emailAddress));
		
		$fieldId    = 'id';
		$fieldName  = "FULL_NAME||', '||COALESCE(EMAIL_ADDRESS, 'Não informado')";
		$condition  = "ENABLED AND VISIBLE AND NOT DELETED ";
		$condition .= "AND ((no_accent(full_name) ILIKE no_accent('%$peopleName%') OR no_accent(email_address) ILIKE no_accent('%$peopleName%'))";
		
		if( $emailAddress )
			$condition .= " OR email_address ILIKE '%$emailAddress%'";
			
		$condition .= ")";
	}else{
		
		$peopleName = str_replace(' ', '%', $peopleName);
		
		$fieldId    = 'id';
		$fieldName  = 'FULL_NAME';
		$condition  = 'ENABLED AND VISIBLE AND NOT DELETED AND no_accent(full_name) ILIKE no_accent(\'%'.$peopleName.'%\')';
	}

	$fieldOrder = 'TRIM(full_name)';
	
	
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

  public function executeAddQuickPlayer($request){
    
    $peopleName   = $request->getParameter('peopleName');
    $emailAddress = null;
    
    if( preg_match('/.*,.*@.*/', $peopleName) ){
    	
    	list($peopleName, $emailAddress) = explode(',', $peopleName);
    	$emailAddress = trim($emailAddress);
    }

	$peopleName = ucwords(strtolower(trim($peopleName)));
	$firstName  = preg_replace('/ .*$/', '', $peopleName);
	$lastName   = preg_replace('/^'.$firstName.' /', '', $peopleName);
    
    $peopleObj = PeoplePeer::retrieveByEmailAddress($emailAddress);
    
    if( !is_object($peopleObj) )
		$peopleObj = People::getQuickPeople($firstName, $lastName, 'rankingPlayer', null, 'pt_BR');
		
	if( $emailAddress ){
		
		$peopleObj->setEmailAddress($emailAddress);
		$peopleObj->save();
	}

	echo $peopleObj->getId();
    exit;
  }

  public function executeGetEmailAddress($request){
    
    $peopleId  = $request->getParameter('peopleId');
    $peopleObj = PeoplePeer::retrieveByPK($peopleId);
    
    echo $peopleObj->getEmailAddress();
    exit;
  }
}
