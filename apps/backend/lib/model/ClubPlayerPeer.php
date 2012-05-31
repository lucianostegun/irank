<?php

/**
 * Subclasse de persistência de dados para registros da tabela 'club_player'.
 *
 * 
 *
 * @package ...apps.backend.lib.model
 */ 
class ClubPlayerPeer extends BaseClubPlayerPeer
{
	
	public static function retrieveByPK($clubId, $peopleId, $con=null){
		
		$clubPlayerObj = parent::retrieveByPK($clubId, $peopleId, $con);
		
		if( !is_object($clubPlayerObj) ){
			
			$clubPlayerObj = new ClubPlayer();
			$clubPlayerObj->setClubId($clubId);
			$clubPlayerObj->setPeopleId($peopleId);
		}
		
		return $clubPlayerObj;
	}
}
