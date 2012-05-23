<?php

/**
 * Subclasse de persistência de dados para registros da tabela 'poll'.
 *
 * 
 *
 * @package lib.model
 */ 
class PollPeer extends BasePollPeer
{
	
	public static function getRandonPoll(){
		
		$pollIdList = MyTools::getAttribute('answeredPollIdList');
		
		$criteria = new Criteria();
		$criteria->add( PollPeer::ENABLED, true );
		$criteria->add( PollPeer::VISIBLE, true );
		$criteria->add( PollPeer::DELETED, false );
		
		if($pollIdList)
			$criteria->add( PollPeer::ID, explode(',', $pollIdList), Criteria::NOT_IN );
			
		$pollObj = PollPeer::doSelectOne($criteria);
		
		if(!is_object($pollObj) && $pollIdList ){
			
			MyTools::setAttribute('answeredPollIdList', '');
			
			$criteria = new Criteria();
			$criteria->add( PollPeer::ENABLED, true );
			$criteria->add( PollPeer::VISIBLE, true );
			$criteria->add( PollPeer::DELETED, false );
			$pollObj = PollPeer::doSelectOne($criteria);
		}
		
		return $pollObj;
	}
}
