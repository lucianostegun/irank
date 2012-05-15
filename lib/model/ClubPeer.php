<?php

/**
 * Subclasse de persistência de dados para registros da tabela 'club'.
 *
 * 
 *
 * @package lib.model
 */ 
class ClubPeer extends BaseClubPeer
{
	
	public static function validateTagName($tagName){
		
		$clubId = MyTools::getRequestParameter('clubId');
		
		$rootPath  = sfConfig::get('sf_root_dir');
		$moduleDir = Util::getFilePath('/apps/frontend/modules', $rootPath);
		
		$dirList = array();
		if($handle = opendir($moduleDir)){
			
			while(false !== ($file = readdir($handle)))
				$dirList[] = $file;
		}
		
		if( in_array($tagName, $dirList) ){
			
			MyTools::setError('tagName', 'Este nome não pode ser usado pois é um nome reservado pelo <b>iRank</b>');
			return false;
		}
		
		$criteria = new Criteria();
		$criteria->add( ClubPeer::TAG_NAME, $tagName, Criteria::ILIKE );
		$criteria->add( ClubPeer::ID, $clubId, Criteria::NOT_EQUAL );
		$criteria->add( ClubPeer::ENABLED, true );
		$criteria->add( ClubPeer::VISIBLE, true );
		$criteria->add( ClubPeer::DELETED, false );
		$clubObj = ClubPeer::doSelectOne($criteria);
		
		return !is_object($clubObj);
	}
}
