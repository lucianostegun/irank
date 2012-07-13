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
	
    public function save($con=null){
    	
    	try{
			
			$isNew              = $this->isNew();
			$columnModifiedList = Log::getModifiedColumnList($this);

			parent::save();
			
        	Log::quickLog('settings', $this->getPrimaryKey(), $isNew, $columnModifiedList, get_class($this));
        } catch ( Exception $e ) {
        	
            Log::quickLogError('settings', $this->getPrimaryKey(), $e);
        }
    }

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
		
		MyTools::setAttribute('iRankAdminSettings-'.$tagName, $settingsValue, 'iRankSettings');
	}
	
	public static function getValue($tagName, $clubId=null){
		
		$settingsValue = MyTools::getAttribute('iRankAdminSettings-'.$tagName, null, 'iRankSettings');
		
		if( $settingsValue )
			return $settingsValue;
		
		if( !$clubId )
			$clubId = MyTools::getAttribute('clubId');
		
  		if( $clubId )
			$genericSettingsObj = ClubSettingsPeer::retrieveByPK($clubId, $tagName);
		elseif( $userAdminId = MyTools::getAttribute('userAdminId') )
			$genericSettingsObj = UserAdminSettingsPeer::retrieveByPK($userAdminId, $tagName);
			
		if( !is_object($genericSettingsObj) )
			return null;
			
		$settingsValue = $genericSettingsObj->getSettingsValue();
		MyTools::setAttribute('iRankAdminSettings-'.$tagName, $settingsValue, 'iRankSettings');

		return ;
	}
}
