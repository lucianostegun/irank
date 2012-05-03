<?php

/**
 * Subclasse de persistência de dados para registros da tabela 'club_settings'.
 *
 * 
 *
 * @package ...apps.backend.lib.model
 */ 
class ClubSettingsPeer extends BaseClubSettingsPeer
{
	
	public static function retrieveByPK($clubId, $tagName, $con=null){
		
		$clubId = ($clubId?$clubId:null);
		
		$settingsObj     = SettingsPeer::retrieveByTagName($tagName);
		$clubSettingsObj = parent::retrieveByPK($clubId, $settingsObj->getId(), $con);
		
		if( !is_object($clubSettingsObj) ){
			
			
			$clubSettingsObj = new ClubSettings();
			$clubSettingsObj->setClubId($clubId);
			$clubSettingsObj->setSettingsId($settingsObj->getId());
			$clubSettingsObj->setSettingsValue($settingsObj->getDefaultValue());
			$clubSettingsObj->save();
		}
		
		return $clubSettingsObj;
	}
}
