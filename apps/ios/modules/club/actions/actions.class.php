<?php

/**
 * club actions.
 *
 * @package    sf_sandbox
 * @subpackage club
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class clubActions extends sfActions
{
	
  public function preExecute(){
  	
	$this->clubId     = $this->getRequestParameter('clubId');
	$this->clubId     = $this->getRequestParameter('id', $this->clubId);
	$this->userSiteId = $this->getRequestParameter('userSiteId');
  	$this->language   = $this->getRequestParameter('language');
  }
  
  public function executeImageThumb($request){

  	$clubPhotoId  = $request->getParameter('clubPhotoId');
  	$width        = $request->getParameter('width', 300);
  	$clubPhotoObj = ClubPhotoPeer::retrieveByPK($clubPhotoId);
  	
  	$filePath = $clubPhotoObj->getFile()->getFilePath(true);
  	
	$newImg = @imagecreatefromjpeg( $filePath );
	
	header('Content-type: image/jpeg');
	
	$srcW = imagesx($newImg);
	$srcH = imagesy($newImg);
	
	$height = ($srcH*$width/$srcW);
	
	$img = imagecreatetruecolor($width, $height);
	imagecopyresampled($img, $newImg, 0, 0, 0, 0, $width, $height, $srcW, $srcH);
	imagejpeg($img, null, 100);
	imagedestroy($img);
	imagedestroy($newImg);
	exit;
  }
    
  /**
   * Executes index action
   *
   */
  public function executeGetXml($request){
  	
  	$userSiteId  = $request->getParameter('userSiteId');
  	$model       = $request->getParameter('model');
  	$limit       = $request->getParameter('limit', null);
  	$latitude    = $request->getParameter('latitude')*1;
  	$longitude   = $request->getParameter('longitude')*1;
  	$radiusLimit = $request->getParameter('radiusLimit', 5);
	
	switch( $model ){
		case 'club':
			
			$criteria = new Criteria();
			$criteria->setLimit($limit);
			$clubObjList = Club::getList($criteria);
			
			$host = $request->getHost();
		
			foreach($clubObjList as $key=>$clubObj){
				
				$distance = null;
				
				if( $latitude && $longitude){
					
					$distance = $clubObj->getDistance($latitude, $longitude);
					
					if( $radiusLimit > 0 && $distance > $radiusLimit ){
						
						unset($clubObjList[$key]);
						continue;
					}
				}
				
				$clubObj->distance = $distance;
			}
			
			foreach($clubObjList as $key=>$clubObj){
				
				$clubNode = array();
				
				$fileNameLogo = $clubObj->getFileNameLogo();
				$description  = $clubObj->getDescription();
				$description  = strip_tags($description);
				$distance     = $clubObj->distance;
				
				$clubNode['@attributes']    = array('id'=>$clubObj->getId(), 'distance'=>$distance, 'latitude'=>$clubObj->getLatitude(), 'longitude'=>$clubObj->getLongitude());
				$clubNode['clubName']       = $clubObj->toString();
				$clubNode['addressName']    = $clubObj->getAddressName();
				$clubNode['addressNumber']  = $clubObj->getAddressNumber();
				$clubNode['addressQuarter'] = $clubObj->getAddressQuarter();
				$clubNode['city']           = $clubObj->getCity()->getCityName();
				$clubNode['state']          = $clubObj->getCity()->getState()->getInitial();
				$clubNode['description']    = $description;
				$clubNode['clubSite']       = str_ireplace('http://', '', $clubObj->getClubSite());
				$clubNode['phoneNumber']    = $clubObj->getPhoneNumber1();
				$clubNode['fileNameLogo']   = $fileNameLogo;
				$clubNode['logoUrl']        = "http://$host/images/club/$fileNameLogo";

				$clubList[] = $clubNode;
			}
			
			echo Club::getXml($clubList);
			break;
		case 'photo':

			$appVersion = $request->getParameter('appVersion');
			$clubObj    = ClubPeer::retrieveByPK($this->clubId);
			$host       = $request->getHost();
			
			$photoList = array();
			foreach($clubObj->getClubPhotoList() as $clubPhotoObj){
				
				$fileObj  = $clubPhotoObj->getFile();
				$imageUrl = 'http://'.$host.'/'.$fileObj->getFilePath();
				$fileName = Util::getFileName($imageUrl);
				
				$width  = $clubPhotoObj->getWidth();
				$height = $clubPhotoObj->getHeight();
				$orientation = ($width > $height?'landscape':'portrait');
				
				$clubPhotoNode = array();
				$clubPhotoNode['@attributes'] = array('photoId'=>$clubPhotoObj->getId(), 'fileId'=>$clubPhotoObj->getFileId(), 'width'=>$width, 'height'=>$height, 'orientation'=>$orientation);
				$clubPhotoNode['imageUrl']    = 'http://'.$host.'/ios.php/club/imageThumb/clubPhotoId/'.$clubPhotoObj->getId().'/thumb/1';
				$clubPhotoNode['thumbUrl']    = str_replace($fileName, 'thumb/'.$fileName, $imageUrl);
				
				$photoList[] = $clubPhotoNode;
			}
			
			echo ClubPhoto::getXml($photoList);
			break;
	}
	
	exit;
  }
}
