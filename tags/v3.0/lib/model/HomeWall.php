<?php

/**
 * Subclasse de representação de objetos da tabela 'home_wall'.
 *
 * 
 *
 * @package lib.model
 */ 
class HomeWall extends BaseHomeWall
{
	
	public static function doLog($message, $icon=null, $showWho=false, $userSiteId=null, $firstName=null){
		
		try {
			if( $userSiteId ){
			
				$userSiteObj = UserSitePeer::retrieveByPK($userSiteId);
				$firstName   = ($firstName?$firstName:$userSiteObj->getPeople()->getFirstName());	
			}else{
				
				$userSiteId = MyTools::getAttribute('userSiteId');
				$firstName  = ($firstName?$firstName:MyTools::getAttribute('firstName'));
			}
			
			$homeWallObj = new HomeWall();
			$homeWallObj->setUserSiteId($userSiteId);
			$homeWallObj->setPeopleName($firstName);
			$homeWallObj->setMessage($message);
			$homeWallObj->setIcon($icon);
			$homeWallObj->setShowWho($showWho);
			$homeWallObj->save();
		}catch(Exception $e){
			
		}
	}
	
	public static function getLastPosts($limit=null){
		
		$criteria = new Criteria();
		$criteria->add( HomeWallPeer::DELETED, false );
		$criteria->addDescendingOrderByColumn( HomeWallPeer::CREATED_AT );
		$criteria->setLimit( $limit );
		
		return HomeWallPeer::doSelect($criteria);
	}
    
    public function getTimeAgo(){
    	
    	return Util::getTimeAgo($this->getCreatedAt(null));
    }
}
