<?php

/**
 * timer actions.
 *
 * @package    iRank
 * @subpackage frontend
 * @author     Luciano Stegun
 */
class timerActions extends sfActions
{

  public function preExecute(){
    
   	$this->timerSession = $this->getTimerSession();
//	$this->timerSession = $this->getNewSession();
//	prexit($this->timerSession);
//	echo '<pre>';print_r($this->timerSession);
  }
  
  public function executeIndex($request){
    
  }
  
  public function executeTimer($request){

    $timerId = $request->getParameter('id');
    $timerId = $request->getParameter('timerId', $timerId);
    $this->timerId = base64_decode($timerId);
    
    sfConfig::set('sf_web_debug', false);
  }
  
  public function executeGetWizardStep($request){
    
    $step = $request->getParameter('step');
    
    $wizardSteps = array(1=>'main', 2=>'options', 3=>'levels', 4=>'extra', 5=>'success');
    $wizardStep  = $wizardSteps[$step];
    
    $this->setTemplate('steps/'.$wizardStep);
  }

  public function handleErrorSaveWizardMain(){

  	$this->handleFormFieldError( $this->getRequest()->getErrors() );
  }

  public function executeSaveWizardMain($request){
	
	$timerName = $request->getParameter('timerName');
	$chipStack = $request->getParameter('chipStack');
	
	$this->timerSession->timerName = $timerName;
	$this->timerSession->chipStack = $chipStack;
	
	$this->getUpdateSession($this->timerSession);
	
	return $this->forward('timer', 'getWizardStep');    
  }

  public function handleErrorSaveWizardOptions(){

  	$this->handleFormFieldError( $this->getRequest()->getErrors() );
  }

  public function executeSaveWizardOptions($request){

	$levels   = $request->getParameter('levels');
	$duration = $request->getParameter('duration');
	$hasAnte  = $request->getParameter('hasAnte');
	
	$this->timerSession->levels   = $levels;
	$this->timerSession->duration = $duration;
	$this->timerSession->hasAnte  = $hasAnte;
	
	$chipStack = $this->timerSession->chipStack;

	if( empty($this->timerSession->levelList) ){
		
		if( $chipStack <= 100 ){
			
			$bigBlindList = array(2, 4, 6, 10, 20, 30, 50, 100, 'pause', 150, 200, 300, 400, 500, 600, 800, 1000, 'pause', 1200, 1500);
			$anteList     = array(0, 0, 0,  2,  2,  2,  4,   4,       0,   4,   5,   5,   5,  10,  10,  10,   10,       0,   20,   20);
		}elseif( $chipStack <= 1000 ){
			
			$bigBlindList = array(20, 40, 60, 100, 150, 200, 300, 400, 'pause', 600, 800, 1000, 2000, 3000, 4000, 5000, 'pause', 6000, 8000, 10000);
			$anteList     = array( 0,  0,  0,  10,  10,  20,  20,  20,       0,  40,  40,   50,   50,   50,   50,  100,      0,   150,  150,   200);
		}elseif( $chipStack > 1000 || !$chipStack ){
			
			$bigBlindList = array(50, 100, 150, 200, 300, 400, 600, 800, 'pause', 1000, 1200, 1600, 2000, 3000, 4000, 5000, 6000, 8000, 10000, 'pause', 12000, 16000, 20000, 30000, 40000, 50000);
			$anteList     = array(0,    0,   0,  25,  25,  50,  50,  50,       0, 100,  100,  200,  200,  300,  300,  400,  400,  400,   500,        0,   500,   500,   600,   600,   600,  1000);
		}
		
		$levelList  = array();
		
		$blindLevel = 0;
		foreach($bigBlindList as $key=>$bigBlind){
			
			if( $this->timerSession->levels==$blindLevel )
				break;
			
			$isPause    = $bigBlind=='pause';
			$bigBlind   = ($isPause?0:$bigBlind);
			$smallBlind = ($isPause?0:$bigBlind/2);
			$ante       = ($hasAnte?$anteList[$key]:0);
			
			if( !$isPause )
				$blindLevel++;
			
			$level = array();
	  		$level['smallBlind'] = $smallBlind;
	  		$level['bigBlind']   = $bigBlind;
	  		$level['ante']       = $ante;
	  		$level['isPause']    = $isPause;
	  		$level['duration']   = ($isPause?floor($duration/2):$duration);
	  		$levelList[] = $level;
		}
		
	  	$this->timerSession->levels    = count($levelList);
		$this->timerSession->levelList = $levelList;
	}
	
	$this->getUpdateSession($this->timerSession);
	
	return $this->forward('timer', 'getWizardStep');    
  }

  public function handleErrorSaveWizardLevels(){

  	$this->handleFormFieldError( $this->getRequest()->getErrors() );
  }

  public function executeSaveWizardLevels($request){
  	
  	$smallBlindList = $request->getParameter('smallBlind');
  	$bigBlindList   = $request->getParameter('bigBlind');
  	$anteList       = $request->getParameter('ante');
  	$isPauseList    = $request->getParameter('isPause');
  	$durationList   = $request->getParameter('duration');
  	
  	$levelList = array();
  	$levels    = 0;
  	$hasAnte   = false;
  	
  	foreach($durationList as $key=>$duration){
  		
  		$isPause = $isPauseList[$key];
  		
  		$level = array();
  		$level['smallBlind'] = $smallBlindList[$key];
  		$level['bigBlind']   = $bigBlindList[$key];
  		$level['ante']       = $anteList[$key];
  		$level['isPause']    = $isPause;
  		$level['duration']   = $duration;
  		
  		if( $level['ante'] > 0 )
  			$hasAnte = true;
  		
  		$levelList[] = $level;
  		
  		if( !$isPause )
  			$levels++;
  	}

  	$this->timerSession->hasAnte   = $hasAnte;
  	$this->timerSession->levels    = $levels;
	$this->timerSession->levelList = $levelList;
	
	$this->getUpdateSession($this->timerSession);

	return $this->forward('timer', 'getWizardStep');   
  }

  public function executeSaveWizardExtra($request){
  	
  	$userSiteId   = $this->getUser()->getAttribute('userSiteId');
  	$playSound    = $request->getParameter('playSound');
  	$minuteAlert  = $request->getParameter('minuteAlert');
  	$confirmLevel = $request->getParameter('confirmLevel');
  	$step         = $request->getParameter('step');
  	
  	if( $step!=5 )
  		return $this->forward('timer', 'getWizardStep');
  	
  	$timerObj = new Timer();
  	$timerObj->setUserSiteId( $userSiteId );
  	$timerObj->setTimerName( $this->timerSession->timerName );
  	$timerObj->setDefaultDuration( $this->timerSession->duration );
  	$timerObj->setLevels( $this->timerSession->levels );
  	$timerObj->setHasAnte( $this->timerSession->hasAnte );
  	$timerObj->setPlaySound( $playSound );
  	$timerObj->setMinuteAlert( ($playSound?$minuteAlert:false) );
  	
  	foreach($this->timerSession->levelList as $level){
  		
  		$timerLevelObj = new TimerLevel();
  		$timerLevelObj->setSmallBlind( $level['smallBlind'] );
  		$timerLevelObj->setBigBlind( $level['bigBlind'] );
  		$timerLevelObj->setAnte( $level['ante'] );
  		$timerLevelObj->setDuration( $level['duration'] );
  		$timerLevelObj->setIsPause( $level['isPause'] );
  		$timerObj->addTimerLevel($timerLevelObj);
  	}
  	
  	try{
  		
  		$con = Propel::getConnection();
  		$con->begin();
	  	
	  	$timerObj->save($con);
	  	
	  	$this->timerSession = $this->getNewSession();
	  	
	  	$con->commit();
  	}catch(Exception $e){
  		
  		$con->rollback();
  		Util::forceError('!Database connection error');
  	}

  	$this->timerId = $timerObj->getId();
  	
	$this->setTemplate('steps/success');    
  }
  
  public function executeGetXml($request){

	$timerId = $request->getParameter('timerId');
	
	$criteria = new Criteria();
	$criteria->add( TimerLevelPeer::TIMER_ID, $timerId );
	$criteria->addAscendingOrderByColumn( TimerLevelPeer::ID );	
	$timerLevelObjList = TimerLevelPeer::doSelect($criteria);
	
	$data = array();
	$level = 0;
	foreach($timerLevelObjList as $timerLevelObj){
		
		$isPause = $timerLevelObj->getIsPause();
		$level  += ($isPause?0:1);
		
		$result = array();
		$result[] = $timerLevelObj->getId();
		$result[] = '/images/blank.gif';
		$result[] = '#'.$level;
		$result[] = $timerLevelObj->getSmallBlind();
		$result[] = $timerLevelObj->getBigBlind();
		$result[] = $timerLevelObj->getAnte();
		$result[] = $timerLevelObj->getDuration();
		$result[] = 'min';
		$result[] = $isPause?'1':'0';
		$data[] = $result;
	}
	
	echo DhtmlxGrid::getXml($data);
	exit;
  }
  
  private function getNewSession(){
  	
  	$ipAddress = $_SERVER['REMOTE_ADDR'];
  	$sessionId = $ipAddress.'-'.microtime();
  	
  	$timerSessionObj = new stdClass();
  	$timerSessionObj->timerName    = 'Novo timer';
  	$timerSessionObj->chipStack    = null;
  	$timerSessionObj->levels       = 10;
  	$timerSessionObj->duration     = 15;
  	$timerSessionObj->hasAnte      = false;
  	$timerSessionObj->levelList    = array();
  	$timerSessionObj->playSound    = true;
  	$timerSessionObj->minuteAlert  = false;
  	$timerSessionObj->confirmLevel = false;
  	$timerSessionObj->createdAt    = time();
  	
  	return $this->getUpdateSession($timerSessionObj);
  }

  private function getTimerSession(){
  	
	$timerSessionObj = $this->getUser()->getAttribute('iRankTimerSession');
	
	if( empty($timerSessionObj) )
		return $this->getNewSession();
	
	$timerSessionObj = base64_decode($timerSessionObj);
	$timerSessionObj = unserialize($timerSessionObj);
	
	return $timerSessionObj;
  }
  
  private function getUpdateSession($timerSessionObj){
  	
  	$timerSessionObj = serialize($timerSessionObj);
  	$timerSessionObj = base64_encode($timerSessionObj);
  	
  	$this->getUser()->setAttribute('iRankTimerSession', $timerSessionObj);
  	
  	$this->timerSession = $timerSessionObj;
  	return $this->timerSession;
  }
}
