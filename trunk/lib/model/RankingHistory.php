<?php

/**
 * Subclasse de representação de objetos da tabela 'ranking_history'.
 *
 * 
 *
 * @package lib.model
 */ 
class RankingHistory extends BaseRankingHistory
{	
	
	public function updateScore(){
		
		$score           = 0;
//		$rankingPosition = 0;
		
		$criteria = new Criteria();
		$criteria->add( EventPeer::EVENT_DATE, $this->getRankingDate() );
		foreach($this->getRanking()->getEventList($criteria) as $eventObj){
			
			$paidPlaces    = $eventObj->getPaidPlaces();
			$eventPosition = $eventObj->getPosition($this->getPeopleId());
			if( $eventPosition > $paidPlaces || $eventPosition==0 )
				continue;
				
			$score += ($paidPlaces-($eventPosition-1));
		}
		
//		$this->setRankingPosition($rankingPosition);
		$this->setTotalScore($this->getTotalScore()+$score);
		$this->setScore($score);
	}
	
	public function updateBalance(){
			
		$rankingDate = $this->getRankingDate('Y-m-d');
		
		$totalPaid  = Util::executeOne('SELECT SUM(event_member.BUYIN+event_member.REBUY+event_member.ADDON) FROM event_member, event WHERE event.EVENT_DATE = \''.$rankingDate.'\' AND event.VISIBLE=TRUE AND event.DELETED=FALSE AND event_member.EVENT_ID=event.ID AND event.RANKING_ID='.$this->getRankingId().' AND event_member.PEOPLE_ID='.$this->getPeopleId(), 'float');
		$totalPrize = Util::executeOne('SELECT SUM(event_member.PRIZE) FROM event_member, event WHERE event.EVENT_DATE = \''.$rankingDate.'\' AND event.VISIBLE=TRUE AND event.DELETED=FALSE AND event_member.EVENT_ID=event.ID AND event.RANKING_ID='.$this->getRankingId().' AND event_member.PEOPLE_ID='.$this->getPeopleId(), 'float');
		
		$balanceValue = $totalPrize-$totalPaid;
		
//		if( $this->getPeopleId()==1){
//			Util::forceError('');
//			echo $totalPaid;
//			exit;
//		}
		
		$this->setTotalPaid( $this->getTotalPaid()+$totalPaid );
		$this->setTotalPrize( $this->getTotalPrize()+$totalPrize );
		$this->setTotalBalance( $this->getTotalBalance()+$balanceValue );
		
		$this->setPaidValue( $totalPaid );
		$this->setPrizeValue( $totalPrize );
		$this->setBalanceValue( $balanceValue );
	}
	
	public function updateEvents(){
		
		$rankingDate = $this->getRankingDate('Y-m-d');
		
		$events = Util::executeOne('SELECT COUNT(1) FROM event_member, event WHERE event.EVENT_DATE = \''.$rankingDate.'\' AND event.VISIBLE=TRUE AND event.DELETED=FALSE AND event_member.ENABLED AND event_member.EVENT_ID=event.ID AND event.RANKING_ID='.$this->getRankingId().' AND event_member.PEOPLE_ID='.$this->getPeopleId(), 'int');
		
		$this->setEvents($events);
		$this->setTotalEvents($this->getEvents()+$events);
	}
	
	public function updateInfo(){

		$this->updateScore();
		$this->updateBalance();
		$this->updateEvents();
	}
	
	// Função que atualiza todos as datas do ranking
	// Não deve ser utilizada se a consistencia dos eventos do ranking estiverem certa
	public static function saveResults($rankingObj){
		
		$criteria = new Criteria();
		$criteria->addAscendingOrderByColumn( EventPeer::EVENT_DATE );
		$criteria->addAscendingOrderByColumn( EventPeer::START_TIME );
		
		$eventObjList         = $rankingObj->getEventList($criteria);
		$rankingMemberObjList = $rankingObj->getMemberList();
		$rankingType          = $rankingObj->getRankingType(true);

		$eventDateList = array();
		foreach($eventObjList as $eventObj)
			$eventDateList[] = Util::formatDate($eventObj->getEventDate('d/m/Y'));
		
		$eventDateList = array_unique($eventDateList);
		$firstDate     = Util::formatDate($eventDateList[0]);

		foreach( $eventDateList as $eventDate){
			
			foreach($rankingMemberObjList as $rankingMemberObj){
				
				$rankingHistoryObj = new RankingHistory();
				$rankingHistoryObj->setPeopleId( $rankingMemberObj->getPeopleId() );
				$rankingHistoryObj->setRankingId( $rankingMemberObj->getRankingId() );
				$rankingHistoryObj->setRankingDate( $eventDate );
				$rankingHistoryObj->updateInfo($firstDate, $eventDate);
				$rankingHistoryObj->save();
			}
		}
	}
}
