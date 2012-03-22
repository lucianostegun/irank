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
	
	public function quickSave($request){
		
		$clubName       = $request->getParameter('clubName');
		$cityId         = $request->getParameter('cityId');
		$addressName    = $request->getParameter('addressName');
		$addressNumber  = $request->getParameter('addressNumber');
		$addressQuarter = $request->getParameter('addressQuarter');
		$clubSite       = $request->getParameter('clubSite');
		$mapsLink       = $request->getParameter('mapsLink');
		$phoneNumber1   = $request->getParameter('phoneNumber1');
		$phoneNumber2   = $request->getParameter('phoneNumber2');
		$phoneNumber3   = $request->getParameter('phoneNumber3');
		
		$this->setClubName($clubName);
		$this->setCityID($cityId);
		$this->setAddressName($addressName);
		$this->setAddressNumber($addressNumber);
		$this->setAddressQuarter($addressQuarter);
		$this->setClubSite(($clubSite?$clubSite:null));
		$this->setMapsLink(($mapsLink?$mapsLink:null));
		$this->setPhoneNumber1($phoneNumber1);
		$this->setPhoneNumber2(($phoneNumber2?$phoneNumber2:null));
		$this->setPhoneNumber3(($phoneNumber3?$phoneNumber3:null));
		$this->setEnabled(true);
		$this->setVisible(true);
		$this->setDeleted(false);
		$this->save();
	}
	
	public function toString(){
		
		return $this->getClubName();
	}
	
	public static function getList(){
		
		$criteria = new Criteria();
		$criteria->add( ClubPeer::ENABLED, true );
		$criteria->add( ClubPeer::VISIBLE, true );
		$criteria->add( ClubPeer::DELETED, false );
		
		return ClubPeer::doSelect($criteria);
	}
	
	public function getLocation(){
		
		if( !$this->getCityId() )
			return null;
		
		return $this->getCity()->getCityName().', '.$this->getCity()->getState()->getInitial();
	}
	
	public function getEvents(){
		
		return rand(10,35);
	}
	
	public function getFileNameLogo(){
		
		$fileNameLogo = parent::getFileNameLogo();
		
		if( !$fileNameLogo )
			$fileNameLogo = 'noImage.jpg';
		
		return $fileNameLogo;
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
}
