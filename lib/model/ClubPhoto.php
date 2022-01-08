<?php

/**
 * Subclasse de representação de objetos da tabela 'club_photo'.
 *
 * 
 *
 * @package lib.model
 */ 
class ClubPhoto extends BaseClubPhoto
{
	
    public function delete($con=null){
		
		$this->setDeleted(true);
		$this->save();
	}
	
	public static function getXml($photoList){
		
		return Util::buildXml($photoList, 'photos', 'photo');
	}
}
