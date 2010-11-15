<?php

/**
 * Subclasse de representação de objetos da tabela 'ranking'.
 *
 * 
 *
 * @package lib.model
 */ 
class Ranking extends BaseRanking
{
	
	public function cleanRecord(){
		
		$this->setMembers(0);
		$this->setEvents(0);
		$this->save();
		
		Util::executeQuery('DELETE FROM ranking_member WHERE ranking_id = '.$this->getId());
		Util::executeQuery('UPDATE event SET ranking_id = null WHERE ranking_id = '.$this->getId());
	}
	
	public static function getList(){
		
		$criteria = new Criteria();
		$criteria->add( RankingPeer::ENABLED, true );
		$criteria->add( RankingPeer::VISIBLE, true );
		$criteria->add( RankingPeer::DELETED, false );
		$criteria->addAscendingOrderByColumn( RankingPeer::RANKING_NAME );
		
		return RankingPeer::doSelect( $criteria );
	}

	public static function getOptionsForSelect( $defaultValue=false, $returnArray=false ){
		
		$rankingObjList = self::getList();

		$optionList = array();
		$optionList[''] = 'Selecione';
		foreach( $rankingObjList as $rankingObj )			
			$optionList[$rankingObj->getId()] = $rankingObj->getRankingName();
		
		if( $returnArray )
			return $optionList;

		return options_for_select( $optionList, $defaultValue );
	}
	
	public function getPeopleList($returnPeople=false, $orderByList=null){
		
		$criteria = new Criteria();
		$criteria->add( RankingMemberPeer::ENABLED, true );
		$criteria->add( RankingMemberPeer::RANKING_ID, $this->getId() );
		$criteria->addJoin( RankingMemberPeer::PEOPLE_ID, PeoplePeer::ID, Criteria::INNER_JOIN );
		
		if( is_array($orderByList) ){

			foreach( $orderByList as $orderBy=>$order ){
				
				if( $order=='desc' )
					$criteria->addDescendingOrderByColumn( $orderBy );
				else
					$criteria->addAscendingOrderByColumn( $orderBy );
			}
		}
		
		$criteria->addAscendingOrderByColumn( PeoplePeer::FULL_NAME );
		
		if( $returnPeople )
			return PeoplePeer::doSelect($criteria);
		else
			return RankingMemberPeer::doSelect($criteria);
	}
	
	public function getMemberList($orderByList=null){
		
		return $this->getPeopleList(false, $orderByList);
	}
	
	public function addMember($peopleId){
		
		$rankingMemberObj = RankingMemberPeer::retrieveByPK($this->getId(), $peopleId);
		
		if( !is_object($rankingMemberObj) ){
			
			$rankingMemberObj = new RankingMember();
			$rankingMemberObj->setRankingId( $this->getId() );
			$rankingMemberObj->setPeopleId( $peopleId );
			
			$this->setMembers( $this->getMembers()+1 );
			$this->save();
		}
		
		$rankingMemberObj->setEnabled( true );
		$rankingMemberObj->save();
	}
	
	public function deleteMember($peopleId){

		$rankingMemberObj = RankingMemberPeer::retrieveByPK($this->getId(), $peopleId);
		
		if( is_object($rankingMemberObj) ){
			
			$rankingMemberObj->setEnabled( false );
			$rankingMemberObj->save();
			
			$this->setMembers( $this->getMembers()-1 );
			$this->save();
		}else{
			
			throw new Exception('Membro não encontrado');
		}
	}
	
	public function getEventList($criteria=null, $con=null){
		
		$criteria = new Criteria();
		$criteria->add( EventPeer::ENABLED, true );
		$criteria->add( EventPeer::VISIBLE, true );
		$criteria->add( EventPeer::DELETED, false );
		$criteria->add( EventPeer::RANKING_ID, $this->getId() );
		$criteria->addDescendingOrderByColumn( EventPeer::EVENT_DATE );
		$criteria->addDescendingOrderByColumn( EventPeer::START_TIME );
		
		return EventPeer::doSelect($criteria);
	}
	
	public function getRankingType($returnTagName=false){
		
		$virtualTableObj = $this->getVirtualTable();
		
		if( !is_object($virtualTableObj) )
			$virtualTableObj = new VirtualTable();
		
		if( $returnTagName )
			return $virtualTableObj->getTagName();
		else
			return $virtualTableObj;
	}
	
	public function isRankingType($tagName){
		
		return $this->getRankingType()->isTagName($tagName);
	}
	
	public function updateScore($peopleId){
		
		switch($this->getRankingType(true)){
			case 'value':
				$totalScore = Util::executeOne('SELECT SUM(prize_value) FROM event_member INNER JOIN event ON event_member.EVENT_ID=event.ID WHERE event.RANKING_ID='.$this->getId().' AND event_member.PEOPLE_ID='.$peopleId);
				break;
			case 'position':
				$totalScore = Util::executeOne('SELECT SUM(event_position) FROM event_member INNER JOIN event ON event_member.EVENT_ID=event.ID WHERE event.RANKING_ID='.$this->getId().' AND event_member.PEOPLE_ID='.$peopleId);
				break;
		}
		
		$rankingMemberObj = RankingMemberPeer::retrieveByPK($this->getId(), $peopleId);
		$rankingMemberObj->setScore($totalScore);
		$rankingMemberObj->save(); 
	}
	
	public function updateScores(){
		
	  	$rankingMemberObjList = $this->getMemberList();
	  	foreach( $rankingMemberObjList as $rankingMemberObj )
	  		$this->updateScore($rankingMemberObj->getPeopleId());
	}
	
	public function getClassify(){
		
		switch($this->getRankingType(true)){
			case 'value':
				$orderByList = array(RankingMemberPeer::SCORE=>'desc',
									 RankingMemberPeer::EVENTS=>'desc');
				break;
			case 'position':
				$orderByList = array(RankingMemberPeer::SCORE=>'asc',
									 RankingMemberPeer::EVENTS=>'desc');
				break;
		}
	  	
	  	$rankingMemberObjList = $this->getMemberList($orderByList);
	  	$lastList = array();
	  	foreach($rankingMemberObjList as $key=>$rankingMemberObj){
	  		
	  		if( $rankingMemberObj->getScore()==0 ){
	  			
	  			$lastList[] = $rankingMemberObj;
	  			unset($rankingMemberObjList[$key]);
	  		}
	  	}
	  	
	  	return array_merge($rankingMemberObjList, $lastList);
	}
	
	public function isMyRanking(){
		
		$userSiteId = MyTools::getAttribute('userSiteId');
		
		return $this->getUserSiteId()==$userSiteId;
	}		
}
