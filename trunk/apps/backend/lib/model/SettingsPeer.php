<?php

/**
 * Subclasse de persistência de dados para registros da tabela 'settings'.
 *
 * 
 *
 * @package ...apps.backend.lib.model
 */ 
class SettingsPeer extends BaseSettingsPeer
{
	
	public static function retrieveByTagName($tagName){
		
		$criteria = new Criteria();
		$criteria->add( SettingsPeer::TAG_NAME, $tagName );
		return SettingsPeer::doSelectOne( $criteria );
	}
}
