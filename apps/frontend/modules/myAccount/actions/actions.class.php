<?php

class myAccountActions extends sfActions
{

  public function preExecute(){

  }
  public function executeUploadTest(){

  }

  public function executeIndex($request){

	$userSiteId = MyTools::getAttribute('userSiteId');
	
	$this->userSiteObj = UserSitePeer::retrieveByPK($userSiteId);
	$this->showSuccess = $this->getFlash('showSuccess');
	$this->selectedTab = $request->getParameter('tab', 'main');
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
  	$userSiteObj->updateEmailGroups();
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
  
  public function executeJavascript($request){

	Util::getHelper('i18n');
	
    header('Content-type: text/x-javascript');
		
	$nl = chr(10);
	
	echo 'var passwordLabel        = "'.__('sign.form.password').'"'.$nl;
	echo 'var passwordConfirmLabel = "'.__('sign.form.passwordConfirm').'";'.$nl;
	exit;
  }
}
