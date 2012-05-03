<?php

/**
 * Subclasse de representação de objetos da tabela 'settings'.
 *
 * 
 *
 * @package ...apps.backend.lib.model
 */ 
class Settings extends BaseSettings
{

	public static function getList(Criteria $criteria=null){
		
		if( !$criteria )
			$criteria = new Criteria();
			
		$criteria->addAscendingOrderByColumn( SettingsPeer::SETTINGS_NAME );
		
		return SettingsPeer::doSelect($criteria);
	}

	public static function getOptionsForSelect($defaultValue=false, $returnArray=false){
		
		$settingsObjList = self::getList();

		$optionList = array();
		$optionList[''] = __('select');
		foreach( $settingsObjList as $settingsObj )			
			$optionList[$settingsObj->getId()] = $settingsObj->getSettingsName();
			
		if( $returnArray )
			return $optionList;

		return options_for_select( $optionList, $defaultValue );
	}
	
	public static function saveValue($tagName, $request, $attribute='userAdmin'){
		
		$settingsObj = SettingsPeer::retrieveByTagName($tagName);
		
  		$attributeId = MyTools::getAttribute($attribute.'Id');
  	
  		if( $attribute=='userAdmin' )
			$genericSettingsObj = UserAdminSettingsPeer::retrieveByPK($attributeId, $tagName);
		elseif( $attribute=='club' )
			$genericSettingsObj = ClubSettingsPeer::retrieveByPK($attributeId, $tagName);
		
		$settingsValue = $request->getParameter($tagName);
		
		$genericSettingsObj->setSettingsValue($settingsValue);
		$genericSettingsObj->save();
	}
	
	public static function getValue($tagName){
		
		if( $settingsValue = MyTools::getAttribute('iRankAdminSettings-'.$tagName, null, 'iRankSettings') )
			return $settingsValue;
		
  		if( $clubId = MyTools::getAttribute('clubId') )
			$genericSettingsObj = ClubSettingsPeer::retrieveByPK($clubId, $tagName);
		elseif( $userAdminId = MyTools::getAttribute('userAdminId') )
			$genericSettingsObj = UserAdminSettingsPeer::retrieveByPK($userAdminId, $tagName);
			
		$settingsValue = $genericSettingsObj->getSettingsValue();
		MyTools::setAttribute('iRankAdminSettings-'.$tagName, $settingsValue, 'iRankSettings');

		return ;
	}
}
