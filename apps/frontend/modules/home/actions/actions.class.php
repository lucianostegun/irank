<?php

class homeActions extends sfActions
{

  public function executeIndex($request){

  }

  public function executeRandomNames($request){

	$firstNameList = array('Lukas', 'Jonas', 'Maximiliano', 'Ben', 'Felix', 'Lucas', 'Paulo', 'Santiago', 'Matias', 'Tomas', 'Lucas', 'Joaquim', 'Franco', 'Agusto', 'Thiago', 'Nicolas');
	$lastNameList  = array('Silva', 'Souza', 'Santos', 'Lima', 'Oliveira', 'Pereira', 'Machado', 'Carvalho', 'Coelho', 'Leão', 'Lobo', 'Moreira', 'Moureira', 'Ribeiro', 'Almeida', 'Cardoso');
	$serverList   =  array('gmail.com', 'hotmail.com', 'aol.com', 'yahoo.com', 'me.com');
	for($i=1; $i < 74; $i++){
		
		$firstName = $firstNameList[rand(0, 15)];
		$lastName  = $lastNameList[rand(0, 15)];
		$server   = $serverList[rand(0, 4)];
		$emailAddress = strtolower($firstName.$lastName).'@'.$server;
		
		echo 'UPDATE people SET first_name=\''.$firstName.'\', last_name=\''.$lastName.'\', email_address=\''.$emailAddress.'\' WHERE id = '.$i.';<br>';
	}
	
	exit;
  }

  public function executeResume($request){

    sfConfig::set('sf_web_debug', false);
	sfLoader::loadHelpers('Partial', 'Object', 'Asset', 'Tag', 'Javascript', 'Form', 'Text');

	return $this->renderText(get_partial('home/component/resume'));
  }
  
  public function executeChangeLanguage($request){
	
	$culture = $request->getParameter('culture');
	$this->getUser()->setCulture($culture);
	$this->getUser()->setAttribute('culture', $culture);
	exit;
  }
  
  public function executePhotoView($request){
	
	$share   = $request->getParameter('share');
	$shareId = $request->getParameter('shareId');
	
	$photoUrl = '';
	
	switch($share){
		case 'eventPhoto':
			$photoUrl = '/index.php/event/getPhoto/shareId/'.$shareId.'/maxWidth/775';
			break;
		case 'eventResult':
			$photoUrl = '/index.php/event/facebookResultImage/shareId/'.$shareId;
			break;
	}
	
	$this->photoUrl = $photoUrl;
  }

  public function executeEventPhoto($request){
	
	$id   = $request->getParameter('id');
	$zoom = $request->getParameter('zoom');

	$eventPhotoObj = EventPhotoPeer::retrieveByPK($id);
	
	if( !$eventPhotoObj->getIsShared() )
		throw new Exception(__('event.exception.notSharedImage'));
	
	$fileObj = $eventPhotoObj->getFile();
	$fileObj->getResized(($zoom?750:366));
  }
  
  public function executeMobile($request){
  	
  	$this->getUser()->setAttribute('forceClassic', null);

    echo '<html><head><meta http-equiv="refresh" content="0;url=/index.php"/></head></html>';
  	exit;
  }
  
  public function executeJavascript($request){
	
	Util::getHelper('i18n');
	
    header('Content-type: text/x-javascript');
		
	$nl = chr(10);
	
	$peopleId   = $this->getUser()->getAttribute('peopleId');
	
	echo 'var _imageRoot = "http://'.$request->getHost() .'/images";'.$nl;
	echo 'var _CurrentPeopleId = "'.$peopleId.'";'.$nl;
	
	echo 'var i18n_culture             = "'.$this->getUser()->getCulture().'";'.$nl;
	echo 'var i18n_record_exitAlert    = "'.__('record.exitAlert').'";'.$nl;
	echo 'var i18n_tryAgain            = "'.__('tryAgain').'";'.$nl;
	echo 'var i18n_disable             = "'.__('disable').'";'.$nl;
	echo 'var i18n_enable              = "'.__('enable').'";'.$nl;
	echo 'var i18n_zero_zeroZero       = "'.__('zero.zeroZero').'";'.$nl;
	echo 'var i18n_innerLoading        = "'.__('layout.innerLoading').'";'.$nl;
	echo 'var i18n_changeLanguageError = "'.__('layout.changeLanguageError').'";'.$nl;
	exit;
  }
}
