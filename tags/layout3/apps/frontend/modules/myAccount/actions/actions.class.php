<?php

class myAccountActions extends sfActions
{

  public function preExecute(){

	$this->peopleId   = $this->getUser()->getAttribute('peopleId');
	$this->userSiteId = $this->getUser()->getAttribute('userSiteId');
  }

  public function executeUploadTest(){

  }

  public function executeIndex($request){

	$this->userSiteObj = UserSitePeer::retrieveByPK($this->userSiteId);
	$this->showSuccess = $this->getFlash('showSuccess');
	$this->selectedTab = $request->getParameter('tab', 'main');
  }

  public function executeSmsTerm(){

  }

  public function executeGetAppUpdatedData($request){

	$userSiteId = $request->getParameter('userSiteId');
	
	$userSiteObj = UserSitePeer::retrieveByPK($userSiteId);
	
	if( !is_object($userSiteObj) )
		Util::forceError('error');
	
	echo Util::parseInfo($userSiteObj->getInfo());
	exit;
  }

  public function handleErrorSave(){

  	$this->handleFormFieldError( $this->getRequest()->getErrors() );
  }

  public function executeSave($request){

	$userSiteId  = MyTools::getAttribute('userSiteId');
	$userSiteObj = UserSitePeer::retrieveByPK($userSiteId);
	$firstSave   = false;
	
	$defaultLanguage = $request->getParameter('defaultLanguage');
	MyTools::setCulture($defaultLanguage);

  	$userSiteObj->quickSave($request);
  	$userSiteObj->saveEmailOptions($request);
  	$userSiteObj->saveScheduleOptions($request);
  	$userSiteObj->updateEmailGroups();
  	
  	$peopleObj = $userSiteObj->getPeople();
  	
  	$peopleObj->saveEmailOption($request, true);
  	$peopleObj->saveSmsOption($request, true);
  	
  	echo Util::parseInfo($userSiteObj->getInfo(false, true, false));
  	exit;
  }

  public function executeGetPicture($request){

	$userSiteId = $request->getParameter('userSiteId');
	$peopleId   = $request->getParameter('peopleId');
	$username   = $request->getParameter('username');

	$userSiteObj = UserSitePeer::retrieveByPK($userSiteId);
	
	if( $userSiteObj->getPeopleId()!=$peopleId || $userSiteObj->getUsername()!=$username )
		throw new Exception('Dados inválidos para atualização');
	
	echo $userSiteObj->getProfilePicture();
	
  	exit;
  }

  public function executeGetProfilePictureInfo($request){

	$userSiteId  = MyTools::getAttribute('userSiteId');
	$userSiteObj = UserSitePeer::retrieveByPK($userSiteId);
	
	$imagePath = $userSiteObj->getImagePath();
	$dimension = File::getFileDimension( Util::getFilePath($imagePath) );
	
	$imagePathTmp = '/uploads/profilePicture/tmp/'.Util::getFileName($imagePath);
	$dimensionTmp = File::getFileDimension( Util::getFilePath($imagePathTmp) );
	
	$infoList = array();
	$infoList['src']       = $imagePath;
	$infoList['srcTmp']    = $imagePathTmp;
	$infoList['width']     = $dimension['width'];
	$infoList['height']    = $dimension['height'];
	$infoList['widthTmp']  = $dimensionTmp['width'];
	$infoList['heightTmp'] = $dimensionTmp['height'];
	
	echo Util::parseInfo($infoList);	
  	exit;
  }

  public function executeCutProfilePicture($request){

	$x1     = $request->getParameter('x1');
	$y1     = $request->getParameter('y1');
	$x2     = $request->getParameter('x2');
	$y2     = $request->getParameter('y2');
	$width  = $request->getParameter('width');
	$height = $request->getParameter('height');
	
	$userSiteId  = MyTools::getAttribute('userSiteId');
	$userSiteObj = UserSitePeer::retrieveByPK($userSiteId);
	
	$imagePath = $userSiteObj->getImagePath();
	$imagePath = Util::getFilePath($imagePath);
	$dimension = File::getFileDimension( $imagePath );
	
	$imagePathTmp  = '/uploads/profilePicture/tmp/'.Util::getFileName($imagePath);
	$imagePathTmp  = Util::getFilePath($imagePathTmp);
	$imagePathThmb = '/uploads/profilePicture/thumb/'.Util::getFileName($imagePath);
	$imagePathThmb = Util::getFilePath($imagePathThmb);
	$dimensionTmp  = File::getFileDimension( $imagePathTmp );
	
	$newImg = imagecreatefrompng( $imagePathTmp );

	$srcW = imagesx($newImg);
	$srcH = imagesy($newImg);
	
	$img = imagecreatetruecolor(200, 260);
	imagealphablending($img, false);
	imagesavealpha($img, true);
	imagecopyresampled($img, $newImg, 0, 0, $x1, $y1, 200, 260, $width, $height);
	imagepng($img, $imagePath);
	
	$img = imagecreatetruecolor(65, 78);
	imagealphablending($img, false);
	imagesavealpha($img, true);
	imagecopyresampled($img, $newImg, 0, 0, $x1, $y1, 65, 78, $width, $height);
	imagepng($img, $imagePathThmb);
	
	imagedestroy($img);
	imagedestroy($newImg);
	
  	exit;
  }
  
  public function executeGetCityField($request){
  	
	$stateId = $request->getParameter('stateId');
	
  	Util::getHelper('I18N');
  	Util::getHelpers();
  	echo select_tag('scheduleCityId', City::getOptionsForSelect($stateId), array('id'=>'myAccountScheduleStateId'));
  	exit;
  }
  
  public function executeUploadPhoto($request){
  	
	$username             = $request->getParameter('username');
	$peopleId             = $request->getParameter('peopleId');
	$userSiteId           = $request->getParameter('userSiteId');
	$allowedExtensionList = array('jpg', 'jpeg', 'png');
	$maxFileSize          = (1024*1024*4);

	$userSiteObj = UserSitePeer::retrieve($userSiteId, $peopleId, $username);
	
	if( !is_object($userSiteObj) )
		throw new Exception ('Usuário não encontrado');
	
	$fileName = Util::getFileName($userSiteObj->getImagePath());
	
	$options = array('allowedExtensionList'=>$allowedExtensionList,
					 'maxFileSize'=>$maxFileSize,
					 'fileName'=>'tmp/'.$fileName,
					 'noFile'=>true);

	try {

		$fileObj = File::upload( $request, 'Filedata', 'profilePicture', $options );
	}catch( Exception $e ){
	
		Util::forceError($e);	
	}

	$originalFileName = $request->getFileName('Filedata');
	
	$imagePathTmp = Util::getFilePath('/uploads/profilePicture/tmp/'.$fileName );
	$extension    = File::getFileExtension($originalFileName);

	switch( $extension ){
		case 'jpg':
		case 'jpeg':
			$newImg = imagecreatefromjpeg( $imagePathTmp );
			break;
		case 'png':
			$newImg = imagecreatefrompng( $imagePathTmp );
			break;
	}

	$srcW = imagesx($newImg);
	$srcH = imagesy($newImg);
	
	$width  = $srcW;
	$height = $srcH;
	
	if( $srcW < 200 || $srcH < 260 )
		Util::forceError('Imagem muito pequena', true);
	
	while(($width > 640 || $height > 480) && $width >= 200 && $height >= 260 ){
		
		$width  = $width*0.99;
		$height = $height*0.99;
	}
	
	$width  = round($width);
	$height = round($height);
	
	$img = imagecreatetruecolor($width, $height);
	imagealphablending($img, false);
	imagesavealpha($img, true);
	imagealphablending($img, false);
	imagesavealpha($img, true);

	imagecopyresampled($img, $newImg, 0, 0, 0, 0, $width, $height, $srcW, $srcH);
	imagepng($img, $imagePathTmp);
	imagedestroy($img);
	imagedestroy($newImg);
	exit;
  }

  public function executeInvites($request){

  }

  public function executeGetTabContent($request){
  	
  	$tabId = $request->getParameter('tabId');
  	$tabId = strtolower($tabId);
  	
 	$tabPath = 'myAccount/include/'.$tabId;
  	
	sfLoader::loadHelpers('Partial', 'Object', 'Asset', 'Tag');
	return $this->renderText(get_partial($tabPath, array()));
  }
  
  public function executeDeletePendingInvite($request){

	$peopleId    = MyTools::getAttribute('peopleId');  	
  	$eventId     = $request->getParameter('id');
  	$eventLiveId = $request->getParameter('id');
  	$eventType   = $request->getParameter('eventType');
  	
  	
  	$idList = People::getPendingInviteList(true, ($eventType=='event'?'home':'live'));
  	
  	if( !in_array($eventId, $idList) )
  		exit;
  	
  	if( $eventType=='event' ){
  		
	  	$eventPlayerObj = EventPlayerPeer::retrieveByPk($eventId, $peopleId);
	  	$eventPlayerObj->setSuppressNotify(true);
	  	$eventPlayerObj->save();
  	}else{
  		
	  	$eventLivePlayerObj = EventLivePlayerPeer::retrieveByPk($eventLiveId, $peopleId);
	  	$eventLivePlayerObj->save();
  	}
  	
  	exit;
  }

  public function executeBankroll($request){

  }

  public function executeExportBankroll($request){

	$this->peopleId       = $this->getUser()->getAttribute('peopleId');
	$this->userSiteId     = $this->getUser()->getAttribute('userSiteId');
	$this->fileName       = 'bankroll.pdf';
	$this->throwException = true;
	
	$this->userSiteObj = UserSite::getCurrentUser();
	
	$this->forceDownload = true;
	
	$this->setLayout('pdf');
  }

  public function executeExportBankrollBatch($request){

	$peopleId = $request->getParameter('peopleId');
	$peopleId = Util::decodeId($peopleId);
	
	$peopleObj            = PeoplePeer::retrieveByPK($peopleId);
	$this->userSiteObj    = $peopleObj->getUserSite();
	$this->peopleId       = $peopleId;
	$this->userSiteId     = $this->userSiteObj->getId();
	$this->throwException = true;
	$this->setLayout('pdf');
	$this->setTemplate('exportBankroll');
  }

  public function executeGetTopResume($request){

	$year = $request->getParameter('year');
	
	sfLoader::loadHelpers('Partial', 'Object', 'Asset', 'Tag');
	return $this->renderText(get_partial('myAccount/bankroll/topResume', array('peopleId'=>$this->peopleId, 'userSiteId'=>$this->userSiteId, 'year'=>$year)));
  }

  public function executeGetChartResume($request){

	$year = $request->getParameter('year');
	
	sfLoader::loadHelpers('Partial', 'Object', 'Asset', 'Tag');
	return $this->renderText(get_partial('myAccount/bankroll/chartResume', array('peopleId'=>$this->peopleId, 'userSiteId'=>$this->userSiteId, 'year'=>$year, 'pdf'=>false)));
  }

  public function executeBankrollChart($request){

	$this->peopleId = $request->getParameter('peopleId');
	$this->peopleId = $this->getUser()->getAttribute('peopleId', $this->peopleId);
	
	$this->userSiteId = $request->getParameter('userSiteId');
	$this->userSiteId = $this->getUser()->getAttribute('userSiteId', $this->userSiteId);
	$this->setTemplate('chart/bankroll');
  }

  public function executeResumeChart($request){

	$this->peopleId = $request->getParameter('peopleId');
	$this->peopleId = $this->getUser()->getAttribute('peopleId', $this->peopleId);
	
	$this->userSiteId = $request->getParameter('userSiteId');
	$this->userSiteId = $this->getUser()->getAttribute('userSiteId', $this->userSiteId);
	
	$this->setTemplate('chart/resume');
  }

  public function executeSendSmsValidationCode($request){

	$phoneDdd    = $request->getParameter('phoneDdd');
	$phoneNumber = $request->getParameter('phoneNumber');

	$userSiteObj       = UserSitePeer::retrieveByPK($this->userSiteId);
	$userSiteConfigObj = $userSiteObj->getConfig();
	
	do{
	
		$smsValidationCode = String::createRandom(4);	
	}while($smsValidationCode=='0000');
	
	$userSiteConfigObj->setSmsValidationCode($smsValidationCode);
	$userSiteConfigObj->setSmsValidationAttempts(0);
	$userSiteConfigObj->save();
	
	$peopleObj = $userSiteObj->getPeople();
	$peopleObj->setPhoneDdd(nvl($phoneDdd));
  	$peopleObj->setPhoneNumber(nvl($phoneNumber));
  	$peopleObj->save();
	
	$message = "Código de validação de seu cadastro iRank: $smsValidationCode";
	
	$smsObj = new Sms();
	$smsObj->setPeopleId($userSiteObj->getPeopleId());
	$smsObj->setPhoneNumber($phoneDdd.$phoneNumber);
	$smsObj->setMessage($message);
//	$smsObj->send($userSiteObj);
	exit;
  }

  public function executeValidateSmsCode($request){

	$smsValidationCode = $request->getParameter('smsValidationCode');

	$userSiteConfigObj = UserSiteConfigPeer::retrieveByPK($this->userSiteId);
	
	if( !is_object($userSiteConfigObj) )
		throw new Exception('user not found');
	
	if( !$userSiteConfigObj->getSmsValidationCode() )
		throw new Exception('Undefined SMS validation code');
		
	if( $userSiteConfigObj->getSmsValidationCode()!=strtoupper($smsValidationCode) ){
		
		$userSiteConfigObj->setSmsValidationAttempts( $userSiteConfigObj->getSmsValidationAttempts()+1 );
		$userSiteConfigObj->save();
		
		if( $userSiteConfigObj->getSmsValidationAttempts() >= 5 ){
			
			$userSiteConfigObj->setSmsValidationAttempts(0);
			$userSiteConfigObj->setSmsValidationCode(null);
			$userSiteConfigObj->save();
			
			Log::doLog("Excedido limite de tentativas de ativar código SMS para o usuário {$this->userSiteId}", 'UserSiteConfig', array(), Log::LOG_EMERGENCY);
			
			Util::forceError('exceededAttemptsLimit');
		}
	
		die('error');
	}
	
	$userSiteConfigObj->setSmsValidationCode('0000');
	$userSiteConfigObj->setAgreedSmsTerms('0000');
	$userSiteConfigObj->save();
	
	echo 'success';
	exit;
  }
  
  public function executeJavascript($request){

	Util::getHelper('i18n');
	
    header('Content-type: text/x-javascript');
		
	$nl = chr(10);
	
	echo 'var passwordLabel        = "'.__('sign.form.password').'"'.$nl;
	echo 'var passwordConfirmLabel = "'.__('sign.form.passwordConfirm').'";'.$nl;
	exit;
  }
}
