<?php

/**
 * cashTable actions.
 *
 * @package    iRank
 * @subpackage backend
 * @author     Luciano Stegun
 */
class cashTableActions extends sfActions
{

  public function preExecute(){
    
    $this->cashTableId = $this->getRequestParameter('id');
    $this->cashTableId = $this->getRequestParameter('cashTableId', $this->cashTableId);
    $this->cashTableId = $this->getUser()->getAttribute('cashTableId', $this->cashTableId);
    
    $this->iRankAdmin = $this->getUser()->hasCredential('iRankAdmin');
	$this->clubId     = $this->getUser()->getAttribute('clubId');
    
    $this->pathList         = array('Cash game'=>'cashTable/index');
    $this->toolbarList      = array('new');
  }
  
  public function executeIndex($request){
    
  }

  public function executeNew($request){
  	
    $this->cashTableObj = Util::getNewObject('cashTable');
    
    $this->pathList['Nova mesa'] = '#';
    $this->setTemplate('edit');
    
    sfLoader::loadHelpers('Partial');
    $this->stats   = get_partial('cashTable/include/stats', array('cashTableObj'=>$this->cashTableObj));
    $this->balance = get_partial('cashTable/include/balance', array('cashTableObj'=>$this->cashTableObj));
    
    $this->toolbarList = array('new', 'save');
  }
  
  public function executeEdit($request){
    
    $this->cashTableObj = $cashTableObj = CashTablePeer::retrieveByPK($this->cashTableId);
    
    if( !is_object($cashTableObj) )
    	return $this->redirect('cashTable/index');
    
    sfLoader::loadHelpers('Partial');
    $this->stats   = get_partial('cashTable/include/stats', array('cashTableObj'=>$this->cashTableObj));
    $this->balance = get_partial('cashTable/include/balance', array('cashTableObj'=>$this->cashTableObj));
    	
    $this->pathList[$cashTableObj->getCashTableName()] = '#';
   	$this->toolbarList = array('new', 'save', 'delete');
  }

  public function handleErrorSave(){

  	$this->handleFormFieldError( $this->getRequest()->getErrors() );
  }

  public function executeSave($request){
    
    $cashTableId = $this->getUser()->getAttribute('cashTableId');
	
    if( $cashTableId && $cashTableId!=$this->cashTableId ){
    	
	    $username = $this->getUser()->getAttribute('username');

    	Log::doLog('Usuário <b>'.$username.'</b> tentou editar as informações da mesa <b>('.$cashTableObj->getId().') '.$cashTableObj->toString().'</b>.', 'CashTable', array(), Log::LOG_CRITICAL);
    	throw new Exception('Você não tem permissão para editar esse registro!');
    }
    
    $cashTableObj = CashTablePeer::retrieveByPK($this->cashTableId);
    
    $cashTableObj->quickSave($request);
    
    exit;
  }

  public function executeDelete($request){
    
    if( empty($this->cashTableId) )
    	Util::forceError('!Nenhum registro foi selecionado!');
    
    try{
    	
	    $criteria = new Criteria();
	    $criteria->add( CashTablePeer::ID, $this->cashTableId, Criteria::IN );
	    $criteria->add( CashTablePeer::VISIBLE, true );
	    $criteria->add( CashTablePeer::ENABLED, true );
	    $criteria->add( CashTablePeer::DELETED, false );
    	$cashTableObjList = CashTablePeer::doSelect($criteria);
    	
    	$cashTableIdList = array();
    	foreach($cashTableObjList as $cashTableObj){
    		
    		$cashTableObj->delete();
	    	$cashTableIdList[] = $cashTableObj->getId();
    	}
    	
    	echo implode(',', $cashTableIdList);
    }catch(Exception $e){
    	
    	Util::forceError($e->getMessage());
    }
    
    exit;
  }

  public function executeOpenTable($request){
    
    $cashTableObj = CashTablePeer::retrieveByPK($this->cashTableId);
    
    if( !$cashTableObj->isMyCashTable() ){
    	
	    $username = $this->getUser()->getAttribute('username');
    	Log::doLog('Usuário <b>'.$username.'</b> tentou abrir a mesa <b>('.$cashTableObj->getId().') '.$cashTableObj->toString().'</b>.', 'CashTable', array(), Log::LOG_CRITICAL);
    	
    	throw new Exception('Você não tem permissão para editar esta mesa!');
    }
    
	try{
		
	    $cashTableObj->openTable();
	}catch(Exception $e){
		
    	Util::forceError('!'.$e->getMessage());
	}

  	sfConfig::set('sf_web_debug', false);
	sfLoader::loadHelpers('Partial', 'Object', 'Asset', 'Tag', 'Javascript', 'Form', 'Text');
	return $this->renderText(get_partial('cashTable/tab/main', array('cashTableObj'=>$cashTableObj)));
  }

  public function executeCloseTable($request){
    
    $cashTableObj = CashTablePeer::retrieveByPK($this->cashTableId);
    
	try{
		
	    $cashTableObj->closeTable();
	}catch(Exception $e){
		
    	Util::forceError('!'.$e->getMessage());
	}
    	
  	sfConfig::set('sf_web_debug', false);
	sfLoader::loadHelpers('Partial', 'Object', 'Asset', 'Tag', 'Javascript', 'Form', 'Text');
	return $this->renderText(get_partial('cashTable/tab/main', array('cashTableObj'=>$cashTableObj)));
  }

  public function executeSeatPlayer($request){
    
    $peopleId      = $request->getParameter('peopleId');
    $tablePosition = $request->getParameter('tablePosition');
    $buyin         = $request->getParameter('buyin');
    
    $cashTableObj = CashTablePeer::retrieveByPK($this->cashTableId);
    
	try{
		
	    $cashTableObj->seatPlayer($peopleId, $tablePosition, $buyin);
	    
	    echo Util::parseInfo($cashTableObj->getInfo());
	}catch(Exception $e){
		
    	Util::forceError('!'.$e->getMessage());
	}
	
	exit;
  }
}
