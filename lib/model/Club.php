<?php

/**
 * Subclasse de representação de objetos da tabela 'club'.
 *
 * 
 *
 * @package lib.model
 */ 
class Club extends BaseClub
{
	
	public function getIsNew(){
		
		return ($this->isNew() || (!$this->getVisible() && !$this->getEnabled() && !$this->getDeleted()));
	}
	
    public function delete($con=null){
		
		$tagName = $this->getTagName();
		
		$this->setVisible(false);
		$this->setDeleted(true);
		$this->setTagName(null);
		$this->save();
		
		$this->updateRounting($tagName);
	}
	
	public function quickSave($request){
		
		$clubName       = $request->getParameter('clubName');
		$tagName        = $request->getParameter('tagName');
		$cityId         = $request->getParameter('cityId');
		$addressName    = $request->getParameter('addressName');
		$addressNumber  = $request->getParameter('addressNumber');
		$addressQuarter = $request->getParameter('addressQuarter');
		$clubSite       = $request->getParameter('clubSite');
		$mapsLink       = $request->getParameter('mapsLink');
		$latitude       = $request->getParameter('latitude');
		$longitude       = $request->getParameter('longitude');
		$phoneNumber1   = $request->getParameter('phoneNumber1');
		$phoneNumber2   = $request->getParameter('phoneNumber2');
		$phoneNumber3   = $request->getParameter('phoneNumber3');
		$description    = $request->getParameter('description');
		$smsCredit      = $request->getParameter('smsCredit');
		
		$tagNameOld = $this->getTagName();
		
		$this->setClubName($clubName);
		$this->setTagName($tagName);
		$this->setCityId($cityId);
		$this->setAddressName($addressName);
		$this->setAddressNumber($addressNumber);
		$this->setAddressQuarter($addressQuarter);
		$this->setClubSite(nvl($clubSite));
		$this->setMapsLink(nvl($mapsLink));
		$this->setLatitude(nvl($latitude));
		$this->setLongitude(nvl($longitude));
		$this->setPhoneNumber1($phoneNumber1);
		$this->setPhoneNumber2(nvl($phoneNumber2));
		$this->setPhoneNumber3(nvl($phoneNumber3));
		$this->setDescription(nvl($description));
		
		$iRankAdmin = MyTools::hasCredential('iRankAdmin');
		// Valores salvos apenas se o usuário for administrador
		
		if( $iRankAdmin )
			$this->setSmsCredit(($smsCredit?$smsCredit:0));
		
		$this->setEnabled(true);
		$this->setVisible(true);
		$this->setDeleted(false);
		$this->save();
		
		$this->updateRounting($tagNameOld);
	}

	public static function getList(Criteria $criteria=null){
		
		if( !$criteria )
			$criteria = new Criteria();
			
		$criteria->add( ClubPeer::ENABLED, true );
		$criteria->add( ClubPeer::VISIBLE, true );
		$criteria->add( ClubPeer::DELETED, false );
		$criteria->addDescendingOrderByColumn( ClubPeer::ID );
		
		return ClubPeer::doSelect($criteria);
	}

	public static function getOptionsForSelect($defaultValue=false, $returnArray=false){
		
		$clubObjList = self::getList();

		$optionList = array();
		$optionList[''] = __('select');
		foreach( $clubObjList as $clubObj )			
			$optionList[$clubObj->getId()] = $clubObj->getClubName();
			
		if( $returnArray )
			return $optionList;

		return options_for_select( $optionList, $defaultValue );
	}
	
	public static function getPlayerList($clubId=null, $criteria=null){
		
		if( is_null($criteria) )
			$criteria = new Criteria();
		
		$criteria->setDistinct( PeoplePeer::ID );
		
		if($clubId)
			$criteria->add( ClubPlayerPeer::CLUB_ID, $clubId );
			
		$criteria->addJoin( PeoplePeer::ID, ClubPlayerPeer::PEOPLE_ID, Criteria::INNER_JOIN );
		$criteria->addAscendingOrderByColumn( PeoplePeer::FULL_NAME );
		
		return PeoplePeer::doSelect( $criteria );
	}
	
	public function getLocation(){
		
		if( !$this->getCityId() )
			return null;
		
		return $this->getCity()->getCityName().', '.$this->getCity()->getState()->getInitial();
	}
	
	public function getPhoneNumberList(){
		
		$phoneNumber1 = $this->getPhoneNumber1();
		$phoneNumber2 = $this->getPhoneNumber2();
		$phoneNumber3 = $this->getPhoneNumber3();
		
		$phoneNumberList = array();
		
		if( $phoneNumber1 ) $phoneNumberList[] = $phoneNumber1;
		if( $phoneNumber2 ) $phoneNumberList[] = $phoneNumber2;
		if( $phoneNumber3 ) $phoneNumberList[] = $phoneNumber3;
		
		return $phoneNumberList;
	}
	
	public function getFileNameLogo($original=false){
		
		$fileNameLogo = parent::getFileNameLogo();
		
		if( $original ){
			
			$rankingLiveId = $this->getId();
			$fileNameLogo  = preg_replace('/-[0-9]*(\.[^\.]*)$/', '\1', $fileNameLogo);
		}
		
		if( !$fileNameLogo )
			$fileNameLogo = 'noImage.png';
		
		return $fileNameLogo;
	}
	
	public function customizeLogo(){
		
		$fileName         = $this->getFileNameLogo();
		$fileExtension    = File::getFileExtension($fileName);
//		$filePathOriginal = Util::getFilePath('/images/club/original/'.$fileName);
		$filePath         = Util::getFilePath('/images/club/'.$fileName);
		
		$filePathDestination = str_replace('images/club', 'images/club/original', $filePath);
		$filePathDestination = Util::fixFilePath($filePathDestination);
//		echo "copy($filePath, $filePathDestination);";exit;
		copy($filePath, $filePathDestination);
	
		if( $fileExtension=='jpg' )
			$originalImg = imagecreatefromjpeg( $filePath );
		else
			$originalImg = imagecreatefrompng( $filePath );
			
		$templateImg = imagecreatefrompng(Util::getFilePath('images/club/template.png'));
//		$templateImg = imagecreatefromjpeg(Util::getFilePath('images/club/template.jpg'));

		imagealphablending($templateImg, false);
		imagesavealpha($templateImg, true);
	
		imagecopymerge($templateImg, $originalImg, 4, 4, 0, 0, 122, 122, 100);
		
		if( $fileExtension=='jpg' )
			imagejpeg($templateImg, $filePath, 100);
		else
			imagepng($templateImg, $filePath);
		
		imagedestroy($templateImg);
		imagedestroy($originalImg);
	}
	
	public function getRankingCount(){
		
		return Util::executeOne('SELECT get_club_ranking_count('.$this->getId().')');
	}

	public function getEventCount(){
		
		return Util::executeOne('SELECT COUNT(1) FROM event_live WHERE visible AND enabled AND NOT deleted AND club_id = '.$this->getId());
	}
	
	public function toString($defaultValue=null){
		
		$clubName = $this->getClubName();
		
		if( !$clubName && $defaultValue )
			$clubName = $defaultValue;
		
		return $clubName;
	}
	
	public static function uploadPhoto($request, $clubId){
		
		$clubId               = $request->getParameter('clubId', $clubId);
		$allowedExtensionList = array('jpg', 'jpeg', 'png');
		$maxFileSize          = (1024*1024*4);
		
		$options = array('allowedExtensionList'=>$allowedExtensionList,
						 'maxFileSize'=>$maxFileSize);
	
		try {
			
			$fileObj = File::upload( $request, 'file', 'clubPhoto/club-'.$clubId, $options );
		}catch( Exception $e ){
		
			Util::forceError($e);	
		}
		
		$thumbPath = '/uploads/clubPhoto/club-'.$clubId.'/thumb';
		$fileObj->createThumbnail($thumbPath, 80, 60);
		$fileObj->resizeMax(800,600);
		
		$sizes = getimagesize($fileObj->getFilePath());
		
		$clubPhotoObj = new ClubPhoto();
		$clubPhotoObj->setClubId($clubId);
		$clubPhotoObj->setFileId($fileObj->getId());
		$clubPhotoObj->setWidth($sizes[0]);
		$clubPhotoObj->setHeight($sizes[1]);
		$clubPhotoObj->save();
		
		return $clubPhotoObj;
	}
	
	public function updateVisitCount(){
		
		$clubId    = $this->getId();
		$className = ucfirst(get_class($this));
		
		if( !MyTools::hasAttribute("visitCount$className-$clubId") ){
			
			Util::executeQuery("SELECT update_club_visit_count($clubId)");
			MyTools::setAttribute("visitCount$className-$clubId", true);
		}
	}
	
	public function getEventList($criteria=null){
		
		if( is_null($criteria) )
			$criteria = new Criteria();
		
		$criteria->add( EventLivePeer::CLUB_ID, $this->getId() );
		$criteria->add( EventLivePeer::ENABLED, true );
		$criteria->add( EventLivePeer::VISIBLE, true );
		$criteria->add( EventLivePeer::DELETED, false );
		$criteria->addAscendingOrderByColumn( EventLivePeer::EVENT_DATE_TIME );
		
		return EventLivePeer::doSelect($criteria);
	}
	
	public function getSchedule($criteria=null){
		
		if( is_null($criteria) )
			$criteria = new Criteria();
		
		$criteria->add( EventLiveViewPeer::CLUB_ID, $this->getId() );
		$criteria->addAscendingOrderByColumn( EventLiveViewPeer::EVENT_DATE_TIME );
		
		return EventLiveViewPeer::doSelect($criteria);
	}
	
	public function getCity($con=null){
		
		$cityObj = parent::getCity($con);
		
		if( !is_object($cityObj) )
			$cityObj = new City();
		
		return $cityObj;
	}
	
	/**
	 * Método que atualiza o arquivo /apps/frontend/config/routing.yml
	 * para que os usuários possam acessar as URLs irank.com.br/nomeDoClube
	 */
	public function updateRounting($tagNameOld=null){
		
		$clubId   = $this->getId();
		$tagName  = $this->getTagName();
		$rootDir  = sfConfig::get('sf_root_dir');
		$filePath = Util::getFilePath('/apps/frontend/config/routing.yml', $rootDir);
		$routing  = file_get_contents($filePath);
		
		$pattern = "/club_$tagNameOld:\n *url: *\/$tagNameOld\n *param: *\{ ?module: ?club, ?action: ?details, ?clubId: $clubId ?\}\n\n/";
		// Se o clube foi excluído, remove a entrada do arquivo
		if( $this->getDeleted() ){
			
			$routing = preg_replace($pattern, '', $routing);
		}else{
			
			// Se o novo tagName for igual ao tagName anterior não modifica o arquivo
			if( $tagName==$tagNameOld )
				return true;
			
			// Se não tinha tagName, então é um novo clube e precisa incluir uma entrada no arquivo
			if( !$tagNameOld ){
				
				$metaLine = "#CLUB ROUTING END\n";
				
				$newContent = "club_$tagName:\n".
							  "  url:    /$tagName\n".
							  "  param:  { module: club, action: details, clubId: $clubId }\n\n".
							  $metaLine;
							  
				$routing = str_replace($metaLine, $newContent, $routing);
				mkdir(Util::getFilePath('/uploads/fm/'.$tagName), 0777, true);
	
			// Se já tinha tagName mas mudou de nome substitui a entrada no arquivo
			}elseif($tagName!=$tagNameOld){
				
				$newLine = "club_$tagName:\n  url:    /$tagName\n  param:  { module: club, action: details, clubId: $clubId }\n\n";
				
				$routing = preg_replace($pattern, $newLine, $routing);

				// Trocou o nome? Então já aproveita aqui para renomear o nome da pasta do disco virtual (/web/uploads/fm/nomeDoClube)
				@rename(Util::getFilePath('/uploads/fm/'.$tagNameOld), Util::getFilePath('/uploads/fm/'.$tagName));
			}
		}
		
		$fp = fopen($filePath, 'w');
		fwrite($fp, $routing);
		fclose($fp);
		
		unset($fp);
	}
	
	public function getLink(){
		
		$host    = MyTools::getRequest()->getHost();
		$tagName = $this->getTagName();
		
		return 'http://'.$host.'/'.$tagName;
	}
	
	public function getSettings($tagName){
		
		return ClubSettingsPeer::retrieveByPK($this->getId(), $tagName)->getSettingsValue();
	}
	
	public static function getXml($clubList){
		
		return Util::buildXml($clubList, 'clubs', 'club');
	}
	
	public function getClubPhotoList($criteria=null, $con=null){
		
		$criteria = new Criteria();
		$criteria->add( ClubPhotoPeer::CLUB_ID, $this->getId() );
		$criteria->add( ClubPhotoPeer::DELETED, false );
		$criteria->addDescendingOrderByColumn( ClubPhotoPeer::CREATED_AT );

		return parent::getClubPhotoList($criteria, $con);
	}
	
	public function getDistance($latitude, $longitude, $unit='K') {
  
		$clubLatitude  = $this->getLatitude();
		$clubLongitude = $this->getLongitude();

		$theta = $longitude - $clubLongitude;
		$dist  = sin(deg2rad($latitude)) * sin(deg2rad($clubLatitude)) + cos(deg2rad($latitude)) * cos(deg2rad($clubLatitude)) * cos(deg2rad($theta));
		$dist  = acos($dist);
		$dist  = rad2deg($dist);
		$miles = $dist * 60 * 1.1515;
		$unit  = strtoupper($unit);
		
		if($unit=='K')
			return ($miles * 1.609344);
		elseif($unit=='N')
			return ($miles * 0.8684);
		else
			return $miles;

		// HAVERSINE
//		$earth_radius = 3960.00; # in miles
//		$delta_lat = $clubLatitude-$latitude;
//		$delta_lon = $clubLongitude-$longitude;
//		
//		$alpha    = $delta_lat/2;
//		$beta     = $delta_lon/2;
//		$a        = sin(deg2rad($alpha)) * sin(deg2rad($alpha)) + cos(deg2rad($latitude)) * cos(deg2rad($longitude)) * sin(deg2rad($beta)) * sin(deg2rad($beta));
//		$c        = asin(min(1, sqrt($a)));
//		$distance = 2*$earth_radius * $c;
//		$distance = round($distance, 4);
// 
//		return $distance * 1.609344;
		
		
		
		
		
		// SPHERICAL
//		$deltaLat = $clubLatitude-$latitude;
//		$deltaLon = $clubLongitude-$longitude;
//	  
//		$distance = sin(deg2rad($latitude)) * sin(deg2rad($clubLatitude)) + cos(deg2rad($latitude)) * cos(deg2rad($clubLatitude)) * cos(deg2rad($deltaLon));
//		$distance = acos($distance);
//		$distance = rad2deg($distance);
//		$distance = $distance * 60 * 1.1515;
//		$distance = round($distance, 4);
//	 
//		return $distance* 1.609344;
	}
}
