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

    $this->peopleId = $this->getRequestParameter('id');
    $this->peopleId = $this->getRequestParameter('peopleId', $this->peopleId);
        
    $this->clubId = $this->getUser()->getAttribute('clubId');
    
    $this->pathList = array('Usuários'=>'people/index');
    
    if( !$this->clubId )
    	$this->toolbarList = array('new');
  }
  
  public function executeIndex($request){
  }
  
  public function executeEdit($request){
    
    $this->peopleObj = $peopleObj = PeoplePeer::retrieveByPK($this->peopleId);
    
    if( !$peopleObj->isMyPlayer() ){
    	
	    $username = $this->getUser()->getAttribute('username');

    	Log::doLog('Usuário <b>'.$username.'</b> tentou acessar as informações da pessoa <b>('.$peopleObj->getId().') '.$peopleObj->toString().'</b>.', 'People', array(), Log::LOG_CRITICAL);
    	$peopleObj = null;
    }
    
    if( !is_object($peopleObj) )
    	return $this->redirect('people/index');
    
    $userSiteObj = $peopleObj->getUserSite();
    
	sfLoader::loadHelpers('Partial');
	
	if( is_object($userSiteObj) )
    	$this->stats = get_partial('people/include/stats', array('peopleObj'=>$peopleObj, 'userSiteObj'=>$userSiteObj));
    	
    $this->balance = get_partial('people/include/balance', array('peopleObj'=>$peopleObj));
    	
    $this->pathList[$peopleObj->toString()] = '#';
    
    if( $this->clubId )
    	$this->toolbarList = array('save');
    else
    	$this->toolbarList = array('new', 'save', 'delete'=>'#doDeletePeople()');
  }

  public function handleErrorSave(){

  	$this->handleFormFieldError( $this->getRequest()->getErrors() );
  }

  public function executeSave($request){
    
    $peopleObj = PeoplePeer::retrieveByPK($this->peopleId);
	
    if( !$peopleObj->isMyPlayer() ){
    	
	    $username = $this->getUser()->getAttribute('username');

    	Log::doLog('Usuário <b>'.$username.'</b> tentou editar as informações da pessoa <b>('.$peopleObj->getId().') '.$peopleObj->toString().'</b>.', 'People', array(), Log::LOG_CRITICAL);
    	throw new Exception('Você não tem permissão para editar esse registro!');
    }
    
    if( $this->clubId )
    	$peopleObj->quickSaveClub($request);
    else
    	$peopleObj->quickSaveAdmin($request);
    
    echo Util::parseInfo($peopleObj->getInfo());
    exit;
  }

  public function handleErrorSaveQuick(){

  	$this->handleFormFieldError( $this->getRequest()->getErrors() );
  }

  public function executeSaveQuick($request){
    
    return $this->executeSave($request);
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
    
    $peopleObj = PeoplePeer::retrieveByPK($this->peopleId);
    
    echo $peopleObj->getEmailAddress();
    exit;
  }

  public function executeGetInfo($request){
    
    $peopleObj = PeoplePeer::retrieveByPK($this->peopleId);
    $clubId    = $this->getUser()->getAttribute('clubId');
    
    if( $clubId && !$peopleObj->isMyPlayer($clubId) ){

	    $username = $this->getUser()->getAttribute('username');

    	Log::doLog('Usuário <b>'.$username.'</b> tentou recuperar as informações da pessoa <b>('.$peopleObj->getId().') '.$peopleObj->toString().'</b>.', 'People', array(), Log::LOG_CRITICAL);
    	throw new Exception('Você não tem permissão para visualizar esse registro!');
    }
    
    echo Util::parseInfo($peopleObj->getInfo());
    
    exit;
  }
  
  public function executeGetPlayerInfo($request){
    
    $peopleObj = PeoplePeer::retrieveByPK($this->peopleId);
    
    $infoList = $peopleObj->getInfo();
    $infoList['lastGame']    = '(primeira vez)';
    $infoList['restriction'] = 'Nenhuma';
    
    echo Util::parseInfo($infoList);
    
    exit;
  }
}
