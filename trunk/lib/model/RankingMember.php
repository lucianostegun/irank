<?php

/**
 * Subclasse de representação de objetos da tabela 'ranking_member'.
 *
 * 
 *
 * @package lib.model
 */ 
class RankingMember extends BaseRankingMember
{
	
	public function updateScore(){
		
		$score = 0;
		
		foreach($this->getRanking()->getEventList() as $eventObj){
			
			$paidPlaces    = $eventObj->getPaidPlaces();
			$eventPosition = $eventObj->getPosition($this->getPeopleId());
			if( $eventPosition > $paidPlaces || $eventPosition==0 )
				continue;
				
			$score += ($paidPlaces-($eventPosition-1));
		}
		
		
		$this->setScore($score);
	}
	
	public function updateBalance(){
		
		$totalPaid  = Util::executeOne('SELECT SUM(event_member.BUYIN+event_member.REBUY+event_member.ADDON) FROM event_member, event WHERE event.VISIBLE=TRUE AND event.DELETED=FALSE AND event_member.EVENT_ID=event.ID AND event.RANKING_ID='.$this->getRankingId().' AND event_member.PEOPLE_ID='.$this->getPeopleId(), 'float');
		$totalPrize = Util::executeOne('SELECT SUM(event_member.PRIZE) FROM event_member, event WHERE event.VISIBLE=TRUE AND event.DELETED=FALSE AND event_member.EVENT_ID=event.ID AND event.RANKING_ID='.$this->getRankingId().' AND event_member.PEOPLE_ID='.$this->getPeopleId(), 'float');
		
		$balanceValue = $totalPrize-$totalPaid;
		$this->setTotalPaid($totalPaid);
		$this->setTotalPrize($totalPrize);
		$this->setBalance($balanceValue);
	}
	
	public function updateEvents(){
		
		$events = Util::executeOne('SELECT COUNT(1) FROM event_member, event WHERE event.VISIBLE=TRUE AND event.DELETED=FALSE AND event_member.ENABLED AND event_member.EVENT_ID=event.ID AND event.RANKING_ID='.$this->getRankingId().' AND event_member.PEOPLE_ID='.$this->getPeopleId(), 'int');
		$this->setEvents($events);
	}
	
	public function updateInfo(){

		$this->updateScore();
		$this->updateBalance();
		$this->updateEvents();
		$this->save(); 
	}
	
	public function getLastHistory($eventDate){
		
		// Pega o último histórico de ranking
		$criteria = new Criteria();
		$criteria->add( RankingHistoryPeer::RANKING_ID, $this->getRankingId() );
		$criteria->add( RankingHistoryPeer::PEOPLE_ID, $this->getPeopleId() );
		$criteria->add( RankingHistoryPeer::RANKING_DATE, $eventDate, Criteria::LESS_THAN );
		$criteria->addDescendingOrderByColumn( RankingHistoryPeer::RANKING_DATE );
		$rankingHistoryObj = RankingHistoryPeer::doSelectOne($criteria);
		
		if( !is_object($rankingHistoryObj) ){
			
			$rankingHistoryObj = new RankingHistory();
			$rankingHistoryObj->setRankingId($this->getRankingId());
			$rankingHistoryObj->setPeopleId($this->getPeopleId());
		}
		
		return $rankingHistoryObj;
	}
}
