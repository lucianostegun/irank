<?php

/**
 * Subclasse de persistência de dados para registros da tabela 'user_admin_settings'.
 *
 * 
 *
 * @package ...apps.backend.lib.model
 */ 
class UserAdminSettingsPeer extends BaseUserAdminSettingsPeer
{
	
	public static function retrieveByPK($userAdminId, $tagName, $con=null){
		
		$userAdminId = (nvl($userAdminId));
		
		$settingsObj          = SettingsPeer::retrieveByTagName($tagName);
		$userAdminSettingsObj = parent::retrieveByPK($userAdminId, $settingsObj->getId(), $con);
		
		if( !is_object($userAdminSettingsObj) ){
			
			$userAdminSettingsObj = new UserAdminSettings();
			$userAdminSettingsObj->setUserAdminId($userAdminId);
			$userAdminSettingsObj->setSettingsId($settingsObj->getId());
			$userAdminSettingsObj->setSettingsValue($settingsObj->getDefaultValue());
			$userAdminSettingsObj->save();
		}
		
		return $userAdminSettingsObj;
	}
}
