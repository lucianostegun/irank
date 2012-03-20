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
	
	public function toString(){
		
		return $this->getClubName();
	}
	
	public static function getList(){
		
		$criteria = new Criteria();
		
		return ClubPeer::doSelect($criteria);
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
