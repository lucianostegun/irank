<?php

/**
 * Subclasse de representação de objetos da tabela 'ranking_player'.
 *
 * 
 *
 * @package lib.model
 */ 
class RankingPlayer extends BaseRankingPlayer
{
	
	public function updateScore(){
		
		$events  = $this->getEvents();
		$average = $this->getAverage();
		
		$this->setScore( $average*$events*10 );
	}
	
	public function updateScoreOld(){
		
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
		
		$totalPaid  = Util::executeOne('SELECT SUM(event_player.BUYIN+event_player.REBUY+event_player.ADDON) FROM event_player, event WHERE event.VISIBLE=TRUE AND event.DELETED=FALSE AND event_player.EVENT_ID=event.ID AND event.RANKING_ID='.$this->getRankingId().' AND event_player.PEOPLE_ID='.$this->getPeopleId(), 'float');
		$totalPrize = Util::executeOne('SELECT SUM(event_player.PRIZE) FROM event_player, event WHERE event.VISIBLE=TRUE AND event.DELETED=FALSE AND event_player.EVENT_ID=event.ID AND event.RANKING_ID='.$this->getRankingId().' AND event_player.PEOPLE_ID='.$this->getPeopleId(), 'float');
		
		$balanceValue = $totalPrize-$totalPaid;
		$this->setTotalPaid($totalPaid);
		$this->setTotalPrize($totalPrize);
		$this->setBalance($balanceValue);
		$this->setAverage($totalPrize/$totalPaid);
	}
	
	public function updateEvents(){
		
		$events = Util::executeOne('SELECT COUNT(1) FROM event_player, event WHERE event.VISIBLE=TRUE AND event.DELETED=FALSE AND event_player.ENABLED AND event_player.EVENT_ID=event.ID AND event.RANKING_ID='.$this->getRankingId().' AND event_player.PEOPLE_ID='.$this->getPeopleId(), 'int');
		$this->setEvents($events);
	}
	
	public function updateInfo(){

		$this->updateBalance();
		$this->updateEvents();
		$this->updateScore();
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
