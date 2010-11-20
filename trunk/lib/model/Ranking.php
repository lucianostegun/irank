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
	
	public function getCode(){
		
		return '#'.sprintf('%04d', $this->getId());
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
		}

		if( !$rankingMemberObj->getEnabled() ){
			
			$rankingMemberObj->getPeople()->sendMemberNotify($this);
			
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
		
		$criteria = (is_object($criteria)?$criteria:new Criteria());
		$criteria->add( EventPeer::ENABLED, true );
		$criteria->add( EventPeer::VISIBLE, true );
		$criteria->add( EventPeer::DELETED, false );
		$criteria->add( EventPeer::RANKING_ID, $this->getId() );
		$criteria->addDescendingOrderByColumn( EventPeer::EVENT_DATE );
		$criteria->addDescendingOrderByColumn( EventPeer::START_TIME );
		
		return EventPeer::doSelect($criteria);
	}
	
	public function getRankingType($returnTagName=false){
		
		$virtualTableObj = $this->getVirtualTableRelatedByRankingTypeId();
		
		if( !is_object($virtualTableObj) )
			$virtualTableObj = new VirtualTable();
		
		if( $returnTagName )
			return $virtualTableObj->getTagName();
		else
			return $virtualTableObj;
	}
	
	public function getGameStyle($returnTagName=false){
		
		$virtualTableObj = $this->getVirtualTableRelatedByGameStyleId();
		
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
	
	public function updateInfo($peopleId, $dateStart=null, $dateFinish=null){

		/**
		 * Este método é utilizado para atualizar a tabela de ranking temporário
		 * utilizada para gerar histórico de rankings
		 */
		if( $dateStart || $dateFinish )
			$rankingMemberObj = RankingMemberTmpPeer::retrieveByPK($this->getId(), $peopleId);
		else
			$rankingMemberObj = RankingMemberPeer::retrieveByPK($this->getId(), $peopleId);
		
		$rankingMemberObj->updateInfo($dateStart, $dateFinish);
	}
	
	public function updateScores(){

	  	$rankingMemberObjList = $this->getMemberList(null);

	  	foreach( $rankingMemberObjList as $rankingMemberObj )
	  		$rankingMemberObj->updateInfo();
	}
	
	public function getEventDateList($format='d/m/Y'){
		
		$criteria = new Criteria();
		$criteria->addAscendingOrderByColumn( EventPeer::EVENT_DATE );
		$eventObjList = $this->getEventList($criteria);
		
		$eventDateList = array();
		foreach($eventObjList as $eventObj)
			$eventDateList[] = $eventObj->getEventDate($format);
		
		return $eventDateList;
	}
	
	public function updateWholeHistory(){
		
		foreach($this->getEventDateList() as $eventDate)
			$this->getClassifyHistory($eventDate, true);
	}
	
	public function updateHistory($rankingDate){

		$rankingDate = Util::formatDate($rankingDate);
		Util::executeQuery('DELETE FROM ranking_history WHERE ranking_id = '.$this->getId().' AND ranking_date = \''.$rankingDate.'\'');
		
		foreach($this->getMemberList() as $rankingMemberObj){
			
			$rankingHistoryObjLast = $rankingMemberObj->getLastHistory($rankingDate);
			
			$rankingHistoryObj = new RankingHistory();
			$rankingHistoryObj->setRankingId($rankingHistoryObjLast->getRankingId());
			$rankingHistoryObj->setPeopleId($rankingHistoryObjLast->getPeopleId());
			$rankingHistoryObj->setRankingDate($rankingDate);
			$rankingHistoryObj->setEnabled($rankingMemberObj->getEnabled());
			$rankingHistoryObj->setTotalEvents($rankingHistoryObjLast->getTotalEvents()+0);
			$rankingHistoryObj->setTotalScore($rankingHistoryObjLast->getTotalScore()+0);
			$rankingHistoryObj->setTotalBalance($rankingHistoryObjLast->getTotalBalance()+0);
			$rankingHistoryObj->setTotalPrize($rankingHistoryObjLast->getTotalPrize()+0);
			$rankingHistoryObj->setTotalPaid($rankingHistoryObjLast->getTotalPaid()+0);
			
			$rankingHistoryObj->setEvents(0);
			$rankingHistoryObj->setScore(0);
			$rankingHistoryObj->setBalanceValue(0);
			$rankingHistoryObj->setPrizeValue(0);
			$rankingHistoryObj->setPaidValue(0);
			$rankingHistoryObj->updateInfo();
			$rankingHistoryObj->save();
		}
		
		$this->getClassifyHistory($rankingDate, true);
	}
	
	public function getClassifyHistory($rankingDate, $save=false){

	  	$defaultOrderByList = array();
	  	$defaultOrderByList[RankingHistoryPeer::TOTAL_PRIZE]   = 'desc';
	  	$defaultOrderByList[RankingHistoryPeer::TOTAL_BALANCE] = 'desc';
	  	$defaultOrderByList[RankingHistoryPeer::TOTAL_PAID]    = 'asc';
	  	$defaultOrderByList[RankingHistoryPeer::TOTAL_EVENTS]  = 'asc';
	  	$defaultOrderByList[RankingHistoryPeer::PEOPLE_ID]     = 'asc';
	  	
	  	$rankingType = $this->getRankingType(true);
	  	
		switch($rankingType){
			case 'value':
				$orderByList = array(RankingHistoryPeer::TOTAL_PRIZE=>'desc');
				break;
			case 'balance':
				$orderByList = array(RankingHistoryPeer::TOTAL_BALANCE=>'desc');
				break;
			case 'score':
				$orderByList = array(RankingHistoryPeer::TOTAL_SCORE=>'desc');
				break;
		}
	  	
	  	$orderByList = array_merge($orderByList, $defaultOrderByList);
	  	
	  	$criteria = new Criteria();
	  	$criteria->add( RankingHistoryPeer::RANKING_DATE, Util::formatDate($rankingDate) );
	  	$criteria->add( RankingHistoryPeer::RANKING_ID, $this->getId() );
	  	
	  	if( is_array($orderByList) ){

			foreach( $orderByList as $orderBy=>$order ){
				
				if( $order=='desc' )
					$criteria->addDescendingOrderByColumn( $orderBy );
				else
					$criteria->addAscendingOrderByColumn( $orderBy );
			}
		}
		
	  	$rankingHistoryObjList = RankingHistoryPeer::doSelect($criteria);

	  	$lastList = array();
	  	foreach($rankingHistoryObjList as $key=>$rankingHistoryObj){
	  		
	  		if( $rankingHistoryObj->getTotalPaid()==0 ){
	  			
	  			$lastList[] = $rankingHistoryObj;
	  			unset($rankingHistoryObjList[$key]);
	  		}
	  	}
	  	
	  	$rankingHistoryObjListReturn = array_merge($rankingHistoryObjList, $lastList);
	  	
	  	if( $save ){

			$members         = $this->getMembers();
	  		$rankingPosition = 1;
	  		foreach($rankingHistoryObjList as $rankingHistoryObj){

	  			$rankingHistoryObj->setTotalRankingPosition($rankingPosition++);
	  			$rankingHistoryObj->save();
	  		}
	  		
	  		foreach($lastList as $rankingHistoryObj){

	  			$rankingHistoryObj->setTotalRankingPosition($members);
	  			$rankingHistoryObj->save();
	  		}

	
			// Salva a posição de cada jogador na data do evento
	
		  	$defaultOrderByList = array();
		  	$defaultOrderByList[RankingHistoryPeer::PRIZE_VALUE]   = 'desc';
		  	$defaultOrderByList[RankingHistoryPeer::BALANCE_VALUE] = 'desc';
		  	$defaultOrderByList[RankingHistoryPeer::PAID_VALUE]    = 'asc';
		  	$defaultOrderByList[RankingHistoryPeer::EVENTS]        = 'asc';
		  	$defaultOrderByList[RankingHistoryPeer::TOTAL_PRIZE]   = 'desc';
		  	$defaultOrderByList[RankingHistoryPeer::TOTAL_BALANCE] = 'desc';
		  	$defaultOrderByList[RankingHistoryPeer::TOTAL_PAID]    = 'asc';
		  	$defaultOrderByList[RankingHistoryPeer::TOTAL_EVENTS]  = 'asc';
		  	$defaultOrderByList[RankingHistoryPeer::PEOPLE_ID]     = 'asc';
	
			switch($rankingType){
				case 'value':
					$orderByList = array(RankingHistoryPeer::PRIZE_VALUE=>'desc');
					break;
				case 'balance':
					$orderByList = array(RankingHistoryPeer::BALANCE_VALUE=>'desc');
					break;
				case 'score':
					$orderByList = array(RankingHistoryPeer::SCORE=>'desc');
					break;
			}
			
			$orderByList = array_merge($orderByList, $defaultOrderByList);
		  	
		  	$criteria = new Criteria();
		  	$criteria->add( RankingHistoryPeer::RANKING_DATE, Util::formatDate($rankingDate) );
		  	$criteria->add( RankingHistoryPeer::RANKING_ID, $this->getId() );
		  	
		  	if( is_array($orderByList) ){
	
				foreach( $orderByList as $orderBy=>$order ){
					
					if( $order=='desc' )
						$criteria->addDescendingOrderByColumn( $orderBy );
					else
						$criteria->addAscendingOrderByColumn( $orderBy );
				}
			}
			
		  	$rankingHistoryObjList = RankingHistoryPeer::doSelect($criteria);
	
		  	$lastList = array();
		  	foreach($rankingHistoryObjList as $key=>$rankingHistoryObj){
		  		
		  		if( $rankingHistoryObj->getPaidValue()==0 ){
		  			
		  			$lastList[] = $rankingHistoryObj;
		  			unset($rankingHistoryObjList[$key]);
		  		}
		  	} 	

	  		$rankingPosition = 1;
	  		foreach($rankingHistoryObjList as $rankingHistoryObj){

	  			$rankingHistoryObj->setRankingPosition($rankingPosition++);
	  			$rankingHistoryObj->save();
	  		}
	  		
	  		foreach($lastList as $rankingHistoryObj){

	  			$rankingHistoryObj->setRankingPosition($members);
	  			$rankingHistoryObj->save();
	  		}
	  	}	  	
	  	return $rankingHistoryObjListReturn;
	}
	
	public function getClassify(){
		
		switch($this->getRankingType(true)){
			case 'value':
				$orderByList = array(RankingMemberPeer::TOTAL_PRIZE=>'desc');
				break;
			case 'balance':
				$orderByList = array(RankingMemberPeer::BALANCE=>'desc');
				break;
			case 'score':
				$orderByList = array(RankingMemberPeer::SCORE=>'desc');
				break;
		}
	  	
	  	$orderByList[RankingMemberPeer::TOTAL_PRIZE] = 'desc';
	  	$orderByList[RankingMemberPeer::BALANCE]     = 'desc';
	  	$orderByList[RankingMemberPeer::TOTAL_PAID]  = 'asc';
	  	$orderByList[RankingMemberPeer::EVENTS]      = 'asc';
	  	$orderByList[RankingMemberPeer::PEOPLE_ID]   = 'asc';
	  	
	  	$rankingMemberObjList = $this->getMemberList($orderByList);
	  	$lastList = array();
	  	foreach($rankingMemberObjList as $key=>$rankingMemberObj){
	  		
	  		if( $rankingMemberObj->getTotalPaid()==0 ){
	  			
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
	
	public function addToOpenEvents($peopleId){
		
		$criteria = new Criteria();
		$criteria->add( EventPeer::EVENT_DATE, date('Y-m-d'), Criteria::GREATER_EQUAL );
		$eventObjList = $this->getEventList($criteria);
		
		foreach($eventObjList as $eventObj)
			$eventObj->addMember($peopleId);
	}
	
	public function getByPlace($place){
		
		$rankingPosition = 1;
		foreach($this->getClassify() as $rankingMemberObj)
			if( ($rankingPosition++)==$place )
				return $rankingMemberObj;
		
		return null;
	}		
}
