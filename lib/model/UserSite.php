<?php

/**
 * Subclasse de representação de objetos da tabela 'user_site'.
 *
 * 
 *
 * @package lib.model
 */ 
class UserSite extends BaseUserSite
{
	
	public function quickSave($request){
		
		$username     = $request->getParameter('username');
	  	$emailAddress = $request->getParameter('emailAddress');
	  	$firstName    = $request->getParameter('firstName');
	  	$lastName     = $request->getParameter('lastName');
	  	$password     = $request->getParameter('password');
	  	
  		$peopleObj = People::getQuickPeople($firstName, $lastName, 'userSite', $this->getPeopleId());
  		
	  	if( !$this->getActive() ){
	  		
	  		$this->setPeopleId( $peopleObj->getId() );
		  	$this->setUsername( $username );
		}
	
	  	$peopleObj->setEmailAddress( $emailAddress );
	  	$this->setPassword( md5($password) );
	  	$this->setActive(true);
	  	$this->save();
	  	$peopleObj->save();
	}
	
	public function login($keepLogin=false){
		
        $peopleObj = $this->getPeople();
        
        if( $keepLogin ){
        
        	$userSiteId = base64_encode(serialize(array($this->getId())));
	        MyTools::setCookie('userSiteId', $userSiteId, time()+60*60*24*15, '/');
        }
        	
        MyTools::getUser()->setAttribute('userSiteId', $this->getId());
        MyTools::getUser()->setAttribute('peopleId', $peopleObj->getId());
        MyTools::getUser()->setAttribute('username', $this->getUsername());
        MyTools::getUser()->setAttribute('fullName', $peopleObj->getName());
        MyTools::getUser()->setAttribute('firstName', $peopleObj->getFirstName());
        MyTools::getUser()->setAttribute('lastName', $peopleObj->getLastName());
        MyTools::getUser()->setAuthenticated( true );
        MyTools::getUser()->addCredential('iRankingSite');
	}
	
	public static function logout(){
		
		MyTools::setCookie('userSiteId', null);
		MyTools::getUser()->getAttributeHolder()->remove('userSiteId');
		MyTools::getUser()->getAttributeHolder()->remove('peopleId');
		MyTools::getUser()->getAttributeHolder()->remove('username');
		MyTools::getUser()->getAttributeHolder()->remove('fullName');
		MyTools::getUser()->getAttributeHolder()->remove('firstName');
		MyTools::getUser()->getAttributeHolder()->remove('lastName');
		MyTools::getUser()->removeCredential('iRankingSite');
		MyTools::getUser()->setAuthenticated( false );
	}
	
	public function getRankingList($criteria=null, $con=null){
		
		$criteria = new Criteria();
		$criteria->setNoFilter(true);
		$criteria->add( RankingPeer::ENABLED, true );
		$criteria->add( RankingPeer::VISIBLE, true );
		$criteria->add( RankingPeer::DELETED, false );
		$criteria->add( RankingMemberPeer::PEOPLE_ID, $this->getPeopleId() );
		$criteria->addJoin( RankingPeer::ID, RankingMemberPeer::RANKING_ID, Criteria::INNER_JOIN );
		$criteria->addAscendingOrderByColumn( RankingPeer::RANKING_NAME );
		return RankingPeer::doSelect($criteria);
	}
}
